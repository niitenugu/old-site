<?php

namespace App\Repositories;

use App\Repositories\Eloquent\Repository;
use App\Contracts\Repositories\RepositoryInterface;

class CourseRepository extends Repository
{
    /**
     * Returns the name of the model
     *
     * @return string
     */
    public function model()
    {
        return 'App\Models\Course';
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
                    ->with(['category'])
                    ->paginate($perPage, $columns);
    }

    /**
     * Search for a record
     *
     * @param  string  $search
     * @param  int  $perPage
     * @return mixed
     */
    public function search($search, int $perPage)
    {
        return $this->makeModel()
                    ->where('title', 'LIKE', "$search%")
                    ->where('is_live', 1)
                    ->paginate($perPage, [
                        'title', 'uid', 'cost', 'discount', 'slug', 'duration', 
                        'category_id', 'image_url', 'details'
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
    public function relatedRecords(string $categoryId, int $limit, $columns = array('*'))
    {
        return $this->makeModel()
                    ->inRandomOrder()
                    ->limit($limit)
                    ->get($columns);
    }

    /**
     * Fetch limited random records
     *
     * @param  int $limit
     * @param  array  $columns
     * @return mixed
     */
    public function randomRecords(int $limit, $columns = array('*'))
    {
        return $this->makeModel()
                    ->inRandomOrder()
                    ->limit($limit)
                    ->get($columns);
    }
}
