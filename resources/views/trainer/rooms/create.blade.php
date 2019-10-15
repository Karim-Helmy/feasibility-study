@extends('trainer.layouts.app')
@section('content')
    <form class="form form-horizontal striped-rows form-bordered" method="post" action="{{ turl('/rooms/store/'.$id) }}">
        @csrf
        <div class="form-body">

            <div class="form-group row">
                <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.title') }}</label>
                <div class="col-md-9">
                    <div class="position-relative has-icon-left">
                        <input type="text" required  class="form-control" placeholder="{{ trans('admin.title') }}"
                        name="title" value="{{ old('title') }}">
                        <div class="form-control-position">
                            <i class="la la-tag"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- link -->
            <div class="form-group row">
                <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.link') }}</label>
                <div class="col-md-9">
                    <div class="position-relative has-icon-left">
                        <input type="text" required  class="form-control" placeholder="{{ trans('admin.link') }}"
                        name="link" value="{{ old('link') }}">
                        <div class="form-control-position">
                            <i class="la la-youtube"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Start Date -->
            <div class="form-group row">
                <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.start_date') }}</label>
                <div class="col-md-9">
                    <div class="position-relative has-icon-left">
                        <input type="datetime" class="form-control" placeholder="{{ trans('admin.start_date') }}"
                        name="start_date" value="{{ old('start_date') }}">
                        <div class="form-control-position">
                            <i class="la la-youtube"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End Date -->
            <div class="form-group row">
                <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.end_date') }}</label>
                <div class="col-md-9">
                    <div class="position-relative has-icon-left">
                        <input type="datetime"  class="form-control" placeholder="{{ trans('admin.end_date') }}"
                        name="end_date" value="{{ old('end_date') }}">
                        <div class="form-control-position">
                            <i class="la la-youtube"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- class room number -->
            <div class="form-group row">
                <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.class_no') }}</label>
                <div class="col-md-9">
                    <div class="position-relative has-icon-left">
                        <input type="text" class="form-control" placeholder="{{ trans('admin.class_no') }}"
                        name="class_no" value="{{ old('class_no') }}">
                        <div class="form-control-position">
                            <i class="la la-youtube"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="form-actions right">
            <button type="submit" class="btn btn-primary">
                <i class="la la-check-square-o"></i> {{ trans('admin.save') }}
            </button>
        </div>
    </form>
@endsection
