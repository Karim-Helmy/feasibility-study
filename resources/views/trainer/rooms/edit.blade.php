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
                                <form class="form form-horizontal striped-rows form-bordered" method="post"  action="{{ route('trainer.room.update', [$edit->id]) }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-body">

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="timesheetinput2">{{ trans("admin.title") }}</label>
                                            <div class="col-md-9">
                                                <div class="position-relative has-icon-left">
                                                    <input type="text" required  class="form-control" placeholder="{{ trans("admin.title") }}"
                                                    name="title" value="{{ $edit->title }}">
                                                    <div class="form-control-position">
                                                        <i class="la la-tag"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- links -->
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.link') }}</label>
                                            <div class="col-md-9">
                                                <div class="position-relative has-icon-left">
                                                    <input type="text" required  class="form-control" placeholder="{{ trans("admin.link") }}"
                                                    name="link" value="{{ $edit->link }}">
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
                                                    name="start_date" value="{{ $edit->start_date }}">
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
                                                    name="end_date" value="{{ $edit->end_date }}">
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
                                                    name="class_no" value="{{ $edit->class_no }}">
                                                    <div class="form-control-position">
                                                        <i class="la la-youtube"></i>
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
