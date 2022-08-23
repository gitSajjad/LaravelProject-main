<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Admin\Market\Product;
use App\Http\Requests\Admin\Market\StoreAddToStoreRequest;
use App\Http\Requests\Admin\Market\UpdateAddToStoreRequest;

class StorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->simplePaginate(10);
       return view('admin.market.store.index',compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addToStore(Product $product)
    {
        return view('admin.market.store.addToStore',compact('product'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAddToStoreRequest $request , Product $product)
    {

        $product->marketable_number += $request->marketable_number;
        $product->save();
        Log::info("receiver => {$request->receiver}, deliverer => {$request->deliverer}, description => {$request->description}, add => {$request->marketable_number}");
        return redirect()->route('store.index')->with('swal-success', 'موجودی جدید با موفقیت ثبت شد');


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
        return view('admin.market.store.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAddToStoreRequest $request, Product $product)
    {
      $inputs = $request->all();
      $product->update($inputs);
      return redirect()->route('store.index')->with('swal-success', 'موجودی  با موفقیت ویرایش شد');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
