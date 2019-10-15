@extends('trainer.layouts.app')
@section('content')
    <form class="form form-horizontal striped-rows form-bordered" method="post" enctype="multipart/form-data"  action="{{ route('trainer.users.update',[$edit->id]) }}">
        @csrf
        @method('PATCH')
        <!-- Type -->
        <div class="form-group row">
           <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.type') }}</label>
           <div class="col-md-9">
               <div class="position-relative has-icon-left">
                   <select  name="type" id="type" class="form-control"  required>
                       <option value="3" {{ $edit->type == '3' ? "selected" : ""   }}>{{ trans('admin.student') }}</option>
                       <option value="2" {{ $edit->type == '2' ? "selected" : ""   }}>{{ trans('admin.trainer') }}</option>
                   </select>
                   <div class="form-control-position">
                       <i class="la la-server"></i>
                   </div>
               </div>
           </div>
       </div>
       <div class="form-actions right">
           <button type="submit" class="btn btn-primary">
               <i class="la la-check-square-o"></i> {{ trans("admin.edit") }}
           </button>
       </div>
     </form>
@endsection
