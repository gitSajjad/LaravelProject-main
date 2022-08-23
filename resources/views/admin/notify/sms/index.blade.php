@extends('admin.layouts.master')

@section('head-tag')
<title>اطلاعیه پیامکی</title>
@endsection


@section('countint')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">اطلاع رسانی</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> اطلاعیه پیامکی</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                   اطلاعیه پیامکی
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('sms.create') }}" class="btn btn-info btn-sm">ایجاد اطلاعیه پیامکی</a>
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان اطلاعیه</th>
                            <th> متن پیامک </th>
                            <th>تاریخ ارسال	</th>
                            <th> وضعیت	</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sms as $singel_sms )
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{$singel_sms->title}}	</td>
                            <td>  {{$singel_sms->body}}	</td>
                            <td> {{ jalaliDate($singel_sms->published_at , 'H:i:s Y-m-d') }}</td>
                            <td>

                                @if ($singel_sms->status == 0)

                                <span class="text-success">enable</span>
                                @else
                                <span class="text-danger">disable</span>
                                @endif


                            </td>
                            <td class="width-16-rem text-left">
                                <a href="{{ route('sms.changeStatus',$singel_sms->id) }}" class="btn btn-warning btn-sm">وضعیت</a>
                                <a href="{{ route('sms.edit',$singel_sms->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form class="d-inline" action="{{ route('sms.destroy',$singel_sms->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>
                            </form>
                            </td>
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

