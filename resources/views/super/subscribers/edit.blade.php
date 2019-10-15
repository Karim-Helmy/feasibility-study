@extends('super.layouts.app')
@section('content')
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
                            <form class="form form-horizontal striped-rows form-bordered" method="post" enctype="multipart/form-data"  action="{{ route('super.school.update', [$edit->id]) }}">
                                @csrf
                                @method('PATCH')
                                <div class="form-body">

                                    <!-- School -->
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="timesheetinput2">{{ trans("admin.school") }}</label>
                                        <div class="col-md-9">
                                            <div class="position-relative has-icon-left">
                                                <input type="text" required  class="form-control" placeholder="{{ trans("admin.school") }}"
                                                name="school" value="{{ $edit->school }}">
                                                <div class="form-control-position">
                                                    <i class="la la-tag"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Title -->
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

                                    <!-- Upload File -->
                                    @if ($edit->logo)
                                       <div class="form-group row">
                                           <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.logo') }}</label>
                                           <div class="col-md-9">
                                               <div class="position-relative has-icon-left">
                                               <img src="{{ asset('uploads/'.$edit->logo) }}" title="{{ trans('admin.logo') }}" style="height:100px; width:200px;" />
                                               </div>
                                           </div>
                                       </div>
                                   @endif
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.logo') }}</label>
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
                                    <!-- Upload Photos Sliders -->
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control">{{ trans('admin.Photos') }}</label>
                                        <div class="col-md-9">
                                            <div class="position-relative has-icon-left">
                                                <input type="file"  class="form-control"
                                                 id="images" name="images[]" multiple >
                                                <div class="form-control-position">
                                                    <i class="la la-file-image-o"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if (!empty($edit->photos))
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control">{{ trans('admin.Photos') }}</label>
                                            <div class="col-md-9" style="margin: 10px">
                                                <div class="container">
                                                    <div class="row">
                                            @foreach (explode('|', $edit->photos) as $image)
                                                        <div class="col-md-3">
                                                            <a href="#" style="color:red" class="rImage">X</a>
                                                            <img src="{{ asset('uploads/'.$image) }}" style="height:200px;width:200px" alt="">
                                                            <input type="hidden" name="oldImages[]" value="{{ $image }}">
                                                        </div>
                                            @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    @endif


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
@endsection
@section('scripts')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        CKEDITOR.replace('description', {
            language: 'ar',
        });
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.rImage').on('click', function(event) {
            event.preventDefault();
            $(this).parents('.col-md-3').remove();
        })
    });
</script>
@endsection
