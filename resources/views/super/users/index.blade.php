@extends('super.layouts.app')
@section('content')
    <!-- Column selectors table -->
    <section id="attachment-grid" class="card">
        <div class="card-header">
          <h4 class="card-title">{{ trans('admin.show') }}</h4>
          <form id="search" action="{{ surl('/users') }}" method="get" >
              <br />
              <input type="email" placeholder="{{ trans('admin.email') }}" id="email" value="{{ request()->email }}" class="form-control" style="width:25%; display:inline;" name="email" />
              <input type="text" placeholder="{{ trans('admin.id') }}" id="id" value="{{ request()->id }}" class="form-control" style="width:25%; display:inline;" name="id" />
              <select  name="type" id="type" class="form-control" >
                  <option value="">{{ trans('admin.type') }}</option>
                  <option value="3" {{ request()->type == '3' ? "selected" : ""   }}>{{ trans('admin.student') }}</option>
                  <option value="2" {{ request()->type == '2' ? "selected" : ""   }}>{{ trans('admin.trainer') }}</option>
                  <option value="4" {{ request()->type == '4' ? "selected" : ""   }}>{{ trans('admin.father') }}</option>
              </select>
              <br />
              <button class="btn btn-success btn-min-width mr-1 mb-1" type="submit" style="display:inline; margin:20px auto;"></i>{{ trans('admin.search') }}</button>
         </form>
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
                        <th>{{ trans('admin.username') }}</th>
                        <th>{{ trans('admin.type') }}</th>
                        <th>{{ trans('last login') }}</th>
                        <th>{{ trans('admin.edit') }}</th>
                        <th>{{ trans('admin.delete') }}</th>

                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($index as $i)
                            <tr>
                                <td>{{ $i->id }}</td>
                                <td>{{ $i->name }}</td>
                                <td>{{ $i->username }}</td>
                                <td>
                                    @if ($i->type == '2')
                                        {{ trans('admin.trainer') }}
                                    @elseif($i->type == '3')
                                        {{ trans('admin.student') }}
                                    @else
                                         {{ trans('admin.father') }}
                                    @endif
                                </td>
                                <td>{{ $i->last_login }}</td>
                                <td>
                                    <a href="{{ surl('/users/edit/'.$i->id) }}" class="btn btn-secondary btn-min-width mr-1 mb-1"><i
                                        class="ft-edit"></i> {{ trans('admin.edit') }}</a>
                                    <input type="hidden" value="{{ csrf_token() }}" id="csrf_token" />
                                </td>
                                    <td>
                                        <form id="form-id{{ $i->id  }}"  action="{{ route('super.users.destroy', [$i->id]) }}" style="display:inline;" method="post">
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
        <div class="clearfix"></div>
                <div class="pagination" style="margin:10px auto">
                    {{ $index->appends(request()->except('page'))->render() }}
                </div>
      </section>
@endsection
