<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Admin\Market\Brand;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Admin\Market\Product;
use App\Models\Admin\Market\Category;
use App\Models\Admin\Market\ProductMeta;
use App\Http\Services\Image\ImageUploadService;
use App\Http\Requests\Admin\Market\StoreProductRequest;
use App\Http\Requests\Admin\Market\StorePruductRequest;
use App\Http\Requests\Admin\Market\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('admin.market.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories =Category::all();
        $brands = Brand::all();
        return view('admin.market.product.create',compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request, ImageUploadService $ImageUploadService)
    {
        $inputs = $request->all();
        //date fixed
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date("Y-m-d H:i:s", (int)$realTimestampStart);

       if($request->hasFile('image'))
       {
           $ImageUploadService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'Product');
           $result = $ImageUploadService->createIndexAndSave($request->file('image'));
       }
       if($result === false)
       {
           return redirect()->route('product.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
       }
       $inputs['image'] = $result;

       DB::transaction(function () use ($request, $inputs) {
       $product = Product::create($inputs);
       $metas = array_combine($request->meta_key, $request->meta_value);
       foreach($metas as $key => $value){
           $meta = ProductMeta::create([
               'meta_key' => $key,
               'meta_value' => $value,
               'product_id' => $product->id
           ]);
       }
   });
       return redirect()->route('product.index')->with('swal-success', 'محصول جدید شما با موفقیت ثبت شد');

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
    public function edit(Product $product)
    {
        $categories =Category::all();
        $brands = Brand::all();
        return view('admin.market.product.edit',compact('product','brands','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product , ImageUploadService $ImageUploadService)
    {
        $inputs = $request->all();
        //date fixed
        $realTimestampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date("Y-m-d H:i:s", (int)$realTimestampStart);

        if ($request->hasFile('image')) {
            if (!empty($product->image))
            {
                $ImageUploadService->deleteDirectoryAndFiles($product->image['directory']);
            }

            $ImageUploadService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product');
            $result = $ImageUploadService->createIndexAndSave($request->file('image'));

            if ($result === false)
            {
                return redirect()->route('product.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }

        else
         {
            if (isset($inputs['currentImage']) && !empty($product->image)) {
                $image = $product->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }
        }

        $product->update($inputs);
        if( $request->meta_key != null){
        $meta_keys = $request->meta_key;
        $meta_values = $request->meta_value;
        $meta_ids = array_keys($request->meta_key);
        $metas = array_map(function ($meta_id, $meta_key, $meta_value){
            return array_combine(
                ['meta_id', 'meta_key', 'meta_value'],
                [$meta_id, $meta_key, $meta_value]
            );
        }, $meta_ids, $meta_keys, $meta_values);
        foreach($metas as $meta){
            ProductMeta::where('id', $meta['meta_id'])->update([
                'meta_key' => $meta['meta_key'], 'meta_value' => $meta['meta_value']
            ]);

        }
    }
        return redirect()->route('product.index')->with('swal-success', 'محصول  شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('swal-success', 'محصول  شما با موفقیت حذف شد');
    }
}
