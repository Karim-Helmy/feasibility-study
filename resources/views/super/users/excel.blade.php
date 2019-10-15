@extends('super.layouts.app')
@section('content')
     <form method="post" enctype="multipart/form-data" action="{{ surl('/users/import') }}">
         @csrf
         <input type="file" class="form-control" name="excel" >

         <br />
         <!-- Group -->
         <div class="form-group row">
             <label class="col-md-3 label-control" for="timesheetinput2">{{ trans("admin.group") }}</label>
             <div class="col-md-9">
                 <div class="position-relative has-icon-left">
                     <input type="text"  class="form-control" placeholder="{{ trans("admin.group") }}"
                     name="group" value="{{ old('group') }}">
                     <div class="form-control-position">
                         <i class="la la-tag"></i>
                     </div>
                 </div>
             </div>
         </div>

         <!-- Course ID -->
         <div class="form-group row">
             <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.course') }}</label>
             <div class="col-md-9">
                 <div class="position-relative has-icon-left">
                     <select name="course_id" class="form-control">
                         <option value="">{{ trans('admin.course') }}</option>
                         @foreach ($courses as $course)
                             <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? "selected" : ""   }}>{{ $course->title }}</option>
                         @endforeach
                     </select>
                     <div class="form-control-position">
                         <i class="la la-reorder"></i>
                     </div>
                 </div>
             </div>
         </div>

         
         <button class="btn btn-primary" type="submit">Upload</button>
    </form>
@endsection
