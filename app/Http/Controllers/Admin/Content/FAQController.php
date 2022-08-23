<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\StoreFaqRequest;
use App\Http\Requests\Admin\Content\UpdateFaqRequest;
use App\Models\Admin\Content\Faq;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::orderBy('created_at', 'DESC')->simplePaginate(10);
       return view('admin.content.faq.index' , compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.faq.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFaqRequest $request, Faq $faq)
    {

        $inputs = $request->all();

        $faq = Faq::create($inputs);
        return redirect()->route('faq.index')->with('swal-success', 'پست  با موفقیت ثبت شد');

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
    public function edit(Faq $faq)
    {
        return view('admin.content.faq.edit',compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFaqRequest $request, Faq $faq)
    {
        $inputs = $request->all();
        $inputs['slug'] = null;
        $faq->update($inputs);
        return redirect()->route('faq.index')->with('swal-success', 'پست  با موفقیت ثبت شد');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $faq -> delete();
        return redirect()->route('faq.index')->with('swal-success', 'پست  با موفقیت حذف شد');

    }


    public function changeStatus(Faq $faq)
    {
        $status =($faq->status == '0') ? '1' : '0';
        $faq->update(['status'=>$status]);
        return redirect()->route('faq.index')->with('swal-success',' با موفقیت انجام شد');
    }
}
