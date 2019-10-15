@extends('super.layouts.app')
@section('content')
    <form class="form form-horizontal striped-rows form-bordered" method="post" enctype="multipart/form-data"  action="{{ surl('/courses/store') }}">
        @csrf
        <div class="form-body">
            <!-- Name -->
            <div class="form-group row">
                <label class="col-md-3 label-control">{{ trans('admin.name') }}</label>
                <div class="col-md-9">
                    <div class="position-relative has-icon-left">
                        <input type="text" required  class="form-control" placeholder="{{ trans('admin.name') }}"
                        name="name" value="{{ old('name') }}">
                        <div class="form-control-position">
                            <i class="la la-user"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Start Date -->
            <div class="form-group row">
                <label class="col-md-3 label-control">{{ trans('admin.start_date') }}</label>
                <div class="col-md-9">
                    <div class="position-relative has-icon-left">
                        <input type="datetime-local"  class="form-control" placeholder="{{ trans('admin.start_date') }}"
                               name="start_date" value="{{ old('start_date') }}">
                        <div class="form-control-position">
                            <i class="la la-calender"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End Date -->
            <div class="form-group row">
                <label class="col-md-3 label-control">{{ trans('admin.end_date') }}</label>
                <div class="col-md-9">
                    <div class="position-relative has-icon-left">
                        <input type="datetime-local"  class="form-control" placeholder="{{ trans('admin.end_date') }}"
                               name="end_date" value="{{ old('end_date') }}">
                        <div class="form-control-position">
                            <i class="la la-calender"></i>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Number Of Days -->
            <div class="form-group row">
                <label class="col-md-3 label-control">{{ trans('admin.days_no') }}</label>
                <div class="col-md-9">

                    <div class="position-relative has-icon-left">
                        <input type="number"  class="form-control" placeholder="{{ trans('admin.days_no') }}"
                        name="days_no" value="{{ old('days_no') }}">
                        <div class="form-control-position">
                            <i class="la la-calender"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Number Of Hours -->
            <div class="form-group row">
                <label class="col-md-3 label-control">{{ trans('admin.hours_no') }}</label>
                <div class="col-md-9">

                    <div class="position-relative has-icon-left">
                        <input type="number"  class="form-control" placeholder="{{ trans('admin.hours_no') }}"
                               name="hours_no" value="{{ old('hours_no') }}">
                        <div class="form-control-position">
                            <i class="la la-clock"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="form-group row">
                <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.description') }}</label>
                <div class="col-md-9">
                    <div class="position-relative has-icon-left">
                        <textarea class="form-control" rows="4"  name="description" >{{ old('description') }}</textarea>
                        <div class="form-control-position">
                            <i class="la la-file-text"></i>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Levels -->
            <div class="form-group row">
                <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.level') }}</label>
            <div class="form-group col-md-5 mb-2 contact-repeater">
                <div data-repeater-list="repeater">
                    <div class="input-group mb-1" data-repeater-item>
                        <input type="tel" name="level_name" placeholder="{{ trans('admin.level_name') }}" class="form-control" id="example-tel-input" value="{{ old('level_number') }}">
                        <input type="number"  class="form-control" placeholder="{{ trans('admin.level_number') }}"
                               name="level_number" value="{{ old('level_number') }}">
                        <span class="input-group-append" id="button-addon2">
                              <button class="btn btn-danger" type="button" data-repeater-delete><i class="ft-x"></i></button>
                            </span>
                    </div>

                </div>

                <button type="button" data-repeater-create class="btn btn-primary">
                    <i class="ft-plus"></i> {{ trans('admin.add_new_level') }}
                </button>
            </div>
            </div>

            <!-- Upload Photo -->
            <div class="form-group row">
                <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.photo') }}</label>
                <div class="col-md-9">
                    <div class="position-relative has-icon-left">
                        <input type="file"  class="form-control"
                               name="image" >
                        <div class="form-control-position">
                            <i class="la la-file-image-o"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category ID -->
            <div class="form-group row">
                <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.category') }}</label>
                <div class="col-md-9">
                    <div class="position-relative has-icon-left">
                        <select name="category_id" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? "selected" : ""   }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="form-control-position">
                            <i class="la la-reorder"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Active -->
            <div class="form-group row">
                <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.active') }}</label>
                <div class="col-md-9">
                    <div class="input-group">
                        <div class="d-inline-block custom-control custom-radio mr-1" style="margin: auto 20px !important;">
                            <input type="radio" name="active" value="1" class="custom-control-input" id="yes" >
                            <label class="custom-control-label" for="yes">{{ trans('admin.yes') }}</label>
                        </div>
                        <div class="d-inline-block custom-control custom-radio">
                            <input type="radio" name="active" value="0" class="custom-control-input" id="no" checked>
                            <label class="custom-control-label" for="no">{{ trans('admin.no') }}</label>
                        </div>
                    </div>
                    </div>
                </div>
            </div>


        <div class="form-actions text-center">
            <button type="submit" class="btn btn-success">
                <i class="la la-check-square-o"></i> {{ trans('admin.save') }}
            </button>
        </div>
     <br>
    </form>
@endsection
@section('scripts')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        CKEDITOR.replace('description', {
            language: 'ar',
        });
    </script>
@endsection
