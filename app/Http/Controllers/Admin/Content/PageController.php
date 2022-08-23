<?php

namespace App\Http\Controllers\Admin\Content;

use Illuminate\Http\Request;
use App\Models\Admin\Content\Page;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\content\StorePageRequest;
use App\Http\Requests\Admin\content\UpdatePageRequest;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();
        return view('admin.content.page.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.page.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePageRequest $request)
    {


       $inputs = $request->all();

       $pages = Page::create($inputs);
       return redirect()->route('page.index')->with('swal-success','دسته بندی با موفقیت ثبت شد');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('admin.content.page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        $inputs = $request->all();

        $page->update($inputs);
        return redirect()->route('page.index')->with('swal-success','دسته بندی با موفقیت اپدیت شد');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('page.index')->with('swal-success','دسته بندی با موفقیت اپدیت شد');
    }

    public function changeStatus(Page $page)
    {
        $status =($page->status == '0') ? '1' : '0';
        $page->update(['status'=>$status]);
        return redirect()->route('page.index')->with('swal-success',' با موفقیت انجام شد');
    }
}
