@extends('trainer.layouts.app')
@section('content')
    <form class="form form-horizontal striped-rows form-bordered" method="post"  action="{{ turl('/photos/store/choose/'.$id) }}">
        @csrf
        @foreach ($photos as $photo)
            {{ $photo->title }}
            <br />
            {{ $photo->image }}
            <br />
            <input type="checkbox" name="photo_id[]" value="{{ $photo->id }}" />
            <br /><br /><br /><hr /><br /><br /><br />
        @endforeach
        <div class="form-actions right">
            <button type="submit" class="btn btn-primary">
                <i class="la la-check-square-o"></i> {{ trans('admin.save') }}
            </button>
        </div>
    </form>
@endsection
