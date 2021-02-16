<?php

namespace App\Services;

use App\Services\CloudinaryService;
use App\Repositories\EventRepository;

class EventService
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        EventRepository $eventRepository,
        CloudinaryService $cloudinaryService
    ) {
        $this->eventRepository = $eventRepository;
        $this->cloudinaryService = $cloudinaryService;
    }

    /**
     * Fetch paginated result set
     *
     * @param  int $perPage
     * @param  array  $columns
     * @return mixed
     */
    public function getPaginatedRecords(int $perPage = 0, $columns = array('*'))
    {
        return $this->eventRepository->allPaginated($perPage, $columns);
    }

    /**
     * Fetch upcoming events and paginate the result set
     *
     * @param  int $perPage
     * @param  array  $columns
     * @return mixed
     */
    public function getUpcomingEvents(int $perPage = 0, $columns = array('*'))
    {
        return $this->eventRepository->upcomingEvent($perPage, $columns);
    }

    /**
     * Save record
     *
     * @param  array  $data
     * @return mixed
     */
    public function createRecord($data)
    {
        $startDate = $endDate = null;

        if (! is_null($data['event_date'])) {
            $date = explode(' to ', $data['event_date']);

            $startDate = $date[0];
            $endDate = $date[1];
        }

        $registrationStarts = $registrationEnds = null;

        if (! is_null($data['registration_date'])) {
            $date = explode(' to ', $data['registration_date']);

            $registrationStarts = $date[0];
            $registrationEnds = $date[1];
        }

        if (! empty($data['photo'])) {
            $image = $this->cloudinaryService->upload($data['photo']);
        }

    	return $this->eventRepository->create([
    		'title' => $data['title'],
    		'details' => $data['details'],
    		'is_live' => $data['is_live'],
            'slug' => $data['title'],
            'venue' => $data['venue'],
            'time' => $data['time'],
            'start_date' => $startDate,
            'end_date' => $endDate,
            'registration_start_date' => $registrationStarts,
            'registration_end_date' => $registrationEnds,
    		'uid' => uniqid(true),
            'image_url' => $image['secure_url'] ?? null,
            'image_name' => $image['public_id'] ?? null,
    	]);
    }

    /**
     * Find a record
     *
     * @param  string  $uid
     * @param  array  $columns
     * @return mixed
     */
    public function findRecord(string $uid, array $columns = array('*'))
    {
       return $this->eventRepository->find($uid, $columns);
    }

    /**
     * Find a record by it's slug
     *
     * @param  string  $slug
     * @param  array  $columns
     * @return mixed
     */
    public function findBySlug(string $slug, string $attribute, array $columns = array('*'))
    {
       return $this->eventRepository->findBy($slug, $attribute, $columns);
    }

    /**
     * Update record
     *
     * @param  string  $uid
     * @param  array  $data
     * @param  string  $attribute
     * @return mixed
     */
    public function updateRecord($uid, $data, string $attribute = '')
    {
        $startDate = $endDate = null;

        if (! is_null($data['event_date'])) {
            $date = explode(' to ', $data['event_date']);

            $startDate = $date[0];
            $endDate = $date[1];
        }

        $registrationStarts = $registrationEnds = null;

        if (! is_null($data['registration_date'])) {
            $date = explode(' to ', $data['registration_date']);

            $registrationStarts = $date[0];
            $registrationEnds = $date[1];
        }

        $record = [
            'title' => $data['title'],
            'details' => $data['details'],
            'is_live' => $data['is_live'],
            'venue' => $data['venue'],
            'time' => $data['time'],
            'start_date' => $startDate,
            'end_date' => $endDate,
            'registration_start_date' => $registrationStarts,
            'registration_end_date' => $registrationEnds, 
        ];

        // Handle change of slug
        $event = $this->findRecord($uid, ['title', 'image_url', 'image_name']);
        if (strtolower($event->title) != strtolower($data['title'])) {
            $record['slug'] = $data['title'];
        }

        // Handle upload of image
        if (! empty($data['photo'])) {
            $image = $this->cloudinaryService->update($data['photo'], $event->image_name);

            $record['image_url'] = $image['secure_url'];
            $record['image_name'] = $image['public_id'];
        }

        return $this->eventRepository->update($uid, $record);
    }

    /**
     * Select more upcoming events minus the currently viewed event
     *
     * @param  string  $uid
     * @param  int  $limit
     * @param  array  $columns
     * @return mixed
     */
    public function getMoreEvents($uid, int $limit, array $columns = array('*'))
    {
        return $this->eventRepository->moreEvents($uid, $limit, $columns);
    }

    /**
     * Remove the specified resource from storage
     *
     * @param  string  $uid
     * @param  string  $attribute
     * @return bool
     */
    public function deleteRecord($uid, string $attribute = '')
    {
       return $this->eventRepository->delete($uid, $attribute);
    }

    /**
     * Update event status
     *
     * @param  string  $uid
     * @param  array  $data
     * @return mixed
     */
    public function updateStatus($uid, $data)
    {
        $status = $data == 1 ? false : true;

        return $this->eventRepository->update($uid, ['is_live' => $status]);
    }
}