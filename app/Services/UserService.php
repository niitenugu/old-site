<?php

namespace App\Services;

use Hash;
use App\Repositories\UserRepository;

class UserService 
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Return available roles
     *
     * @return array
     */
    public function getAvailableRoles()
    {
        return $this->userRepository->availableRoles();
    }

    /**
     * Fetch result set
     *
     * @param  array  $columns
     * @return mixed
     */
    public function getRecords($columns = array('*'))
    {
        return $this->userRepository->all($columns);
    }

    /**
     * Fetch paginated result set
     *
     * @param  int  $perPage
     * @param  array  $columns
     * @return mixed
     */
    public function getPaginatedRecords(int $perPage = 0, $columns = array('*'))
    {
        return $this->userRepository->paginate($perPage, $columns);
    }

    /**
     * Fetch result set that are live on the website
     *
     * @param  array  $columns
     * @return mixed
     */
    /*public function getActiveCategoriesAndCourses($columns = array('*'))
    {
        return $this->categoryRepository->allActiveCategoriesAndCourses($columns);
    }*/

    /**
     * Save record
     *
     * @param  array  $data
     * @return mixed
     */
    public function createRecord($data)
    {
    	return $this->userRepository->create([
    		'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'uid' => uniqid(true),
            'is_active' => true,
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
       return $this->userRepository->find($uid, $columns);
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
        return $this->userRepository->update($uid, [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'role' => $data['role'],
            'is_active' => $data['is_active'],
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
       return $this->userRepository->delete($uid, $attribute);
    }

    /**
     * Update record
     *
     * @param  string  $uid
     * @param  array  $data
     * @return mixed
     */
    public function updateStatus($uid, $data)
    {
        $status = $data == 1 ? false : true;

        return $this->userRepository->update($uid, ['is_active' => $status]);
    }
}