<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\StoreDeliveryRequest;
use App\Http\Requests\Admin\Market\UpdateDeliveryRequest;
use App\Models\Admin\Market\Delivery;
use Illuminate\Http\Request;

class DeliverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delivery_methods = Delivery::all();
        return view('admin.market.deliver.index',compact('delivery_methods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.market.deliver.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeliveryRequest $request)
    {
        $inputs = $request->all();
        $delivery = Delivery::create($inputs);
        return redirect()->route('deliver.index')->with('swal-success', 'پست  با موفقیت ثبت شد');

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
    public function edit(Delivery $deliver)
    {
        return view('admin.market.deliver.edit',compact('deliver'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeliveryRequest $request, Delivery $deliver)
    {
       $inputs = $request->all();
       $deliver->update($inputs);
       return redirect()->route('deliver.index')->with('swal-success', 'پست  با موفقیت ویرایش شد');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delivery $deliver)
    {
        $deliver->delete();
        return redirect()->route('deliver.index')->with('swal-success','حذف با موفقیت ثبت شد');
    }


    public function changeStatus(Delivery $delivery)
    {
        $status =($delivery->status == '0') ? '1' : '0';
        $delivery->update(['status'=>$status]);
        return redirect()->back()->with('swal-success',' با موفقیت انجام شد');
    }
}
