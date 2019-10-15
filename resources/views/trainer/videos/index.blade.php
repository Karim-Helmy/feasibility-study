@extends('trainer.layouts.app')
@section('content')
     <a href="{{ turl('/videos/create/'.$id) }}">{{ trans('admin.add') }}</a>
     <br /><br />
     <a href="{{ turl('/videos/choose/'.$id) }}">{{ trans('admin.choose') }}</a>
     <br /><br /><br /><hr /><br /><br />
     @foreach ($videos as $video)
         {{ $video->video ->title }}
         <br />
         {{ $video->video ->link }}
         <br />
         {{ $video->video->user->name ?? "Admin" }}
         <br />
         @if ($video->video->user)
             <a href="{{ turl('/videos/edit/'.$video->video_id) }}">تعديل</a>
         @endif
         <form id="form-id{{ $video->video_id  }}" action="{{ route('trainer.video.destroy', [$video->video_id]) }}" style="display:inline;" method="post">
             @csrf
             @method('DELETE')
         </form>
         <a href="#" onclick="document.getElementById('form-id{{ $video->video_id }}').submit();" class="btn btn-danger btn-min-width btn-glow mr-1 mb-1" ><i
             class="ft-delete"></i> {{ trans('admin.delete') }}</a>
         <br /><br />
         <hr />
         <br /><br />
     @endforeach
@endsection
