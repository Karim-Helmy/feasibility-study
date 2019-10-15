@extends('trainer.layouts.app')
@section('content')
    <form class="form form-horizontal striped-rows form-bordered" method="post" enctype="multipart/form-data"  action="{{ turl('/photos/store/'.$id) }}">
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

            <!-- Upload File -->
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

        </div>
        <div class="form-actions right">
            <button type="submit" class="btn btn-primary">
                <i class="la la-check-square-o"></i> {{ trans('admin.save') }}
            </button>
        </div>
    </form>
@endsection
