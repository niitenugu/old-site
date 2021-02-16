<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\JobService;

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
     * Display all the jobs available
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$jobs = $this->jobService->getAvailableJobs(24);

    	$jobs = $jobs->count() > 0 ? $jobs : collect([]);

    	return view('jobs', compact('jobs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
    	$job = $this->jobService->findBySlug($slug, 'slug');

        abort_if(! $job, 404);

        return view('job_details', compact('job'));
    }

}
