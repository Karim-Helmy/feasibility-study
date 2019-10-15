@extends('trainer.layouts.app')
@section('content')
    {{ $project->answer }}
    <br />
    @if ($project->answer_file)
        <a href="{{ asset('upload/'.$project->answer_file) }}">Upload</a>
    @endif
    <form class="form form-horizontal striped-rows form-bordered" method="post"   action="{{ turl('/projects/rate/'.$project->id) }}">
        @csrf
        <div class="form-body">

            <!-- Title -->
            <div class="form-group row">
                <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.grade') }}</label>
                <div class="col-md-9">
                    <div class="position-relative has-icon-left">
                        <input type="number" required  class="form-control" placeholder="{{ trans('admin.grade') }}"
                        name="grade" value="{{ old('grade') }}">
                        <div class="form-control-position">
                            <i class="la la-tag"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="form-group row">
                <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.notes') }}</label>
                <div class="col-md-9">
                    <div class="position-relative has-icon-left">
                        <textarea class="form-control" rows="4"  name="notes" >{{ old('notes') }}</textarea>
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
