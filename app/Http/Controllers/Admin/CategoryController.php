<?php

namespace App\Http\Controllers\Admin;

use DB;
use Gate;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryService->getRecords([
            'name', 'created_at', 'is_live', 'uid'
        ]);
        
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('isAdminGroup'), 403);

        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        abort_unless(Gate::allows('isAdminGroup'), 403);

        DB::beginTransaction();
        $this->categoryService->createRecord($request);
        DB::commit();

        return redirect()->back()->withSuccess('Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $uid
     * @return \Illuminate\Http\Response
     */
    public function show($uid)
    {
        return abort('404');
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

        $category = $this->categoryService->findRecord($uid);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  string  $uid
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $uid)
    {
        abort_unless(Gate::allows('isAdminGroup'), 403);

        DB::beginTransaction();
        $this->categoryService->updateRecord($uid, $request);
        DB::commit();

        return redirect()->route('admin.categories.index')->withSuccess('Updated successfully');
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
        $this->categoryService->deleteRecord($uid);
        DB::commit();

        return redirect()->back()->withSuccess('Deleted successfully!');
    }
}
