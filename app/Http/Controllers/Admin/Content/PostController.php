<?php

namespace App\Http\Controllers\Admin\Content;

use Illuminate\Http\Request;
use App\Models\Admin\Content\Post;
use App\Http\Controllers\Controller;
use App\Models\Admin\Content\PostCategory;
use App\Http\Services\Image\ImageUploadService;
use App\Http\Requests\Admin\Content\StorPostRequest;
use App\Http\Requests\Admin\Content\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('admin.content.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $postCategories = PostCategory::all();
        return view('admin.content.post.create',compact('postCategories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorPostRequest $request ,ImageUploadService $ImageUploadService  )
    {


        $inputs = $request->all();

        $realTimestampStart = substr($request->published_at ,0,10);
        $inputs['published_at'] =date('Y-m-d H:i:s', (int)$realTimestampStart);

        if($request->hasFile('image'))
        {
            $ImageUploadService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post');

            $result = $ImageUploadService->createIndexAndSave($request->file('image'));

            if($result === false)
            {
                return redirect()->route('post.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }



        $inputs['author_id'] = 1;
        $posts = Post::create($inputs);
        return redirect()->route('post.index')->with('swal-success','پست  با موفقیت ثبت شد');


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
    public function edit(Post $post)
    {


        $postCategories = PostCategory::all();
        return view('admin.content.post.edit' ,compact('post','postCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post ,ImageUploadService $imageService )
    {

        $inputs = $request->all();
        $realTimestampStart = substr($request->published_at ,0,10);
        $inputs['published_at'] =date('Y-m-d H:i:s', (int)$realTimestampStart);


        if ($request->hasFile('image')) {
            if (!empty($post->image)) {
                $imageService->deleteDirectoryAndFiles($post->image['directory']);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if ($result === false) {
                return redirect()->route('admin.content.post.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        } else {
            if (isset($inputs['currentImage']) && !empty($post->image)) {
                $image = $post->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }
        }


        $post->update($inputs);
        return redirect()->route('post.index')->with('swal-success','اپدیت با موفقیت ثبت شد');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index')->with('swal-success','  حذف با موفقیت انجام شد ');

    }


    public function changeStatus(Post $post)
    {
        $status =($post->status == '0') ? '1' : '0';
        $post->update(['status'=>$status]);
        return redirect()->route('post.index')->with('swal-success',' با موفقیت انجام شد');
    }
}
