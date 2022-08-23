@extends('admin.layouts.master')

@section('head-tag')
<title>نظرات</title>
@endsection

@section('countint')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#"> خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#"> بخش محتوی</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> نظرات</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                 نظرات
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="#" class="btn btn-info btn-sm disabled">ایجاد نظر </a>
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نظر</th>
                            <th>پاسخ به</th>
                            <th>کد کاربر</th>
                            <th>نویسنده نظر</th>
                            <th>کد پست</th>
                            <th>محصول</th>
                            <th>وضعیت تایید</th>
                            <th>وضعیت </th>
                            <th>وضعیت کامنت </th>

                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>



                        @foreach ($comments as $comment)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ Str::limit($comment->body, 10) }}</td>
                            <td>{{ $comment->parent_id ? Str::limit($comment->parent->body, 10) : '' }}</td>
                            <td>{{ $comment->auther_id }}</td>
                            <td>{{  $comment->user->fullName  }} </td>
                            <td>{{  $comment->commentable_id  }}</td>
                            {{-- <td>{{ $comment->commentable->title }}</td> --}}
                            <td>{{ $comment->approved == 1 ? 'تایید شده ' : 'تایید نشده'}} </td>
                            {{-- <td></td> --}}
                            <td>

                                @if ($comment->status == 0)

                                <span class="text-success">enable</span>
                                @else
                                <span class="text-danger">disable</span>
                                @endif


                            </td>
                            <td>

                                @if ($comment->approved == 0)

                                <span class="text-success">enable</span>
                                @else
                                <span class="text-danger">disable</span>
                                @endif


                            </td>
                            <td class="width-16-rem text-left">
                                <a href="{{ route('comment.changeStatus',$comment->id) }}" class="btn btn-warning btn-sm"> وضعیت</a>
                                <a href="{{ route('comment.show','id') }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> نمایش</a>

                                @if($comment->approved == 0)
                                <a href="{{ route('comment.approved',$comment->id) }}" class="btn btn-warning btn-sm" type="submit"><i class="fa fa-clock"></i>عدم تایید</a>
                                @else
                                <a href="{{ route('comment.approved',$comment->id) }}" class="btn btn-success btn-sm" type="submit"><i class="fa fa-check"></i>تایید</a>
                                @endif
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
