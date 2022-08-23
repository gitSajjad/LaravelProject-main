<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Admin\Ticket\AdminTicket;

class AdminTicketController extends Controller
{
   public function index()
   {
       $admins = User::where('user_type', 1)->get();
       return view('admin.ticket.adminTicket.index', compact('admins'));

   }


   public function set(User $admin)
   {

       AdminTicket::where('user_id',$admin->id)->first() ? AdminTicket::where('user_id',$admin->id)->forceDelete(): AdminTicket::create(['user_id' => $admin->id]);

       return redirect()->route('admin.ticket.adminTicket.index')->with('swal-success', 'تغییر شما با موفقیت حذف شد');
   }


}
