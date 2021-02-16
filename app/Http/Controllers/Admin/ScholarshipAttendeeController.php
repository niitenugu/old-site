<?php

namespace App\Http\Controllers\Admin;

use DB;
use Gate;
use Illuminate\Http\Request;
use App\Services\ScholarshipService;
use App\Http\Controllers\Controller;
use App\Services\ScholarshipAttendeeService;
use App\Http\Requests\ScholarshipAttendeeRequest;

class ScholarshipAttendeeController extends Controller
{
	public $examTimes = ['9am - 11am', '12pm - 2pm', '3pm - 5pm'];

	public $levels = [
        'OLEVEL', 'ALEVEL', 'COLLEGE-YEAR1', 'COLLEGE-YEAR2', 'COLLEGE-YEAR3',
        'COLLEGE-YEAR4', 'Polytechnic Employed', 'Polytechnic Un-Employed', 
        'IT Graduate Employed', 'IT Graduate Un-Employed', 'Non-IT Graduate Employed',
        'Non-IT Graduate Un-Employed', 'Post Graduate Employed', 
        'Post Graduate Un-Employed', 'Others',
    ];

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
        ScholarshipService $scholarshipService,
        ScholarshipAttendeeService $scholarshipAttendeeService
    ) {
        $this->scholarshipService = $scholarshipService;
        $this->scholarshipAttendeeService = $scholarshipAttendeeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  string  $scholarshipId
     * @return \Illuminate\Http\Response
     */
    public function index($scholarshipId)
    {
        $scholarship = $this->scholarshipService
        					->findRecord($scholarshipId, ['uid', 'title']);
        
        abort_if(! $scholarship, 404);

        $totalAttendees = $this->scholarshipAttendeeService
                                ->getTotalAttendee($scholarshipId);

        $totalPresent = $this->scholarshipAttendeeService
                                ->getTotalPresent($scholarshipId);

        $totalAbsent = $this->scholarshipAttendeeService
                                ->getTotalAbsent($scholarshipId);

        $attendees = $this->scholarshipAttendeeService
        				->getPaginatedRecords($scholarship->uid, 25);
        
        return view('admin.scholarship_attendees.index', compact(
        	'attendees', 'scholarship', 'totalAttendees', 'totalPresent', 
            'totalAbsent'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  string  $scholarshipId
     * @return \Illuminate\Http\Response
     */
    public function create($scholarshipId)
    {
        $scholarship = $this->scholarshipService
        					->findRecord($scholarshipId, ['uid', 'title']);
        abort_if(! $scholarship, 404);

        $examTimes = $this->examTimes;    
        $levels = $this->levels;      

        return view('admin.scholarship_attendees.create', compact(
        	'scholarship', 'examTimes', 'levels'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ScholarshipAttendeeRequest  $request
     * @param  string  $scholarshipId
     * @return \Illuminate\Http\Response
     */
    public function store(ScholarshipAttendeeRequest $request, $scholarshipId)
    {
        $scholarship = $this->scholarshipService
        					->findRecord($scholarshipId, ['uid', 'title']);
        
        abort_if(! $scholarship, 404);

        DB::beginTransaction();
        $attendee = $this->scholarshipAttendeeService
        				->createRecord($scholarshipId, $request);
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
     * @param  string  $scholarshipId
     * @param  string  $uid
     * @return \Illuminate\Http\Response
     */
    public function edit($scholarshipId, $uid)
    {
        $scholarship = $this->scholarshipService->findRecord($scholarshipId);
        $attendee = $this->scholarshipAttendeeService->findRecord($uid);

        $examTimes = $this->examTimes;    
        $levels = $this->levels; 
        
        abort_if(! $attendee || ! $scholarship, 404);

        return view('admin.scholarship_attendees.edit', compact(
        	'attendee', 'scholarship', 'examTimes', 'levels'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ScholarshipAttendeeRequest  $request
     * @param  string  $scholarshipId
     * @param  string  $uid
     * @return \Illuminate\Http\Response
     */
    public function update(ScholarshipAttendeeRequest $request, $scholarshipId, $uid)
    {
        $scholarship = $this->scholarshipService->findRecord($scholarshipId);
        $attendee = $this->scholarshipAttendeeService->findRecord($uid);
        
        abort_if(! $attendee || ! $scholarship, 404);

        DB::beginTransaction();
        $this->scholarshipAttendeeService->updateRecord($uid, $request);
        DB::commit();
        
        return redirect()->route('admin.scholarship_attendees.index', $scholarship->uid)
        				->withSuccess('Updated successfully.');
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
        $this->scholarshipAttendeeService->deleteRecord($uid);
        DB::commit();

        return redirect()->back()->withSuccess('Deleted successfully!');
    }

    /**
     * Checkin attendee into a scholarship.
     *
     * @param  string  $scholarshipId
     * @return \Illuminate\Http\Response
     */
    public function checkIn($scholarshipId)
    {
        $scholarship = $this->scholarshipService->findRecord($scholarshipId, ['uid', 'title']);

        abort_if(! $scholarship, 404);

        $attendees = collect([]);

        if (request()->query('search')) {
            $search = request()->query('search');
            $attendees = $this->scholarshipAttendeeService->searchRecords($search, $scholarshipId);
        }

        return view('admin.scholarship_attendees.check_in', compact('attendees', 'scholarship'));
    }

    /**
     * Change the check-in status of an attendee.
     *
     * @param  string  $scholarshipId
     * @param  string  $uid
     * @return \Illuminate\Http\Response
     */
    public function postCheckIn(Request $request, $scholarshipId, $uid)
    {
        $scholarship = $this->scholarshipService->findRecord($scholarshipId);

        abort_if(! $scholarship, 404);

        DB::beginTransaction();
        $this->scholarshipAttendeeService->updateCheckInStatus($uid, $request->checked_in_at);
        DB::commit();

        return redirect()->back()->withSuccess('Attendee check-in status has been changed.');
    }
}
