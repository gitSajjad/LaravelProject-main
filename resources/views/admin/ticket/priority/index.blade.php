@extends('admin.layouts.master')

@section('head-tag')
<title>اولویت</title>
@endsection

@section('countint')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش تیکت ها</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page">اولویت</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    اولویت
                </h5>
            </section>



            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.ticket.priority.create') }}" class="btn btn-info btn-sm">ایجاد اولویت</a>
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام اولویت</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($ticketPriorities as $key => $priority)

                        <tr>
                            <th>{{ $key += 1 }}</th>
                            <td>{{ $priority->name }}</td>
                            <td>

                                @if ($priority->status == 1)

                                <span class="text-success">enable</span>
                                @else
                                <span class="text-danger">disable</span>
                                @endif

                            </td>
                            <td class="width-16-rem text-left">
                                <a href="{{ route('admin.ticket.priority.changeStatus', $priority->id) }}" class="btn btn-secondary btn-sm">وضعیت</a>

                                <a href="{{ route('admin.ticket.priority.edit', $priority->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form class="d-inline" action="{{ route('admin.ticket.priority.destroy', $priority->id) }}" method="post">
                                    @csrf
                                    {{ method_field('delete') }}
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
