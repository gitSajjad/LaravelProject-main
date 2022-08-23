<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\Image\ImageUploadService;
use App\Http\Requests\Admin\User\StoreCustomerRequest;
use App\Http\Requests\Admin\User\UpdateCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('user_type', 0)->get();
        return view('admin.user.customer.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.customer.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request , ImageUploadService $ImageUploadService)
    {
        $inputs = $request->all();
        if ($request->hasFile('profile_photo_path'))
        {
            $ImageUploadService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $ImageUploadService->save($request->file('profile_photo_path'));

            if ($result === false) {
                return redirect()->route('customer.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['profile_photo_path'] = $result;
        }
        $inputs['password'] = Hash::make($request->password);
        $inputs['user_type'] = 0;
        $user = User::create($inputs);
        return redirect()->route('customer.index')->with('swal-success', 'ادمین جدید با موفقیت ثبت شد');
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
    public function edit(User $customer)
    {
        return view('admin.user.customer.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request,User $customer, ImageUploadService $ImageUploadService)
    {

        $inputs = $request->all();

        if($request->hasFile('profile_photo_path'))
        {
            if(!empty($customer->profile_photo_path))
            {
                $ImageUploadService->deleteImage($customer->profile_photo_path);
            }
            $ImageUploadService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $ImageUploadService->save($request->file('profile_photo_path'));
            if($result === false)
            {
                return redirect()->route('customer.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['profile_photo_path'] = $result;
        }
        $customer->update($inputs);
        return redirect()->route('customer.index')->with('swal-success', 'ادمین سایت شما با موفقیت ویرایش شد');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $customer)
    {
        $result = $customer->forceDelete();
        return redirect()->route('customer.index')->with('swal-success', 'مشتری شما با موفقیت حذف شد');
    }



    public function activation(User $user)
    {

        $user->activation = $user->activation == 0 ? 1 : 0;
        $user->save();
        return redirect()->route('customer.index')->with('swal-success',' با موفقیت انجام شد');

    }



    public function changeStatus(User $user)
    {
        $status =($user->status == '0') ? '1' : '0';
        $user->update(['status'=>$status]);
        return redirect()->route('customer.index')->with('swal-success',' با موفقیت انجام شد');
    }


}
