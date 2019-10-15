@extends('super.layouts.app')
@section('content')
    <!-- Column selectors table -->
    <section id="attachment-grid" class="card">

        <div class="card-content">
            <div class="card-body">
                <div class="card-deck-wrapper">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('admin.show') }}</h4>
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
                    <div class="card-deck">
                        <table class="table table-striped table-bordered ">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ trans('admin.name') }}</th>
                                <th>{{ trans('admin.show') }}</th>
                                <th>{{ trans('admin.course_users') }}</th>
                                <th>{{ trans('admin.course_groups') }}</th>
                                <th>{{ trans('admin.edit') }}</th>
                                <th>{{ trans('admin.delete') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($index as $i)
                                <tr>
                                    <td>{{ $i->id }}</td>
                                    <td>{{ $i->title }}</td>
                                    <td>
                                        <a href="{{ surl('/courses/details/'.$i->id) }}" class="btn btn-secondary btn-min-width mr-1 mb-1"><i
                                                    class="ft-eye"></i></a>
                                    </td>
                                    <td>
                                    <a href="{{ surl('/courses/course_users/'.$i->id) }}" class="btn btn-secondary btn-min-width mr-1 mb-1"><i
                                                class="ft-users"></i> {{ trans('admin.course_users') }}</a>
                                    </td>
                                    <td>
                                    <a href="{{ surl('/courses/course_groups/'.$i->id) }}" class="btn btn-secondary btn-min-width mr-1 mb-1"><i
                                                class="ft-users"></i> {{ trans('admin.course_groups') }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ surl('/courses/edit/'.$i->id) }}" class="btn btn-secondary btn-min-width mr-1 mb-1"><i
                                                    class="ft-edit"></i> {{ trans('admin.edit') }}</a>
                                        <input type="hidden" value="{{ csrf_token() }}" id="csrf_token" />
                                    </td>
                                    <td>
                                        <form id="form-id{{ $i->id  }}"  action="{{ route('super.courses.destroy', [$i->id]) }}" style="display:inline;" method="post">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <a href="#" onclick="document.getElementById('form-id{{ $i->id }}').submit();" class="btn btn-danger btn-min-width btn-glow mr-1 mb-1" ><i
                                                    class="ft-delete"></i> {{ trans('admin.delete') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
