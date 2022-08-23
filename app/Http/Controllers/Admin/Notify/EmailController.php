<?php

namespace App\Http\Controllers\Admin\notify;

use Illuminate\Http\Request;
use App\Models\Admin\Notify\Email;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\StoreEmailRequest;
use App\Http\Requests\Admin\Notify\UpdateEmailRequest;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails = Email::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('admin.notify.email.index',compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notify.email.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmailRequest $request)
    {
        $inputs = $request->all();
        $realTimestampStart = substr($request->published_at ,0,10);
        $inputs['published_at'] =date('Y-m-d H:i:s', (int)$realTimestampStart);

        $email = Email::create($inputs);
        return redirect()->route('email.index')->with('swal-success','ایمیل  با موفقیت ثبت شد');

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
    public function edit(Email $email)
    {
        return view('admin.notify.email.edit',compact('email'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmailRequest $request, Email $email)
    {
      $inputs = $request->all();
      $realTimestampStart = substr($request->published_at ,0,10);
      $inputs['published_at'] =date('Y-m-d H:i:s', (int)$realTimestampStart);

      $email->update($inputs);
      return redirect()->route('email.index')->with('swal-success','ایمیل  با موفقیت اپدیت  شد');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        $email->delete();
        return redirect()->route('email.index')->with('swal-success','  حذف با موفقیت انجام شد');

    }

    public function changeStatus(Email $email)
    {
        $status =($email->status == '0') ? '1' : '0';
        $email->update(['status'=>$status]);
        return redirect()->route('email.index')->with('swal-success','  وضعیت با موفقیت تغییر کرد');
    }
}
