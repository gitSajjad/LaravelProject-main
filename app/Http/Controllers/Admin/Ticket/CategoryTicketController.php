<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\StoreCategoryTicketRequest;
use App\Http\Requests\Admin\Ticket\UpdateCategoryTicketRequest;
use App\Models\Admin\Ticket\CategoryTicket;
use App\Models\Admin\Ticket\Ticket;
use Illuminate\Http\Request;

class CategoryTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ticketCategories = CategoryTicket::all();
        return view('admin.ticket.categoryTicket.index',compact('ticketCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ticket.categoryTicket.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryTicketRequest $request)
    {
        $inputs = $request->all();
        $categoryTicket = CategoryTicket::create($inputs);
        return redirect()->route('admin.ticket.categoryTicket.index')->with('swal-success','دسته بندی با موفقیت ثبت شد');

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
    public function edit(CategoryTicket $categoryTicket)
    {

        return view('admin.ticket.categoryTicket.edit',compact('categoryTicket'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryTicketRequest $request, CategoryTicket $categoryTicket)
    {
        $inputs = $request->all();
        $categoryTicket ->update($inputs);
        return redirect()->route('admin.ticket.categoryTicket.index')->with('swal-success',' ,ویرایش با موفقیت ثبت شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryTicket $categoryTicket)
    {
        $categoryTicket->delete();
        return redirect()->route('admin.ticket.categoryTicket.index')->with('swal-success',' ,حذف با موفقیت انجام شد');

    }


    public function changeStatus(CategoryTicket $categoryTicket)
    {
     
        $categoryTicket->status = $categoryTicket->status == 0 ? 1 : 0;
        $categoryTicket->save();
        return redirect()->back()->with('swal-success',' با موفقیت انجام شد');
    }

}
