<?php

namespace App\Http\Controllers\Admin;

use DB;
use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ScholarshipService;
use App\Http\Requests\ScholarshipRequest;

class ScholarshipController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ScholarshipService $scholarshipService) 
    {
        $this->scholarshipService = $scholarshipService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scholarships = $this->scholarshipService->getPaginatedRecords(25);
        
        return view('admin.scholarships.index', compact('scholarships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.scholarships.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ScholarshipRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScholarshipRequest $request)
    {
        DB::beginTransaction();
        $this->scholarshipService->createRecord($request);
        DB::commit();

        return redirect()->back()->withSuccess('Created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $uid
     * @return \Illuminate\Http\Response
     */
    public function edit($uid)
    {
        $scholarship = $this->scholarshipService->findRecord($uid);

        return view('admin.scholarships.edit', compact('scholarship'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ScholarshipRequest  $request
     * @param  string  $uid
     * @return \Illuminate\Http\Response
     */
    public function update(ScholarshipRequest $request, $uid)
    {
        DB::beginTransaction();
        $this->scholarshipService->updateRecord($uid, $request);
        DB::commit();

        return redirect()->route('admin.scholarships.index')->withSuccess('Updated successfully.');
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
        $this->scholarshipService->deleteRecord($uid);
        DB::commit();

        return redirect()->back()->withSuccess('Deleted successfully!');
    }

    /**
     * Change the status of the specified resource from storage.
     *
     * @param  string  $uid
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request, $uid)
    {
        DB::beginTransaction();
        $this->scholarshipService->updateStatus($uid, $request->is_live);
        DB::commit();

        return redirect()->back()->withSuccess('Status changed successfully.');
    }
}
