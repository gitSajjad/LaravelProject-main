<?php

namespace App\Http\Controllers\Admin\Content;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Content\Banner;
use App\Http\Services\Image\ImageUploadService;
use App\Http\Requests\Admin\Market\StoreBrandRequest;
use App\Http\Requests\Admin\Market\UpdateBrandRequest;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $banners = Banner::orderBy('created_at', 'desc')->simplePaginate(10);
        $positions = Banner::$positions;
        return view ('admin.content.banner.index',compact('banners','positions'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = Banner::$positions;
        return view('admin\content\banner\create',compact('positions'));
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
        if($request->hasFile('image'))
        {
            $ImageUploadService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'banner');

            $result = $ImageUploadService->createIndexAndSave($request->file('image'));
        }
        if($result === false)
        {
            return redirect()->route('Banner.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
        }
        $inputs['image'] = $result;


        $banner = Banner::create($inputs);

        return redirect()->route('Banner.index')->with('swal-success', 'بنر  شما با موفقیت ویرایش شد');
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
    public function edit(Banner $Banner)
    {
        $positions = Banner::$positions;
        return view('admin.content.banner.edit',compact('Banner','positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Banner $Banner, ImageUploadService $ImageUploadService)
    {
        $inputs = $request->all();


        if($request->hasFile('image'))
        {
            if(!empty($Banner->image))
            {
                $ImageUploadService->deleteDirectoryAndFiles($Banner->image['directory']);
            }
            $ImageUploadService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post-category');
            $result = $ImageUploadService->createIndexAndSave($request->file('image'));
            if($result === false)
            {
                return redirect()->route('admin.content.category.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }
        else{
            if(isset($inputs['currentImage']) && !empty($Banner->image))
            {
                $image = $Banner->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }
        }



        $Banner->update($inputs);
        return redirect()->route('Banner.index')->with('swal-success','اپدیت با موفقیت ثبت شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $Banner)
    {
        $Banner->delete();
        return redirect()->route('Banner.index')->with('swal-success','حذف با موفقیت ثبت شد');
    }


    public function changeStatus(Banner $banner)
    {


        $status =($banner->status == '0') ? '1' : '0';
        $banner->update(['status'=>$status]);
        return redirect()->route('Banner.index')->with('swal-success',' با موفقیت انجام شد');

    }


}
