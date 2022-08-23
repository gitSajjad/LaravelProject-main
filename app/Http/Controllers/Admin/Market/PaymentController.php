<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Admin\Market\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        return view('admin.market.peyment.index',compact('payments'));
    }

    public function online()
    {

        $payments = Payment::where('paymentable_type', 'App\Models\Admin\Market\PaymentOnline')->get();
        return view('admin.market.peyment.index',compact('payments'));
    }

    public function offline()
    {

        $payments = Payment::where('paymentable_type', 'App\Models\Admin\Market\PaymentOffline')->get();
        return view('admin.market.peyment.index',compact('payments'));
    }


    public function cash()
    {

        $payments = Payment::where('paymentable_type', 'App\Models\Admin\Market\PaymentCash')->get();
        return view('admin.market.peyment.index',compact('payments'));
    }

    public function canceled(Payment $payment)
    {
        $payment->status = 2;
        $payment->save();
        return redirect()->back()->with('swal-success', 'تغییر شما با موفقیت انجام شد');
    }

    public function returned(Payment $payment)
    {
        $payment->status = 3;
        $payment->save();
        return redirect()->back()->with('swal-success', 'تغییر شما با موفقیت انجام شد');
    }


    public function show(Payment $payment)
    {
        return view('admin.market.peyment.show', compact('payment'));
    }


}
