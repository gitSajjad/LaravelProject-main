@extends('admin.layouts.master')

@section('head-tag')
<title>اطلاعیه ایمیلی</title>
@endsection

@section('countint')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">اطلاع رسانی</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> اطلاعیه ایمیلی</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                   اطلاعیه ایمیلی
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('email.create') }}" class="btn btn-info btn-sm">ایجاد اطلاعیه ایمیلی</a>
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
                            <th>متن ایمیلی  </th>
                            <th>تاریخ ارسال	</th>
                            <th>   وضعیت	</th>

                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($emails as $email )



                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $email->subject }}</td>
                            <td>{{ $email->body }} 	</td>
                            <td>   {{jalaliDate($email->published_at, 'H:i:s Y-m-d') }}  	</td>
                            <td>

                                @if ($email->status == 0)

                                <span class="text-success">enable</span>
                                @else
                                <span class="text-danger">disable</span>
                                @endif


                            </td>
                            <td class="width-16-rem text-left">
                                <a href="{{ route('email-file.index',$email->id) }}" class="btn btn-warning btn-sm">ضمیمه</a>
                                <a href="{{ route('email.changeStatus',$email->id) }}" class="btn btn-warning btn-sm">وضعی</a>
                                <a href="{{ route('email.edit',$email->id) }}" class="btn btn-info btn-sm"> ویرایش</a>
                                <form class="d-inline" action="{{ route('email.destroy',$email->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                <button class="btn btn-danger btn-sm delete" type="submit"> حذف</button>
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

