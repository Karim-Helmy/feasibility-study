@extends('trainer.layouts.app')

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">{{ $title }}</h3>
        </div>
    </div>
    <div class="content-body">
        <!-- Striped row layout section start -->
        <section id="striped-row-form-layouts">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="horz-layout-icons">{{ $title }}</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <form class="form form-horizontal striped-rows form-bordered" method="post" enctype="multipart/form-data"  action="{{ route('trainer.project.update', [$edit->id]) }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-body">

                                        <!-- Title -->
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.title') }}</label>
                                            <div class="col-md-9">
                                                <div class="position-relative has-icon-left">
                                                    <input type="text" required  class="form-control" placeholder="{{ trans('admin.title') }}"
                                                    name="title" value="{{ $edit->title }}">
                                                    <div class="form-control-position">
                                                        <i class="la la-tag"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.description') }}</label>
                                            <div class="col-md-9">
                                                <div class="position-relative has-icon-left">
                                                    <textarea class="form-control" rows="4"  name="description" >{{ $edit->description }}</textarea>
                                                    <div class="form-control-position">
                                                        <i class="la la-file-text"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Start Date -->
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.start_date') }}</label>
                                            <div class="col-md-9">
                                                <div class="position-relative has-icon-left">
                                                    <input type="date" required  class="form-control" placeholder="{{ trans('admin.start_date') }}"
                                                    name="start_date" value="{{ $edit->start_date }}">
                                                    <div class="form-control-position">
                                                        <i class="la la-tag"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- End Date -->
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.end_date') }}</label>
                                            <div class="col-md-9">
                                                <div class="position-relative has-icon-left">
                                                    <input type="date" required  class="form-control" placeholder="{{ trans('admin.end_date') }}"
                                                    name="end_date" value="{{ $edit->end_date }}">
                                                    <div class="form-control-position">
                                                        <i class="la la-tag"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- End Date -->
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.total') }}</label>
                                            <div class="col-md-9">
                                                <div class="position-relative has-icon-left">
                                                    <input type="number" required  class="form-control" placeholder="{{ trans('admin.total') }}"
                                                    name="total" value="{{ $edit->total }}">
                                                    <div class="form-control-position">
                                                        <i class="la la-tag"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- group_id -->
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.groups') }}</label>
                                            <div class="col-md-9">
                                                <div class="position-relative has-icon-left">
                                                    <select name="group_id[]" multiple class="form-control">
                                                        @foreach ($groups as $group)
                                                            <option value="{{ $group->id }}">{{ $group->title }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="form-control-position">
                                                        <i class="la la-reorder"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- user_id -->
                                        <div class="form-group row" >
                                            <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.users') }}</label>
                                            <div class="col-md-9">
                                                <div class="position-relative has-icon-left">
                                                    <select name="user_id[]" multiple class="form-control">
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}" {{ in_array($user->id, $choose ?? []) ? "selected" : ""   }}>{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="form-control-position">
                                                        <i class="la la-reorder"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Upload File -->
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.attachment') }}</label>
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

                                        <!-- Allow File Upload -->
                                        <div class="form-group row  mx-auto last">
                                            <label class="col-md-3 label-control">{{ trans('admin.file_upload') }}</label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <div class="d-inline-block custom-control custom-radio mr-1" style="margin: auto 20px !important;">
                                                        <input type="radio" name="file_upload" value="1" class="custom-control-input" id="yes" {{ $edit->file_upload == '1' ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="yes">{{ trans('admin.yes') }}</label>
                                                    </div>
                                                    <div class="d-inline-block custom-control custom-radio">
                                                        <input type="radio" name="file_upload" value="0" class="custom-control-input" id="no"{{ $edit->file_upload == '0' ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="no">{{ trans('admin.no') }}</label>
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
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
