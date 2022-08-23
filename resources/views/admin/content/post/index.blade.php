@extends('admin.layouts.master')

@section('head-tag')
<title>پست ها</title>
@endsection

@section('countint')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page">پست ها</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                 پست ها
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('post.create') }}" class="btn btn-info btn-sm">ایجاد پست </a>
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان پست</th>
                            <th>دسته</th>
                            <th>تصویر</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($posts as $post)

                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->postCategory->name }}</td>

                            <td>
                                <img src="{{ asset($post->image['indexArray'][$post->image['currentImage']] ) }}" alt="" width="100" height="50">
                            </td>

                            <td>

                                @if ($post->status == 0)

                                <span class="text-success">enable</span>
                                @else
                                <span class="text-danger">disable</span>
                                @endif


                            </td>

                            <td class="width-16-rem text-left">
                                <a href="{{ route('post.changeStatus',$post->id) }}" class="btn btn-warning btn-sm">Change</a>
                                <a href="{{route('post.edit',$post->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>


                                <form class="d-inline" action="{{ route('post.destroy',$post->id) }}" method="post">
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
