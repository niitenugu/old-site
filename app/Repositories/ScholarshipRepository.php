<?php

namespace App\Repositories;

use App\Repositories\Eloquent\Repository;
use App\Contracts\Repositories\RepositoryInterface;

class ScholarshipRepository extends Repository
{
    /**
     * Returns the name of the model
     *
     * @return string
     */
    public function model()
    {
        return 'App\Models\Scholarship';
    }

    /**
     * Find a single record in the database with the option of filtering
     * the columns to be viewed
     *
     * @param  string $param
     * @param  array $columns
     * @return mixed
     */
    public function findBy(string $param, string $attribute, array $columns = array('*'))
    {
        return $this->makeModel()->where($attribute, $param)->first($columns);
    }

    /**
     * Fetch paginated result set
     *
     * @param  int $perPage
     * @param  array  $columns
     * @return mixed
     */
    public function allPaginated(int $perPage = 0, $columns = array('*'))
    {
        return $this->makeModel()
                    ->latest()
                    ->with(['attendees'])
                    ->paginate($perPage, $columns);
    }

    /**
     * Check if there is an active scholarship.
     *
     * @param  array  $columns
     * @return mixed
     */
    public function activeScholarship(array $columns = array('*'))
    {
        return $this->makeModel()
                    ->where('is_live', 1)
                    ->where('start_date', '>=', today())
                    ->with('attendees')
                    ->latest()
                    ->first($columns);
    }

    /**
     * Select more upcoming events minus the currently viewed event
     *
     * @param  string  $uid
     * @param  int  $limit
     * @param  array  $columns
     * @return mixed
     */
    /*public function moreEvents($uid, int $limit, array $columns = array('*'))
    {
        return $this->makeModel()
                    ->where('uid', '!=', $uid)
                    ->where('end_date', '>', today())
                    ->inRandomOrder()
                    ->limit(2)
                    ->get($columns);
    }*/
}
