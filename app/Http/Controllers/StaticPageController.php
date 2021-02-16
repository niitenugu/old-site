<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use App\Services\EventService;
use App\Services\CategoryService;
use App\Services\ScholarshipService;
use App\Http\Requests\ContactFormRequest;

class StaticPageController extends Controller
{
    public $examTimes = ['9am - 11am', '12pm - 2pm', '3pm - 5pm'];

    public $levels = [
        'OLEVEL', 'ALEVEL', 'COLLEGE-YEAR1', 'COLLEGE-YEAR2', 'COLLEGE-YEAR3',
        'COLLEGE-YEAR4', 'Polytechnic Employed', 'Polytechnic Un-Employed', 
        'IT Graduate Employed', 'IT Graduate Un-Employed', 'Non-IT Graduate Employed',
        'Non-IT Graduate Un-Employed', 'Post Graduate Employed', 
        'Post Graduate Un-Employed', 'Others',
    ];

    public function __construct(
        EventService $eventService,
        CategoryService $categoryService,
        ScholarshipService $scholarshipService
    ) {
        $this->eventService = $eventService;
        $this->categoryService = $categoryService;
        $this->scholarshipService = $scholarshipService;
    }

    /**
     * Show the home page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function homepage()
    {
        $categories = $this->categoryService->getActiveCategoriesAndCourses(['uid'])->take(5);
        $events = $this->eventService->getUpcomingEvents(6);

        $examTimes = $this->examTimes;    
        $levels = $this->levels;

        $activeScholarship = $this->scholarshipService->checkForActiveScholarship();
        
        return view('homepage', compact(
            'categories', 'events', 'activeScholarship', 'examTimes', 'levels'
        ));
    }

    /**
     * Show the about page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Show the contact page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Submit contact form and forward an email
     *
     * @param  \App\Http\Requests\ContactFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function submitContactForm(ContactFormRequest $request)
    {
        try {
            \Mail::to(config('app.email'))->send(new ContactMail($request));
        
        } catch(\Swift_TransportException $e) {
            $e;
        }

        return redirect()->back()->withSuccess('Sent! We will get back to you soon.');
    }
}
