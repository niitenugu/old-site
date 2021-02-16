<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService 
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Fetch result set
     *
     * @param  array  $columns
     * @return mixed
     */
    public function getRecords($columns = array('*'))
    {
        return $this->categoryRepository->all($columns);
    }

    /**
     * Fetch result set that are live on the website
     *
     * @param  array  $columns
     * @return mixed
     */
    public function getActiveCategoriesAndCourses($columns = array('*'))
    {
        return $this->categoryRepository->allActiveCategoriesAndCourses($columns);
    }

    /**
     * Save record
     *
     * @param  array  $data
     * @return mixed
     */
    public function createRecord($data)
    {
    	return $this->categoryRepository->create([
    		'name' => $data['name'],
    		'description' => $data['description'],
    		'is_live' => $data['is_live'],
    		'slug' => $data['name'],
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
       return $this->categoryRepository->find($uid, $columns);
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
        return $this->categoryRepository->update($uid, [
            'name' => $data['name'],
            'description' => $data['description'],
            'is_live' => $data['is_live'],
            'slug' => $data['name']
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
       return $this->categoryRepository->delete($uid, $attribute);
    }
}