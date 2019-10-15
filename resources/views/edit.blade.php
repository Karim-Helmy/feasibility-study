
    <div class="form-body">
        <!-- Email -->
        <div class="form-group row">
            <label class="col-md-3 label-control" for="timesheetinput2">{{ trans("admin.email") }}</label>
            <div class="col-md-9">
                <div class="position-relative has-icon-left">
                    <input type="email"  class="form-control" placeholder="{{ trans("admin.email") }}"
                    name="email" value="{{ $edit->email }}">
                    <div class="form-control-position">
                        <i class="la la-briefcase"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mobile -->
        <div class="form-group row">
            <label class="col-md-3 label-control">{{ trans('admin.mobile') }}</label>
            <div class="col-md-9">
                <div class="position-relative has-icon-left">
                    <input type="number"   class="form-control" placeholder="{{ trans('admin.mobile') }}"
                    name="mobile" value="{{ $edit->mobile }}">
                    <div class="form-control-position">
                        <i class="la la-envelope"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Phone -->
        <div class="form-group row">
            <label class="col-md-3 label-control">{{ trans('admin.phone') }}</label>
            <div class="col-md-9">
                <div class="position-relative has-icon-left">
                    <input type="number"  class="form-control" placeholder="{{ trans('admin.phone') }}"
                    name="phone" value="{{ $edit->phone }}">
                    <div class="form-control-position">
                        <i class="la la-envelope"></i>
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
                    name="birth_date" value="{{ $edit->birth_date }}">
                    <div class="form-control-position">
                        <i class="la la-calender"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upload File -->
        @if ($edit->photo)
           <div class="form-group row">
               <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.photo') }}</label>
               <div class="col-md-9">
                   <div class="position-relative has-icon-left">
                   <img src="{{ asset('uploads/'.$edit->photo) }}" title="{{ trans('admin.photo') }}" style="height:100px; width:200px;" />
                   </div>
               </div>
           </div>
       @endif
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

        <!-- Old Password -->
        <div class="form-group row">
            <label class="col-md-3 label-control">{{ trans('admin.old password') }}</label>
            <div class="col-md-9">
                <div class="position-relative has-icon-left">
                    <input type="password"  class="form-control" placeholder="{{ trans('admin.old password') }}"
                    name="old_password" >
                    <div class="form-control-position">
                        <i class="la la-envelope"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Password -->
        <div class="form-group row">
            <label class="col-md-3 label-control">{{ trans('admin.password') }}</label>
            <div class="col-md-9">
                <div class="position-relative has-icon-left">
                    <input type="password"  class="form-control" placeholder="{{ trans('admin.password') }}"
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
                    <input type="password"   class="form-control" placeholder="{{ trans('admin.password_confirmation') }}"
                    name="password_confirmation" >
                    <div class="form-control-position">
                        <i class="la la-envelope"></i>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <div class="form-actions right">
        <button type="submit" class="btn btn-primary">
            <i class="la la-check-square-o"></i> {{ trans("admin.edit") }}
        </button>
    </div>
