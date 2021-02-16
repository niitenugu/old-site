<?php

namespace App\Http\Controllers\Admin;

use DB;
use Gate;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('isAdminGroup'), 403);

        $users = $this->userService->getPaginatedRecords(25);

        return view('admin.users.index', compact('users'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('isAdminGroup'), 403);

        $roles = $this->userService->getAvailableRoles();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        abort_unless(Gate::allows('isAdminGroup'), 403);

        DB::beginTransaction();
        $this->userService->createRecord($request);
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
        abort_unless(Gate::allows('isAdminGroup'), 403);

        $roles = $this->userService->getAvailableRoles();
        $user = $this->userService->findRecord($uid);

        // ONLY owner can delete another owner. No other role can delete owner
        if (auth()->user()->role != 'owner' && $user->role == 'owner') {
            return redirect()->back()->withWarning("You don't have permission to edit this user!");
        }

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $uid
     * @param  \App\Http\Requests\UserRequest $request
     */
    public function update(UserRequest $request, $uid)
    {
        abort_unless(Gate::allows('isAdminGroup'), 403);

        DB::beginTransaction();
        $this->userService->updateRecord($uid, $request);
        DB::commit();

        return redirect()->route('admin.users.index')->withSuccess('Updated successfully');
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

        $user = $this->userService->findRecord($uid, ['role']);

        // ONLY owner can delete another owner. No other role can delete owner
        if (auth()->user()->role != 'owner' && $user->role == 'owner') {
            return redirect()->back()->withWarning("You don't have permission to delete this user!");
        }

        DB::beginTransaction();
        $this->userService->deleteRecord($uid);
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
        abort_unless(Gate::allows('isAdminGroup'), 403);

        $user = $this->userService->findRecord($uid, ['role']);

        // ONLY owner can delete another owner. No other role can delete owner
        if (auth()->user()->role != 'owner' && $user->role == 'owner') {
            return redirect()->back()->withWarning("You don't have permission to change this user's status!");
        }

        DB::beginTransaction();
        $this->userService->updateStatus($uid, $request->is_live);
        DB::commit();

        return redirect()->back()->withSuccess('Status changed successfully.');
    }
}
