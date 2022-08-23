@extends('admin.layouts.master')

@section('head-tag')
<title>روش ارسال</title>
@endsection
@section('countint')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> روش های ارسال </li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    روش های ارسال
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('deliver.create') }}" class="btn btn-info btn-sm">ایجاد روش ارسال جدید </a>
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام روش ارسال</th>
                            <th>هزینه ارسال</th>
                            <th>زمان ارسال</th>
                            <th> وضعیت </th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($delivery_methods as $delivery_method )
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td> {{ $delivery_method->name }}	</td>
                            <td>{{ $delivery_method->amount  }} تومان</td>
                            <td> {{$delivery_method->delivery_time . '_' . $delivery_method->delivery_time_unit    }} </td>
                            <td>

                                @if ($delivery_method->status == 0)

                                <span class="text-success">enable</span>
                                @else
                                <span class="text-danger">disable</span>
                                @endif


                            </td>
                            <td class="width-16-rem text-left">
                                <a href="{{ route('deliver.changeStatus',$delivery_method->id) }}" class="btn btn-warning btn-sm">وضعیت</a>
                                <a href="{{ route('deliver.edit',$delivery_method->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form class="d-inline" action="{{ route('deliver.destroy',$delivery_method->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>
                            </form>                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </section>

        </section>
    </section>
</section>

@endsection
@section('scripts')
@include('alerts.delete-confirm',['className' => 'delete'])
@endsection

