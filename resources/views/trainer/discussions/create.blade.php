@extends('trainer.layouts.app')
@section('content')
    <form class="form form-horizontal striped-rows form-bordered" method="post" action="{{ turl('/discussions/store/'.$id) }}">
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

            
        </div>
        <div class="form-actions right">
            <button type="submit" class="btn btn-primary">
                <i class="la la-check-square-o"></i> {{ trans('admin.save') }}
            </button>
        </div>
    </form>
@endsection
