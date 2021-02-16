<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\CourseService;
use App\Services\CategoryService;
use App\Services\ScholarshipService;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserService $userService,
        CourseService $courseService,
        CategoryService $categoryService,
        ScholarshipService $scholarshipService
    ) {
        $this->userService = $userService;
        $this->courseService = $courseService;
        $this->categoryService = $categoryService;
        $this->scholarshipService = $scholarshipService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currentScholarship = $this->scholarshipService->checkForActiveScholarship();
        
        if ($currentScholarship != null) {
            $attendees = $currentScholarship->attendees();

            $recentAttendees = $attendees->latest()->take(3)->get();
            $totalAttendees = $attendees->count();
            $totalRegistrationToday = $attendees->where('created_at', '>=', today())->count();
        }

        $totalCategories = $this->categoryService->getRecords(['uid'])->count();
        $totalCourses = $this->courseService->getRecords(['uid'])->count();
        $totalUsers = $this->userService->getRecords(['uid'])->count();

        return view('dashboard', compact(
            'currentScholarship', 'totalAttendees', 'totalRegistrationToday', 
            'recentAttendees', 'totalCategories', 'totalCourses', 'totalUsers'
        ));
    }
}
