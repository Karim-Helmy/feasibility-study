@extends('trainer.layouts.app')
@section('content')
    <form class="form form-horizontal striped-rows form-bordered" method="post"  action="{{ turl('/attachments/store/choose/'.$id) }}">
        @csrf
        @foreach ($attachments as $attachment)
            {{ $attachment->title }}
            <br />
            {{ $attachment->attachments }}
            <br />
            <input type="checkbox" name="attachment_id[]" value="{{ $attachment->id }}" />
            <br /><br /><br /><hr /><br /><br /><br />
        @endforeach
        <div class="form-actions right">
            <button type="submit" class="btn btn-primary">
                <i class="la la-check-square-o"></i> {{ trans('admin.save') }}
            </button>
        </div>
    </form>
@endsection
