<?php

namespace App\Http\Controllers\Admin;

use DB;
use Gate;
use Illuminate\Http\Request;
use App\Services\JobService;
use App\Http\Requests\JobRequest;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$jobs = $this->jobService->getPaginatedRecords(25);

        return view('admin.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\JobRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobRequest $request)
    {
        DB::beginTransaction();
        $this->jobService->createRecord($request);
        DB::commit();

        return redirect()->back()->withSuccess('Created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $uid
     * @return \Illuminate\Http\Response
     */
    public function edit($uid)
    {
        $job = $this->jobService->findRecord($uid);

        return view('admin.jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\JobRequest  $request
     * @param  string  $uid
     * @return \Illuminate\Http\Response
     */
    public function update(JobRequest $request, $uid)
    {
        DB::beginTransaction();
        $this->jobService->updateRecord($uid, $request);
        DB::commit();

        return redirect()->route('admin.jobs.index')->withSuccess('Updated successfully.');
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
        $this->jobService->deleteRecord($uid);
        DB::commit();

        return redirect()->back()->withSuccess('Deleted successfully!');
    }

}
