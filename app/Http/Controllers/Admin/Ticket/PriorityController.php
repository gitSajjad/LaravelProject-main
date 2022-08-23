<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\StorePriorityRequest;
use App\Http\Requests\Admin\Ticket\UpdatePriorityRequest;
use App\Models\Admin\Ticket\Priority;
use Illuminate\Http\Request;

class PriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ticketPriorities = Priority::all();
       return view('admin.ticket.priority.index',compact('ticketPriorities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Priority $priority)
    {
        return view('admin.ticket.priority.create',compact('priority'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePriorityRequest $request)
    {
        $inputs = $request->all();
        $priority = Priority::create($inputs);
        return redirect()->route('admin.ticket.priority.index')->with('swal-success', 'اولویت  جدید شما با موفقیت ثبت شد');

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
    public function edit(Priority $priority)
    {
        return view('admin.ticket.priority.edit',compact('priority'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePriorityRequest $request, Priority $priority)
    {
        $inputs = $request->all();
        $priority->update($inputs);
        return redirect()->route('admin.ticket.priority.index')->with('swal-success', 'اولویت  با موفقیت ویرایش شد');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Priority $priority)
    {
        $priority->delete();
        return redirect()->route('admin.ticket.priority.index')->with('swal-success',' ,حذف با موفقیت انجام شد');


    }


    public function changeStatus(Priority $priority)
    {

        $priority->status = $priority->status == 0 ? 1 : 0;
        $priority->save();
        return redirect()->route('admin.ticket.priority.index')->with('swal-success',' با موفقیت انجام شد');
    }
}
