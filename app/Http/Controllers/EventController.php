<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EventService;
use App\Services\CategoryService;

class EventController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
    	EventService $eventService,
    	CategoryService $categoryService
    ) {
        $this->eventService = $eventService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display all the events
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$events = $this->eventService->getUpcomingEvents(24);

    	$events = $events->count() > 0 ? $events : collect([]);

    	return view('events', compact('events'));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
    	$event = $this->eventService->findBySlug($slug, 'slug');

    	abort_if(! $event, 404);

    	$moreEvents = $this->eventService->getMoreEvents($event->uid, 2, [
    		'slug', 'uid', 'title'
    	]);

    	// $relatedCourses = $this->courseService->getRelatedRecords($course->category_id, 4);
        $categories = $this->categoryService->getActiveCategoriesAndCourses(['name', 'uid'])->take(5);

    	return view('event_details', compact('event', 'moreEvents', 'categories'));
    }
}
