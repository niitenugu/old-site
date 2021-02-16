<?php

namespace App\Services;

use App\Repositories\ScholarshipAttendeeRepository;

class ScholarshipAttendeeService 
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ScholarshipAttendeeRepository $scholarshipAttendeeRepository)
    {
        $this->scholarshipAttendeeRepository = $scholarshipAttendeeRepository;
    }

    /**
     * Fetch paginated result set
     *
     * @param  string  $scholarshipId
     * @param  int $perPage
     * @param  array  $columns
     * @return mixed
     */
    public function getPaginatedRecords(
        $scholarshipId, 
        int $perPage = 0, 
        $columns = array('*')
    ) {
        return $this->scholarshipAttendeeRepository
                    ->allPaginated($scholarshipId, $perPage, $columns);
    }

    /**
     * Save record
     *
     * @param  string  $scholarshipId
     * @param  array  $data
     * @return mixed
     */
    public function createRecord($scholarshipId, $data)
    {
        if (isset($data['checked_in_at'])) {
            $checkedInAt = $data['checked_in_at'] == 'yes' ? now() : NULL;
        } else {
            $checkedInAt = NULL;
        }

    	return $this->scholarshipAttendeeRepository->create([
    		'first_name' => $data['first_name'],
    		'last_name' => $data['last_name'],
    		'email' => $data['email'],
            'phone' => $data['phone'],
            'scholarship_id' => $scholarshipId,
            'preferred_exam_time' => $data['preferred_exam_time'],
            'school_level' => $data['school_level'],
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
       return $this->scholarshipAttendeeRepository->find($uid, $columns);
    }

    /**
     * Search for a record
     *
     * @param  string  $search
     * @param  string  $scholarshipId
     * @return mixed
     */
    public function searchRecords($search, $scholarshipId)
    {
        return $this->scholarshipAttendeeRepository->search($search, $scholarshipId);
    }

    /**
     * Total number of attendee for a particular scholarship
     *
     * @param  string  $scholarshipId
     * @return int
     */
    public function getTotalAttendee($scholarshipId)
    {
        return $this->scholarshipAttendeeRepository->totalAttendee($scholarshipId);
    }

    /**
     * Total number of attendee who attended a particular scholarship
     *
     * @param  string  $scholarshipId
     * @return int
     */
    public function getTotalPresent($scholarshipId)
    {
        return $this->scholarshipAttendeeRepository->totalPresent($scholarshipId);
    }

    /**
     * Total number of attendee who did not attend a particular scholarship
     *
     * @param  string  $scholarshipId
     * @return int
     */
    public function getTotalAbsent($scholarshipId)
    {
        return $this->scholarshipAttendeeRepository->totalAbsent($scholarshipId);
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
        return $this->scholarshipAttendeeRepository->update($uid, [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'preferred_exam_time' => $data['preferred_exam_time'],
            'school_level' => $data['school_level'],
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
       return $this->scholarshipAttendeeRepository->delete($uid, $attribute);
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

        return $this->scholarshipAttendeeRepository->update($uid, ['checked_in_at' => $status]);
    }

}