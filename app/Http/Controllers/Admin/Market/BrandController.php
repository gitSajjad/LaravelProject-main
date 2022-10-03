<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Admin\Market\Brand;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageUploadService;
use App\Http\Requests\Admin\Market\StoreBrandRequest;
use App\Http\Requests\Admin\Market\UpdateBrandRequest;
use PhpParser\Node\Stmt\Return_;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('admin.market.brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.market.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request ,ImageUploadService $ImageUploadService)
    {
    

        $inputs = $request->all();
        if($request->hasFile('logo'))
        {
            $ImageUploadService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'brand');
            $result = $ImageUploadService->createIndexAndSave($request->file('logo'));
        }
        if($result === false)
        {
            return redirect()->route('brand.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
        }
        $inputs['logo'] = $result;


        $brand = Brand::create($inputs);
        return redirect()->route('brand.index')->with('swal-success', 'برند جدید شما با موفقیت ثبت شد');
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
    public function edit(Brand $brand)
    {
        return view('admin.market.brand.edit',compact('brand'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand , ImageUploadService $ImageUploadService)
    {
        $inputs = $request->all();


        if($request->hasFile('logo'))
        {
            if(!empty($brand->logo))
            {
                $ImageUploadService->deleteDirectoryAndFiles($brand->logo['directory']);
            }
            $ImageUploadService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'Brand');
            $result = $ImageUploadService->createIndexAndSave($request->file('logo'));
            if($result === false)
            {
                return redirect()->route('brand.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['logo'] = $result;
        }
        else{
            if(isset($inputs['currentImage']) && !empty($brand->logo))
            {
                $image = $brand->logo;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }
        }

        $inputs['slug'] = null;

        $brand->update($inputs);
        return redirect()->route('brand.index')->with('swal-success','اپدیت با موفقیت ثبت شد');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('brand.index')->with('swal-success','حذف با موفقیت ثبت شد');
    }



    public function changeStatus(Brand $brand)
    {
        $status =($brand->status == '0') ? '1' : '0';
        $brand->update(['status'=>$status]);
        return redirect()->route('brand.index')->with('swal-success',' با موفقیت انجام شد');
    }


}
