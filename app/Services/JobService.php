<?php

namespace App\Services;

use App\Repositories\JobRepository;

class JobService
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(JobRepository $jobRepository)
    {
        $this->jobRepository = $jobRepository;
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
        return $this->jobRepository->allPaginated($perPage, $columns);
    }

    /**
     * Save record
     *
     * @param  array  $data
     * @return mixed
     */
    public function createRecord($data)
    {
        $openingStarts = $openingEnds = null;

        if (! is_null($data['opening_date'])) {
            $date = explode(' to ', $data['opening_date']);

            $openingStarts = $date[0];
            $openingEnds = $date[1];
        }

        return $this->jobRepository->create([
            'title' => $data['title'],
            'details' => $data['details'],
            'is_live' => $data['is_live'],
            'slug' => $data['title'],
            'opening_start_date' => $openingStarts,
            'opening_end_date' => $openingEnds,
            'uid' => uniqid(true),
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
       return $this->jobRepository->find($uid, $columns);
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
        $openingStarts = $openingEnds = null;

        if (! is_null($data['opening_date'])) {
            $date = explode(' to ', $data['opening_date']);

            $openingStarts = $date[0];
            $openingEnds = $date[1];
        }

        $record = [
            'title' => $data['title'],
            'details' => $data['details'],
            'is_live' => $data['is_live'],
            'opening_start_date' => $openingStarts,
            'opening_end_date' => $openingEnds,
        ];

        // Handle change of slug
        $job = $this->findRecord($uid, ['title']);
        if (strtolower($job->title) != strtolower($data['title'])) {
            $record['slug'] = $data['title'];
        }

        return $this->jobRepository->update($uid, $record);
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
       return $this->jobRepository->delete($uid, $attribute);
    }

    /**
     * Select current and available jobs
     *
     * @param  int $perPage
     * @param  array  $columns
     * @return mixed
     */
    public function getAvailableJobs(int $perPage = 0, $columns = array('*'))
    {
        return $this->jobRepository->availableJobs($perPage, $columns);
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
       return $this->jobRepository->findBy($slug, $attribute, $columns);
    }

}