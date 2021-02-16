<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Mail\EventInvitation;
use App\Services\EventService;
use App\Services\AttendeeService;
use App\Http\Requests\AttendeeRequest;

class AttendeeController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        EventService $eventService,
        AttendeeService $attendeeService
    ) {
        $this->eventService = $eventService;
        $this->attendeeService = $attendeeService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AttendeeRequest  $request
     * @param  string  $eventId
     * @return \Illuminate\Http\Response
     */
    public function store(AttendeeRequest $request, $eventId)
    {
    	$event = $this->eventService->findRecord($eventId);
        abort_if(! $event, 404);

        DB::beginTransaction();
        $attendee = $this->attendeeService->createRecord($eventId, $request);
        DB::commit();

        if ($attendee) {
            try {
                \Mail::to($attendee->email)->send(new EventInvitation($attendee));

            } catch(\Swift_TransportException $e) {
                $e;
            }
        }

    	return redirect()->back()->withSuccess('Successful! Please, check your email for invitation code.');
    }
}
