@extends('super.layouts.app')
@section('content')
    <form class="form form-horizontal striped-rows form-bordered" method="post" enctype="multipart/form-data"  action="{{ surl('/users/store') }}">
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

            <!-- UserName -->
            <div class="form-group row">
                <label class="col-md-3 label-control">{{ trans('admin.username') }}</label>
                <div class="col-md-9">
                    <div class="position-relative has-icon-left">
                        <input type="text" required class="form-control" placeholder="{{ trans('admin.username') }}"
                        name="username" value="{{ old('username') }}">
                        <div class="form-control-position">
                            <i class="la la-briefcase"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Password -->
            <div class="form-group row">
                <label class="col-md-3 label-control">{{ trans('admin.password') }}</label>
                <div class="col-md-9">
                    <div class="position-relative has-icon-left">
                        <input type="password" required  class="form-control" placeholder="{{ trans('admin.password') }}"
                        name="password" >
                        <div class="form-control-position">
                            <i class="la la-envelope"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Password Confirmation -->
            <div class="form-group row">
                <label class="col-md-3 label-control">{{ trans('admin.password_confirmation') }}</label>
                <div class="col-md-9">
                    <div class="position-relative has-icon-left">
                        <input type="password" required  class="form-control" placeholder="{{ trans('admin.password_confirmation') }}"
                        name="password_confirmation" >
                        <div class="form-control-position">
                            <i class="la la-envelope"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Email -->
            <div class="form-group row">
                <label class="col-md-3 label-control">{{ trans('admin.email') }}</label>
                <div class="col-md-9">
                    <div class="position-relative has-icon-left">
                        <input type="email"  class="form-control" placeholder="{{ trans('admin.email') }}"
                        name="email" value="{{ old('email') }}">
                        <div class="form-control-position">
                            <i class="la la-envelope"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile -->
            <div class="form-group row">
                <label class="col-md-3 label-control">{{ trans('admin.mobile') }}</label>
                <div class="col-md-9">
                    <div style="color:#FF0000">Example:- 05xxxxxxxx</div>
                    <div class="position-relative has-icon-left">
                        <input type="number"  class="form-control" placeholder="{{ trans('admin.mobile') }}"
                        name="mobile" value="{{ old('mobile') }}">
                        <div class="form-control-position">
                            <i class="la la-phone"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Phone -->
            <div class="form-group row">
                <label class="col-md-3 label-control">{{ trans('admin.phone') }}</label>
                <div class="col-md-9">
                    <div class="position-relative has-icon-left">
                        <input type="number"   class="form-control" placeholder="{{ trans('admin.phone') }}"
                        name="phone" value="{{ old('phone') }}">
                        <div class="form-control-position">
                            <i class="la la-phone"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address -->
            <div class="form-group row">
                <label class="col-md-3 label-control">{{ trans('admin.address') }}</label>
                <div class="col-md-9">
                    <div class="position-relative has-icon-left">
                        <input type="text"  class="form-control" placeholder="{{ trans('admin.address') }}"
                        name="address" value="{{ old('address') }}">
                        <div class="form-control-position">
                            <i class="la la-map"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nationality -->
            <div class="form-group row">
                <label class="col-md-3 label-control">{{ trans('admin.nationality') }}</label>
                <div class="col-md-9">
                    <div class="position-relative has-icon-left">
                        <input type="text"  class="form-control" placeholder="{{ trans('admin.nationality') }}"
                        name="nationality" value="{{ old('nationality') }}">
                        <div class="form-control-position">
                            <i class="la la-map"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Birth Date -->
            <div class="form-group row">
                <label class="col-md-3 label-control">{{ trans('admin.birth_date') }}</label>
                <div class="col-md-9">
                    <div class="position-relative has-icon-left">
                        <input type="date"  class="form-control" placeholder="{{ trans('admin.birth_date') }}"
                        name="birth_date" value="{{ old('birth_date') }}">
                        <div class="form-control-position">
                            <i class="la la-calender"></i>
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

            <!-- Package ID -->
            <div class="form-group row">
               <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.type') }}</label>
               <div class="col-md-9">
                   <div class="position-relative has-icon-left">
                       <select  name="type" id="type" class="form-control"  required>
                           <option value="">{{ trans('admin.type') }}</option>
                           <option value="3" {{ old('type') == '3' ? "selected" : ""   }}>{{ trans('admin.student') }}</option>
                           <option value="2" {{ old('type') == '2' ? "selected" : ""   }}>{{ trans('admin.trainer') }}</option>
                           <option value="4" {{ old('type') == '4' ? "selected" : ""   }}>{{ trans('admin.father') }}</option>
                       </select>
                       <div class="form-control-position">
                           <i class="la la-server"></i>
                       </div>
                   </div>
               </div>
           </div>

           <!-- Father ID -->
           <div class="form-group row" id="father" style="display:none;">
               <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.father') }}</label>
               <div class="col-md-9">
                   <div class="position-relative has-icon-left">
                       <select name="father_id" class="form-control">
                           <option value="">{{ trans('admin.father') }}</option>
                           @foreach ($fathers as $father)
                               <option value="{{ $father->id }}" {{ old('father_id') == $father->id ? "selected" : ""   }}>{{ $father->username }}</option>
                           @endforeach
                       </select>
                       <div class="form-control-position">
                           <i class="la la-reorder"></i>
                       </div>
                   </div>
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


            <!-- Status -->
            <div class="form-group row  mx-auto last">
                <label class="col-md-3 label-control">{{ trans('admin.active') }}</label>
                <div class="col-md-9">
                    <div class="input-group">
                        <div class="d-inline-block custom-control custom-radio mr-1" style="margin: auto 20px !important;">
                            <input type="radio" name="status" value="1" class="custom-control-input" id="yes" {{ old('status') == '1' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="yes">{{ trans('admin.yes') }}</label>
                        </div>
                        <div class="d-inline-block custom-control custom-radio">
                            <input type="radio" name="status" value="0" class="custom-control-input" id="no"{{ old('status') == '0' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="no">{{ trans('admin.no') }}</label>
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
@section('scripts')
<script>
$(document).ready(function() {
    if($('#type').val() == '3'){
        $('#father').show();
    }
    $('#type').change(function() {
        if($(this).val() == '3'){
            $('#father').show();
        }
        if($(this).val() != '3'){
            $('#father').hide();
        }
    })
})
</script>
@endsection
