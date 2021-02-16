<?php

namespace App\Http\Controllers\Admin;

use DB;
use Gate;
use Illuminate\Http\Request;
use App\Services\CourseService;
use App\Services\CategoryService;
use App\Http\Requests\CourseRequest;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CourseService $courseService,
        CategoryService $categoryService
    ) {
        $this->courseService = $courseService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = $this->courseService->getPaginatedRecords(25, [
            'title', 'is_live', 'uid', 'cost', 'discount', 'created_at', 'image_url'
        ]);
        
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryService->getRecords(['uid', 'name']);

        return view('admin.courses.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        DB::beginTransaction();
        $this->courseService->createRecord($request);
        DB::commit();

        return redirect()->back()->withSuccess('Created successfully');
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
     * @param  int  $uid
     * @return \Illuminate\Http\Response
     */
    public function edit($uid)
    {
        $course = $this->courseService->findRecord($uid);

        $categories = $this->categoryService->getRecords(['uid', 'name']);

        return view('admin.courses.edit', compact('course', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $uid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uid)
    {
        DB::beginTransaction();
        $this->courseService->updateRecord($uid, $request);
        DB::commit();

        return redirect()->route('admin.courses.index')->withSuccess('Updated successfully');
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
        $this->courseService->deleteRecord($uid);
        DB::commit();

        return redirect()->back()->withSuccess('Deleted successfully!');
    }
}
