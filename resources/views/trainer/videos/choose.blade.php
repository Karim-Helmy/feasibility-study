@extends('trainer.layouts.app')
@section('content')
    <form class="form form-horizontal striped-rows form-bordered" method="post" action="{{ turl('/videos/store/choose/'.$id) }}">
        @csrf
        @foreach ($videos as $video)
            {{ $video->title }}
            <br />
            {{ $video->link }}
            <br />
            <input type="checkbox" name="video_id[]" value="{{ $video->id }}" />
            <br /><br /><br /><hr /><br /><br /><br />
        @endforeach
        <div class="form-actions right">
            <button type="submit" class="btn btn-primary">
                <i class="la la-check-square-o"></i> {{ trans('admin.save') }}
            </button>
        </div>
    </form>
@endsection
