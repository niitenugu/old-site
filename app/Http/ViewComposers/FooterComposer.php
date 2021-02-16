<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Services\CourseService;

class FooterComposer
{
	public function __construct(CourseService $courseService)
	{
		$this->courseService = $courseService;
	}

	public function compose(View $view)
	{
		$courses = $this->courseService->getRandomRecords(5, ['uid', 'slug', 'title']);

		$view->with('footerCourses', $courses);
	}
}