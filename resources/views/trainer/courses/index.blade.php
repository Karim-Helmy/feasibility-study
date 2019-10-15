@extends('trainer.layouts.app')


@section('content')
    <div class="content-body">
      <!-- HTML5 export buttons table -->
      <!-- Column selectors table -->
      <section id="column-selectors">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
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
              <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                  <table class="table table-striped table-bordered dataex-html5-selectors">
                    <thead>
                      <tr>
                        <th>{{ trans('admin.photo') }}</th>
                        <th>{{ trans('admin.title') }}</th>
                        <th>{{ trans('admin.description') }}</th>
                        <th>{{ trans('admin.category') }}</th>
                        <th>{{ trans('admin.show') }}</th>

                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($index as $i)
                            <tr>
                                <td>
                                    @if ($i->logo)
                                        <img src="{{ asset('uploads/'.$i->logo) }}" alt="{{ $i->title }}" />
                                    @else
                                        <img src="{{ asset('backend/app-assets/images/backgrounds/login.jpg') }}" alt="{{ $i->title }}" />
                                    @endif
                                </td>
                                <td>{{ $i->title }}</td>
                                <td>{!!  str_limit($i->description, 50) !!}</td>
                                <td>{{ $i->category->name }}</td>
                                <td>
                                    <a href="{{ turl('/courses/show/'.$i->id) }}" class="btn btn-secondary btn-min-width mr-1 mb-1"><i
                                        class="ft-eye"></i> {{ trans('admin.show') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                          <th>{{ trans('admin.photo') }}</th>
                          <th>{{ trans('admin.title') }}</th>
                          <th>{{ trans('admin.description') }}</th>
                          <th>{{ trans('admin.category') }}</th>
                          <th>{{ trans('admin.show') }}</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--/ Column selectors table -->
</div>


@endsection
