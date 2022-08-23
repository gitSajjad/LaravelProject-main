@extends('admin.layouts.master')

@section('head-tag')
<title>ایجاد پست</title>
@endsection
@section('styles')
<link href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('countint')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">پست</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد پست</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ایجاد پست
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('post.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('post.store') }}" method="post" id="form" enctype="multipart/form-data" >
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">عنوان پست</label>
                                <input type="text" name="title" value="{{ old('title') }}" class="form-control form-control-sm">
                            </div>
                            @error('title')
                            <span class="alert_required bg-danger text-white p-2 mt-3 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </section>



                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">انتخاب دسته</label>
                                <select name="category_id" id="" class="form-control form-control-sm">
                                    <option value="">دسته را انتخاب کنید</option>
                                    @foreach ($postCategories as $postCategory)

                                    <option value="{{ $postCategory->id}}" @if(old('category_id') == $postCategory->id) selected @endif >{{ $postCategory->name }} </option>

                                    @endforeach
                                </select>
                            </div>
                            @error('category_id')
                            <span class="alert_required bg-danger text-white p-2 mt-3 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </section>


                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">تصویر </label>
                                <input type="file" name="image"  id="image" class="form-control form-control-sm">
                            </div>
                            @error('image')
                            <span class="alert_required bg-danger text-white p-2 mt-3 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </section>



                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="status">وضعیت</label>
                                <select name="status" id="" class="form-control form-control-sm" id="status">
                                    <option value="0" @if(old('status') == 0) selected @endif>غیرفعال</option>
                                    <option value="1" @if(old('status') == 1) selected @endif>فعال</option>
                                </select>
                            </div>
                            @error('status')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>


                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="commentable">امکان درج کامنت</label>
                                <select name="commentable" id="" class="form-control form-control-sm" id="commentable">
                                    <option value="0" @if(old('commentable') == 0) selected @endif>غیرفعال</option>
                                    <option value="1" @if(old('commentable') == 1) selected @endif>فعال</option>
                                </select>
                            </div>
                            @error('commentable')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>





                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">تاریخ انتشار</label>
                                <input type="text" class="form-control d-none" id="published_at" name="published_at" required autofocus>
                                <input type="text" class="form-control" id="published_at_view" required autofocus>
                            </div>
                            @error('published_at')
                            <span class="alert_required bg-danger text-white p-2 mt-3 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </section>



                        <section class="col-12">
                            <div class="form-group">
                                <label for="tags">تگ ها</label>
                                <input type="hidden" class="form-control form-control-sm"  name="tags" id="tags" value="{{ old('tags') }}">
                                <select class="select2 form-control form-control-sm" id="select_tags" multiple>

                                </select>
                            </div>
                            @error('tags')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>

                        <section class="col-12">
                            <div class="form-group">
                                <label for="">خلاصه پست</label>
                                <textarea name="summary" id="summary"  class="form-control form-control-sm" rows="6">{{ old('summary') }}</textarea>
                            </div>
                            @error('summary')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>


                        <section class="col-12">
                            <div class="form-group">
                                <label for="">متن پست</label>
                                <textarea name="body" id="body" value="{{ old('body') }}" class="form-control form-control-sm" rows="6"></textarea>
                            </div>
                            @error('body')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>

                        <section class="col-12">
                            <button class="btn btn-primary btn-sm">ثبت</button>
                        </section>.

                    </section>

                </form>
                
            </section>

        </section>
    </section>
</section>

@endsection

@section('scripts')


<script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
<script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>

    <script>
    $(document).ready(function() {
        CKEDITOR.replace('body');
        CKEDITOR.replace('summary');
        $('#published_at_view').persianDatepicker({
            observer: true,
            toolbox:{
            calendarSwitch:{
           enabled: true
             }
             },
            format: 'YYYY/MM/DD HH:mm:ss',
             altField: '#published_at'
        })
    })
</script>





<script>
    $(document).ready(function () {
        var tags_input = $('#tags');
        var select_tags = $('#select_tags');
        var default_tags = tags_input.val();
        var default_data = null;

        if(tags_input.val() !== null && tags_input.val().length > 0)
        {
            default_data = default_tags.split(',');
        }

        select_tags.select2({
            placeholder : 'لطفا تگ های خود را وارد نمایید',
            tags: true,
            data: default_data
        });
        select_tags.children('option').attr('selected', true).trigger('change');


        $('#form').submit(function ( event ){
            if(select_tags.val() !== null && select_tags.val().length > 0){
                var selectedSource = select_tags.val().join(',');
                tags_input.val(selectedSource)
            }
        })
    })
</script>


@endsection
