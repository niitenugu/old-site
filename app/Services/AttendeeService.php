<?php

namespace App\Services;

use App\Repositories\AttendeeRepository;

class AttendeeService 
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AttendeeRepository $attendeeRepository)
    {
        $this->attendeeRepository = $attendeeRepository;
    }

    /**
     * Fetch paginated result set
     *
     * @param  string  $eventId
     * @param  int $perPage
     * @param  array  $columns
     * @return mixed
     */
    public function getPaginatedRecords($eventId, int $perPage = 0, $columns = array('*'))
    {
        return $this->attendeeRepository->allPaginated($eventId, $perPage, $columns);
    }

    /**
     * Save record
     *
     * @param  string  $eventId
     * @param  array  $data
     * @return mixed
     */
    public function createRecord($eventId, $data)
    {
        if (isset($data['checked_in_at'])) {
            $checkedInAt = $data['checked_in_at'] == 'yes' ? now() : NULL;
        } else {
            $checkedInAt = NULL;
        }

    	return $this->attendeeRepository->create([
    		'first_name' => $data['first_name'],
    		'last_name' => $data['last_name'],
    		'email' => $data['email'],
            'phone' => $data['phone'],
            'event_id' => $eventId,
            'gender' => $data['gender'] ?? NULL,
            'checked_in_at' => $checkedInAt,
    		'uid' => uniqid(true),
            'invitation_code' => $this->generateCode(),
    	]);
    }

    /**
     * Generate invitation code for attendee
     *
     * @return string
     */
    public function generateCode()
    {
        return strtoupper(str_random(3) . '-' . mt_rand(1000, 9999) . '-' . str_random(2));
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
       return $this->attendeeRepository->find($uid, $columns);
    }

    /**
     * Search for a record
     *
     * @param  string  $search
     * @param  string  $eventId
     * @return mixed
     */
    public function searchRecords($search, $eventId)
    {
        return $this->attendeeRepository->search($search, $eventId);
    }

    /**
     * Find a record by it's slug
     *
     * @param  string  $slug
     * @param  array  $columns
     * @return mixed
     */
    /*public function findBySlug(string $slug, string $attribute, array $columns = array('*'))
    {
       return $this->courseRepository->findBy($slug, $attribute, $columns);
    }*/

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
        return $this->attendeeRepository->update($uid, [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'gender' => $data['gender'],
        ]);
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
       return $this->attendeeRepository->delete($uid, $attribute);
    }

    /**
     * Update check in time
     *
     * @param  string  $uid
     * @param  array  $data
     * @return mixed
     */
    public function updateCheckInStatus($uid, $data)
    {
        $status = is_null($data) || $data == ''  ? now() : NULL;

        return $this->attendeeRepository->update($uid, ['checked_in_at' => $status]);
    }
}