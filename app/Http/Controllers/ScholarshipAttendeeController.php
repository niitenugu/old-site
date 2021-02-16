<?php

namespace App\Http\Controllers;

use DB;
use Gate;
use Illuminate\Http\Request;
use App\Mail\ScholarshipInvitation;
use App\Services\ScholarshipService;
use App\Services\ScholarshipAttendeeService;
use App\Http\Requests\ScholarshipAttendeeRequest;

class ScholarshipAttendeeController extends Controller
{
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
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ScholarshipAttendeeRequest  $request
     * @param  string  $scholarshipId
     * @return \Illuminate\Http\Response
     */
    public function store(ScholarshipAttendeeRequest $request)
    {
        $scholarship = $this->scholarshipService
        					->findRecord($request->scholarship_id, ['uid', 'title']);
        
        abort_if(! $scholarship, 404);

        DB::beginTransaction();
        $attendee = $this->scholarshipAttendeeService
        				->createRecord($request->scholarship_id, $request);
        DB::commit();

        if ($attendee) {
        	try {
            	\Mail::to($attendee->email)->send(new ScholarshipInvitation($attendee));

            } catch(\Swift_TransportException $e) {
    			$e;
			}
        }

        return redirect()->back()->withSuccess('Successful! Please, check your inbox or spam for your invitation code.');
    }
}
