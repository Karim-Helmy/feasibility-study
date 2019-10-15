@extends('super.layouts.app')
@section('content')
    <section>
        <h1>{{ $username }}</h1>
        <br /><br />
        @foreach ($messages as $message)
            <h4 {{ $message['type'] == "send" ? 'style=color:#FF0000' : "" }}>{{ $message['subject'] }}</h4>
            <h4 {{ $message['type'] == "send" ? 'style=color:#FF0000' : "" }}>{{ $message['message'] }}</h4>
            <h4 {{ $message['type'] == "send" ? 'style=color:#FF0000' : "" }}>{{ $message['date'] }}</h4>
            <br /><hr /><br />
        @endforeach
    </section>
    <form class="" action="{{ surl('/messages/send/'.$sender_id) }}" method="post">
        @csrf
        <!-- Name -->
        <div class="form-group row">
            <label class="col-md-3 label-control" for="timesheetinput2">{{ trans("admin.subject") }}</label>
            <div class="col-md-9">
                <div class="position-relative has-icon-left">
                    <input type="text" required  class="form-control" placeholder="{{ trans("admin.subject") }}"
                    name="subject" value="{{ old('subject') }}">
                    <div class="form-control-position">
                        <i class="la la-briefcase"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- Email -->
        <div class="form-group row">
            <label class="col-md-3 label-control">{{ trans('admin.message') }}</label>
            <div class="col-md-9">
                <div class="position-relative has-icon-left">
                    <textarea name="message" class="form-control">{{ old('message') }}</textarea>
                    <div class="form-control-position">
                        <i class="la la-envelope"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions right">
            <button type="submit" class="btn btn-primary">
                <i class="la la-check-square-o"></i> {{ trans("admin.send") }}
            </button>
        </div>
    </form>
@endsection
