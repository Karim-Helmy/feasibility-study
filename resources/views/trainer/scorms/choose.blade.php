@extends('trainer.layouts.app')
@section('content')
    <form class="form form-horizontal striped-rows form-bordered" method="post"  action="{{ turl('/scorms/store/choose/'.$id) }}">
        @csrf
        @foreach ($scorms as $scorm)
            {{ $scorm->title }}
            <br />
            {{ $scorm->scorm }}
            <br />
            <input type="checkbox" name="scorm_id[]" value="{{ $scorm->id }}" />
            <br /><br /><br /><hr /><br /><br /><br />
        @endforeach
        <div class="form-actions right">
            <button type="submit" class="btn btn-primary">
                <i class="la la-check-square-o"></i> {{ trans('admin.save') }}
            </button>
        </div>
    </form>
@endsection
