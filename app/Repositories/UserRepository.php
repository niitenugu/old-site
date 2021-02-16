<?php

namespace App\Repositories;

use App\Repositories\Eloquent\Repository;
use App\Contracts\Repositories\RepositoryInterface;

class UserRepository extends Repository
{
    /**
     * Returns the name of the model
     *
     * @return string
     */
    public function model()
    {
        return 'App\User';
    }

    /**
     * Fetch all records that are live on the website
     *
     * @param  array  $columns
     * @return mixed
     */
    /*public function allActiveCategoriesAndCourses($columns)
    {
        return $this->makeModel()
                    ->where('is_live', true)
                    ->latest()
                    ->with(array('courses' => function ($query) {
                        $query->where('is_live', true);
                    }))
                    ->get($columns);
    }*/

    /**
     * Return available roles
     *
     * @return array
     */
    public function availableRoles()
    {
        return $this->makeModel()::ROLES;
    }
}
