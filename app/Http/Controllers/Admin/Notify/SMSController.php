<?php

namespace App\Http\Controllers\Admin\notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\StoreSMSRequest;
use App\Http\Requests\Admin\Notify\UpdateSMSRequest;
use App\Models\Admin\Notify\SMS;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sms = SMS::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('admin.notify.sms.index' , compact('sms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notify.sms.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSMSRequest $request)
    {

        $inputs = $request->all();
        $realTimestampStart = substr($request->published_at ,0,10);
        $inputs['published_at'] =date('Y-m-d H:i:s', (int)$realTimestampStart);
        $sms = SMS::create($inputs);
        return redirect()->route('sms.index')->with('swal-success','پیامک  با موفقیت ثبت شد');

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
    public function edit(SMS $sms)
    {
        return view('admin.notify.sms.edit', compact('sms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSMSRequest $request, SMS $sms)
    {
        $inputs = $request->all();
        $realTimestampStart = substr($request->published_at ,0,10);
        $inputs['published_at'] =date('Y-m-d H:i:s', (int)$realTimestampStart);


        $sms->update($inputs);
        return redirect()->route('sms.index')->with('swal-success','پیامک  با موفقیت تغییر کرد');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SMS $sms)
    {
        $sms->delete();
        return redirect()->route('sms.index')->with('swal-success','  حذف با موفقیت انجام شد');


    }

    public function changeStatus(SMS $sms)
    {
        $status =($sms->status == '0') ? '1' : '0';
        $sms->update(['status'=>$status]);
        return redirect()->route('sms.index')->with('swal-success','  وضعیت با موفقیت تغییر کرد');
    }
}
