<?php

namespace App\Repositories;

use App\Repositories\Eloquent\Repository;
use App\Contracts\Repositories\RepositoryInterface;

class CategoryRepository extends Repository
{
    /**
     * Returns the name of the model
     *
     * @return string
     */
    public function model()
    {
        return 'App\Models\Category';
    }

    /**
     * Fetch result set
     *
     * @param  array  $columns
     * @return mixed
     */
    public function all(array $columns = array('*'))
    {
        return $this->makeModel()
                    ->latest()
                    ->with(['courses:category_id'])
                    ->get($columns);
    }

    /**
     * Fetch all records that are live on the website
     *
     * @param  array  $columns
     * @return mixed
     */
    public function allActiveCategoriesAndCourses($columns)
    {
        return $this->makeModel()
                    ->where('is_live', true)
                    ->latest()
                    ->with(array('courses' => function ($query) {
                        $query->where('is_live', true);
                    }))
                    ->get($columns);
    }
}
