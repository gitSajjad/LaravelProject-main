<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\StorMenuRequest;
use App\Http\Requests\Admin\Content\UpdateMenuRequest;
use App\Models\Admin\Content\Menu;
use Illuminate\Http\Request;
use League\CommonMark\Extension\Mention\Mention;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::orderBy('created_at', 'DESC')->simplePaginate(10);
        return view('admin.content.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::all();
        return view('admin.content.menu.create',compact('menus'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorMenuRequest $request)
    {
       $inputs = $request->all();
       $menus = Menu::create($inputs);
       return redirect()->route('menu.index')->with('swal-success','دسته بندی  با موفقیت انجام شد ');
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
    public function edit(Menu $menu)
    {

        $parent_menus = Menu::all();
       return view('admin.content.menu.edit',compact('parent_menus', 'menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $inputs = $request->all();
        $menu->update($inputs);
        return redirect()->route('menu.index')->with('swal-success',' با موفقیت انجام شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menu.index')->with('swal-success',' با موفقیت انجام شد');

    }


    public function changeStatus(Menu $menu)
    {


        $status =($menu->status == '0') ? '1' : '0';
        $menu->update(['status'=>$status]);
        return redirect()->route('menu.index')->with('swal-success',' با موفقیت انجام شد');
    }

}
