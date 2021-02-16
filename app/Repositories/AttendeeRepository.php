<?php

namespace App\Repositories;

use App\Repositories\Eloquent\Repository;
use App\Contracts\Repositories\RepositoryInterface;

class AttendeeRepository extends Repository
{
    /**
     * Returns the name of the model
     *
     * @return string
     */
    public function model()
    {
        return 'App\Models\Attendee';
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
     * @param  string  $eventId
     * @param  int $perPage
     * @param  array  $columns
     * @return mixed
     */
    public function allPaginated($eventId, int $perPage = 0, $columns = array('*'))
    {
        return $this->makeModel()
                    ->where('event_id', $eventId)
                    ->latest()
                    ->with(['event'])
                    ->paginate($perPage, $columns);
    }

    /**
     * Search for a record
     *
     * @param  string  $search
     * @param  string  $eventId
     * @return mixed
     */
    public function search($search, $eventId)
    {
        return $this->makeModel()
                    ->where('event_id', $eventId)
                    ->where('invitation_code', 'LIKE', "$search%")
                    ->orWhere('email', 'LIKE', "$search%")
                    ->orWhere('phone', 'LIKE', "$search%")
                    ->orderBy('created_at', 'DESC')
                    ->get([
                        'first_name', 'last_name', 'uid', 'email', 'phone',
                        'invitation_code', 'event_id', 'gender', 'checked_in_at',
                    ]);
    }

    /**
     * Fetch limited records
     *
     * @param  string $categoryId
     * @param  int $limit
     * @param  array  $columns
     * @return mixed
     */
    /*public function relatedRecords(string $categoryId, int $limit, $columns = array('*'))
    {
        return $this->makeModel()
                    ->inRandomOrder()
                    ->limit($limit)
                    ->get($columns);
    }*/
}
