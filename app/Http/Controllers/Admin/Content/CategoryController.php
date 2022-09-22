<?php

namespace App\Http\Controllers\Admin\Content;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Content\PostCategory;
use App\Http\Services\Image\ImageUploadService;
use App\Http\Requests\Admin\Content\PostCategoryRequest;
use App\Http\Requests\Admin\Content\UpdatePostCategoryRequest;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postCategories = PostCategory::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('admin.content.category.index',compact('postCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCategoryRequest $request,ImageUploadService $ImageUploadService )
    {

        $inputs = $request->all();
        if($request->hasFile('image'))
        {
            $ImageUploadService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post-category');

            $result = $ImageUploadService->createIndexAndSave($request->file('image'));
        }
        if($result === false)
        {
            return redirect()->route('admin.content.category.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
        }
        $inputs['image'] = $result;


        $PostCategories = PostCategory::create($inputs);
        return redirect()->route('category.index')->with('swal-success','دسته بندی با موفقیت ثبت شد');
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
    public function edit(PostCategory $category)

    {

        return view('admin.content.category.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostCategoryRequest $request, PostCategory $category ,ImageUploadService $imageService)
    {
       $inputs = $request->all();


       if($request->hasFile('image'))
       {
           if(!empty($category->image))
           {
               $imageService->deleteDirectoryAndFiles($category->image['directory']);
           }
           $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post-category');
           $result = $imageService->createIndexAndSave($request->file('image'));
           if($result === false)
           {
               return redirect()->route('admin.content.category.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
           }
           $inputs['image'] = $result;
       }
       else{
           if(isset($inputs['currentImage']) && !empty($category->image))
           {
               $image = $category->image;
               $image['currentImage'] = $inputs['currentImage'];
               $inputs['image'] = $image;
           }
       }

       $inputs['slug'] = null;

       $category->update($inputs);
       return redirect()->route('category.index')->with('swal-success','اپدیت با موفقیت ثبت شد');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostCategory $category)
    {
        $category->delete();
        return redirect()->route('category.index')->with('swal-success','حذف با موفقیت ثبت شد');

    }

    public function changeStatus(PostCategory $postCategory)
    {

        $status =($postCategory->status == '0') ? '1' : '0';
        $postCategory->update(['status'=>$status]);
        return redirect()->route('category.index')->with('swal-success',' با موفقیت انجام شد');
    }

}
