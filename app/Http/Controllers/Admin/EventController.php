<?php

namespace App\Http\Controllers\Admin;

use DB;
use Gate;
use Illuminate\Http\Request;
use App\Services\EventService;
use App\Http\Requests\EventRequest;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EventService $eventService) 
    {
        $this->eventService = $eventService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = $this->eventService->getPaginatedRecords(25);
        
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\EventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        DB::beginTransaction();
        $this->eventService->createRecord($request);
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
        $event = $this->eventService->findRecord($uid);

        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EventRequest  $request
     * @param  string  $uid
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, $uid)
    {
        DB::beginTransaction();
        $this->eventService->updateRecord($uid, $request);
        DB::commit();

        return redirect()->route('admin.events.index')->withSuccess('Updated successfully.');
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
        $this->eventService->deleteRecord($uid);
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
        $this->eventService->updateStatus($uid, $request->is_live);
        DB::commit();

        return redirect()->back()->withSuccess('Status changed successfully.');
    }
}
