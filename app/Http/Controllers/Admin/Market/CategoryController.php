<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Market\Category;
use App\Http\Services\Image\ImageUploadService;
use App\Http\Requests\Admin\Market\StoreProductCategoryRequest;
use App\Http\Requests\Admin\Market\UpdateProductCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productCategories = Category::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('admin.market.marketCategory.index', compact('productCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id', null)->get();
      return view('admin.market.marketCategory.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductCategoryRequest $request , ImageUploadService $ImageUploadService)
    {
        $inputs = $request->all();
        if($request->hasFile('image'))
        {
            $ImageUploadService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product-category');

            $result = $ImageUploadService->createIndexAndSave($request->file('image'));
        }
        if($result === false)
        {
            return redirect()->route('marketCategory.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
        }
        $inputs['image'] = $result;
        $ProductCategories = Category::create($inputs);
        return redirect()->route('marketCategory.index')->with('swal-success','دسته بندی با موفقیت ثبت شد');
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
    public function edit(Category $marketCategory)
    {
        $parent_categories = Category::where('parent_id', null)->get();

        return view('admin.market.marketCategory.edit',compact('parent_categories','marketCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductCategoryRequest $request, Category $marketCategory, ImageUploadService $ImageUploadService)
    {
        $inputs = $request->all();


        if($request->hasFile('image'))
        {
            if(!empty($marketCategory->image))
            {
                $ImageUploadService->deleteDirectoryAndFiles($marketCategory->image['directory']);
            }
            $ImageUploadService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product-category');
            $result = $ImageUploadService->createIndexAndSave($request->file('image'));
            if($result === false)
            {
                return redirect()->route('marketCategory.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }
        else{
            if(isset($inputs['currentImage']) && !empty($marketCategory->image))
            {
                $image = $marketCategory->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }
        }

        $inputs['slug'] = null;

        $marketCategory->update($inputs);
        return redirect()->route('marketCategory.index')->with('swal-success','اپدیت با موفقیت ثبت شد');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $marketCategory)
    {
        $marketCategory->delete();
        return redirect()->route('marketCategory.index')->with('swal-success','حذف با موفقیت ثبت شد');


    }

    public function changeStatus(Category $marketCategory)
    {
        $status =($marketCategory->status == '0') ? '1' : '0';
        $marketCategory->update(['status'=>$status]);
        return redirect()->route('marketCategory.index')->with('swal-success',' با موفقیت انجام شد');
    }
}
