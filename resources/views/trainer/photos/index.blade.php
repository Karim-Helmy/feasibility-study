@extends('trainer.layouts.app')
@section('content')
     <a href="{{ turl('/photos/create/'.$id) }}">{{ trans('admin.add') }}</a>
     <br /><br />
     <a href="{{ turl('/photos/choose/'.$id) }}">{{ trans('admin.choose') }}</a>
     <br /><br /><br /><hr /><br /><br />
     @foreach ($photos as $photo)
         {{ $photo->photo ->title }}
         <br />
         {{ $photo->photo ->link }}
         <br />
         {{ $photo->photo->user->name ?? "Admin" }}
         <br />
         @if ($photo->photo->user)
             <a href="{{ turl('/photos/edit/'.$photo->photo_id) }}">تعديل</a>
         @endif
         <form id="form-id{{ $photo->photo_id  }}" action="{{ route('trainer.photo.destroy', [$photo->photo_id]) }}" style="display:inline;" method="post">
             @csrf
             @method('DELETE')
         </form>
         <a href="#" onclick="document.getElementById('form-id{{ $photo->photo_id }}').submit();" class="btn btn-danger btn-min-width btn-glow mr-1 mb-1" ><i
             class="ft-delete"></i> {{ trans('admin.delete') }}</a>
         <br /><br />
         <hr />
         <br /><br />
     @endforeach
@endsection
