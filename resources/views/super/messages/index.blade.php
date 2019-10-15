@extends('super.layouts.app')
@section('content')
    <section>
        <div class="card-deck">
            <table class="table table-striped table-bordered ">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>{{ trans('admin.username') }}</th>
                  <th>{{ trans('admin.type') }}</th>
                  <th>{{ trans('admin.show') }}</th>

                </tr>
              </thead>
              <tbody>
                  @foreach ($index as $i)
                      <tr>
                          <td>{{$i->user->id  ?? "0" }}</td>
                          <td>{{$i->user->username ?? "Super Admin" }}</td>
                          <td>
                                  @if ($i->user)
                                      @if ($i->user->type == '2')
                                          {{ trans('admin.trainer') }}
                                      @elseif($i->user->type == '3')
                                          {{ trans('admin.student') }}
                                      @else
                                          {{ trans('admin.father') }}
                                      @endif
                                  @else
                                     Super Admin
                                  @endif

                          </td>
                          <td>
                              <a href="{{ surl('/messages/show/'.$i->sender_id) }}" class="btn btn-secondary btn-min-width mr-1 mb-1"><i
                                  class="ft-eye"></i> {{ trans('admin.show') }}</a>
                          </td>
                      </tr>
                  @endforeach
              </tbody>

            </table>

        </div>
        <div class="clearfix"></div>
        <div class="pagination" style="margin:10px auto">
            {{ $index->appends(request()->except('page'))->render() }}
        </div>
    </section>
@endsection
