<?php

namespace App\Repositories;

use App\Repositories\Eloquent\Repository;
use App\Contracts\Repositories\RepositoryInterface;

class JobRepository extends Repository
{
    /**
     * Returns the name of the model
     *
     * @return string
     */
    public function model()
    {
        return 'App\Models\Job';
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
                    ->paginate($perPage, $columns);
    }

    /**
     * Select current and available jobs
     *
     * @param  int $perPage
     * @param  array  $columns
     * @return mixed
     */
    public function availableJobs(int $perPage = 0, $columns = array('*'))
    {
        return $this->makeModel()
                    ->where('is_live', 1)
                    ->where('opening_end_date', '>', today())
                    ->latest('created_at')
                    ->paginate($perPage, $columns);
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

}
