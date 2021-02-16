<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CourseService;
use App\Services\CategoryService;

class CourseController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CourseService $courseService,
        CategoryService $categoryService
    ) {
        $this->courseService = $courseService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display all the courses
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryService->getActiveCategoriesAndCourses();

        return view('courses', compact('categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
    	$course = $this->courseService->findBySlug($slug, 'slug');

    	abort_if(! $course, 404);

    	$relatedCourses = $this->courseService->getRelatedRecords($course->category_id, 4);
        $categories = $this->categoryService->getActiveCategoriesAndCourses(['name', 'uid'])->take(5);
    	    	
    	return view('course_details', compact('course', 'relatedCourses', 'categories'));
    }

    /**
     * Search for resources from storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = $request->query('q');

        if (! is_null($search) && strlen($search) >= 3) {
            $courses = $this->courseService->searchRecords($search, 15);

            return view('search_course', compact('courses'));
        }

        $courses = collect([]);


        return view('search_course', compact('courses'));
    }
}
