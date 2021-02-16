<?php

namespace App\Repositories;

use App\Repositories\Eloquent\Repository;
use App\Contracts\Repositories\RepositoryInterface;

class ScholarshipAttendeeRepository extends Repository
{
    /**
     * Returns the name of the model
     *
     * @return string
     */
    public function model()
    {
        return 'App\Models\ScholarshipAttendee';
    }

    /**
     * Find a single record in the database with the option of filtering
     * the columns to be viewed
     *
     * @param  string $param
     * @param  array $columns
     * @return mixed
     */
    /*public function findBy(string $param, string $attribute, array $columns = array('*'))
    {
        return $this->makeModel()->where($attribute, $param)->first($columns);
    }*/

    /**
     * Fetch paginated result set
     *
     * @param  string  $scholarshipId
     * @param  int $perPage
     * @param  array  $columns
     * @return mixed
     */
    public function allPaginated($scholarshipId, int $perPage = 0, $columns = array('*'))
    {
        return $this->makeModel()
                    ->where('scholarship_id', $scholarshipId)
                    ->latest()
                    ->with(['scholarship'])
                    ->paginate($perPage, $columns);
    }

    /**
     * Search for a record
     *
     * @param  string  $search
     * @param  string  $scholarshipId
     * @return mixed
     */
    public function search($search, $scholarshipId)
    {
        return $this->makeModel()
                    ->where('scholarship_id', $scholarshipId)
                    ->where('invitation_code', 'LIKE', "$search%")
                    ->orWhere('email', 'LIKE', "$search%")
                    ->orWhere('phone', 'LIKE', "$search%")
                    ->orderBy('created_at', 'DESC')
                    ->get([
                        'first_name', 'last_name', 'uid', 'email', 'phone',
                        'invitation_code', 'scholarship_id', 'checked_in_at',
                    ]);
    }

    /**
     * Total number of attendee for a particular scholarship
     *
     * @param  string  $scholarshipId
     * @return int
     */
    public function totalAttendee($scholarshipId)
    {
        return $this->makeModel()
                    ->where('scholarship_id', $scholarshipId)
                    ->count();
    }

    /**
     * Total number of attendee who attended a particular scholarship
     *
     * @param  string  $scholarshipId
     * @return int
     */
    public function totalPresent($scholarshipId)
    {
        return $this->makeModel()
                    ->where('scholarship_id', $scholarshipId)
                    ->where('checked_in_at', '!=', NULL)
                    ->count();
    }

    /**
     * Total number of attendee who did not attend a particular scholarship
     *
     * @param  string  $scholarshipId
     * @return int
     */
    public function totalAbsent($scholarshipId)
    {
        return $this->makeModel()
                    ->where('scholarship_id', $scholarshipId)
                    ->where('checked_in_at', NULL)
                    ->count();
    }
}
