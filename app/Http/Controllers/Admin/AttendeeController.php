<?php

namespace App\Http\Controllers\Admin;

use DB;
use Gate;
use Illuminate\Http\Request;
use App\Mail\EventInvitation;
use App\Services\EventService;
use App\Services\AttendeeService;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttendeeRequest;

class AttendeeController extends Controller
{
    /*
        TODO:
        1. Ability to convert table to PDF, CSV and also print. 
    */

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
     * Display a listing of the resource.
     *
     * @param  string  $eventId
     * @return \Illuminate\Http\Response
     */
    public function index($eventId)
    {
        $event = $this->eventService->findRecord($eventId, ['uid', 'title']);
        abort_if(! $event, 404);

        $attendees = $this->attendeeService->getPaginatedRecords($event->uid, 25);
        
        return view('admin.attendees.index', compact('attendees', 'event'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  string  $eventId
     * @return \Illuminate\Http\Response
     */
    public function create($eventId)
    {
        $event = $this->eventService->findRecord($eventId, ['uid', 'title']);
        
        abort_if(! $event, 404);

        return view('admin.attendees.create', compact('event'));
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
        $event = $this->eventService->findRecord($eventId, ['uid', 'title']);

        abort_if(! $event, 404);

        DB::beginTransaction();
        $attendee = $this->attendeeService->createRecord($eventId, $request);
        DB::commit();

        if ($attendee && $request->send_invitation_code) {
            try {
                \Mail::to($attendee->email)->send(new EventInvitation($attendee));

            } catch(\Swift_TransportException $e) {
                $e;
            }
        }

        return redirect()->back()->withSuccess('Registered successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort('404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $eventId
     * @param  string  $uid
     * @return \Illuminate\Http\Response
     */
    public function edit($eventId, $uid)
    {
        $event = $this->eventService->findRecord($eventId);
        $attendee = $this->attendeeService->findRecord($uid);
        
        abort_if(! $attendee || ! $event, 404);

        return view('admin.attendees.edit', compact('attendee', 'event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $eventId
     * @param  string  $uid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $eventId, $uid)
    {
        $event = $this->eventService->findRecord($eventId);
        $attendee = $this->attendeeService->findRecord($uid);
        
        abort_if(! $attendee || ! $event, 404);

        DB::beginTransaction();
        $this->attendeeService->updateRecord($uid, $request);
        DB::commit();
        
        return redirect()->route('admin.attendees.index', $event->uid)->withSuccess('Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $uid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uid)
    {
        abort_unless(Gate::allows('isAdminGroup'), 403);

        DB::beginTransaction();
        $this->attendeeService->deleteRecord($uid);
        DB::commit();

        return redirect()->back()->withSuccess('Deleted successfully!');
    }

    /**
     * Checkin attendee into an event.
     *
     * @param  string  $eventId
     * @return \Illuminate\Http\Response
     */
    public function checkIn($eventId)
    {
        $event = $this->eventService->findRecord($eventId, ['uid', 'title']);

        abort_if(! $event, 404);

        $attendees = collect([]);

        if (request()->query('search')) {
            $search = request()->query('search');
            $attendees = $this->attendeeService->searchRecords($search, $eventId);
        }

        return view('admin.attendees.check_in', compact('attendees', 'event'));
    }

    /**
     * Change the check-in status of an attendee.
     *
     * @param  string  $eventId
     * @param  string  $uid
     * @return \Illuminate\Http\Response
     */
    public function postCheckIn(Request $request, $eventId, $uid)
    {
        $event = $this->eventService->findRecord($eventId);

        abort_if(! $event, 404);

        DB::beginTransaction();
        $this->attendeeService->updateCheckInStatus($uid, $request->checked_in_at);
        DB::commit();

        return redirect()->back()->withSuccess('Attendee check-in status has been changed.');
    }
}
