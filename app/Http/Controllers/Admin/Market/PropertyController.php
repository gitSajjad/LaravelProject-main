<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\StoreCategoryAttributRequest;
use App\Http\Requests\Admin\Market\UpdateCategoryAttributRequest;
use App\Models\Admin\Market\Category;
use App\Models\Admin\Market\CategoryAttribute;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = CategoryAttribute::all();
       return view('admin.market.property.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.market.property.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryAttributRequest $request)
    {


        $inputs = $request->all();
        $category = CategoryAttribute::create($inputs);
        return redirect()->route('property.index')->with('swal-success', 'ایجاد فرم کالا با موفقیت ثبت شد');


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
    public function edit(CategoryAttribute $property)
    {
        $categories = Category::all();
        return view('admin.market.property.edit',compact('property','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryAttributRequest $request, CategoryAttribute $property)
    {
        $inputs = $request->all();
        $property -> update($inputs);
        return redirect()->route('property.index')->with('swal-success', 'ویرایش فرم کالا با موفقیت ثبت شد');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryAttribute $property)
    {
        $property->delete();
        return redirect()->route('property.index')->with('swal-success', 'حذف فرم کالا با موفقیت ثبت شد');

    }
}
