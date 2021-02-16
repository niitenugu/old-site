<?php

namespace App\Services;

use App\Services\CloudinaryService;
use App\Repositories\CourseRepository;

class CourseService 
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CourseRepository $courseRepository,
        CloudinaryService $cloudinaryService
    ) {
        $this->courseRepository = $courseRepository;
        $this->cloudinaryService = $cloudinaryService;
    }

    /**
     * Fetch result set
     *
     * @param  array  $columns
     * @return mixed
     */
    public function getRecords($columns = array('*'))
    {
        return $this->courseRepository->all($columns);
    }

    /**
     * Fetch paginated result set
     *
     * @param  int $perPage
     * @param  array  $columns
     * @return mixed
     */
    public function getPaginatedRecords(int $perPage = 0, $columns = array('*'))
    {
        return $this->courseRepository->allPaginated($perPage, $columns);
    }

    /**
     * Fetch related set of records
     *
     * @param  string $categoryId
     * @param  int $limit
     * @param  array  $columns
     * @return mixed
     */
    public function getRelatedRecords(string $categoryId, int $limit, $columns = array('*'))
    {
        return $this->courseRepository->relatedRecords($categoryId, $limit, $columns);
    }

    /**
     * Fetch limited random records
     *
     * @param  int $limit
     * @param  array  $columns
     * @return mixed
     */
    public function getRandomRecords(int $limit, $columns = array('*'))
    {
        return $this->courseRepository->randomRecords($limit, $columns);
    }

    /**
     * Save record
     *
     * @param  array  $data
     * @return mixed
     */
    public function createRecord($data)
    {
        if (! empty($data['photo'])) {
            $image = $this->cloudinaryService->upload($data['photo']);
        }

    	return $this->courseRepository->create([
    		'title' => $data['title'],
    		'details' => $data['details'],
    		'is_live' => $data['is_live'],
            'slug' => $data['title'],
            'cost' => $data['cost'],
            'discount' => $data['discount'],
            'duration' => $data['duration'],
    		'category_id' => $data['category_id'],
    		'uid' => uniqid(true),
            'image_url' => $image['secure_url'] ?? null,
            'image_name' => $image['public_id'] ?? null,
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
       return $this->courseRepository->find($uid, $columns);
    }

    /**
     * Search for a record
     *
     * @param  string  $search
     * @param  int  $perPage
     * @return mixed
     */
    public function searchRecords($search, int $perPage)
    {
        return $this->courseRepository->search($search, $perPage);
    }

    /**
     * Find a record by it's slug
     *
     * @param  string  $slug
     * @param  array  $columns
     * @return mixed
     */
    public function findBySlug(string $slug, string $attribute, array $columns = array('*'))
    {
       return $this->courseRepository->findBy($slug, $attribute, $columns);
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
        $course = $this->findRecord($uid, ['image_url', 'image_name']);

        if (! empty($data['photo'])) {
            $image = $this->cloudinaryService->update($data['photo'], $course->image_name);
        }

        return $this->courseRepository->update($uid, [
            'title' => $data['title'],
            'details' => $data['details'],
            'is_live' => $data['is_live'],
            'slug' => $data['title'],
            'cost' => $data['cost'],
            'discount' => $data['discount'],
            'duration' => $data['duration'],
            'category_id' => $data['category_id'],  
            'image_url' => $image['secure_url'] ?? $course->image_url,
            'image_name' => $image['public_id'] ?? $course->image_name,
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
        $course = $this->findRecord($uid, ['image_name']);
        
        if ($course->image_name != '' || ! is_null($course->image_name)) {
            $this->cloudinaryService->delete($course->image_name);
        }

       return $this->courseRepository->delete($uid, $attribute);
    }
}