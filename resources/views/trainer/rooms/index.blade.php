@extends('trainer.layouts.app')
@section('content')
     <a href="{{ turl('/rooms/create/'.$id) }}">{{ trans('admin.add') }}</a>
     <br /><br /><br /><hr /><br /><br />
     @foreach ($rooms as $room)
         {{ $room->title }}
         <br />
         {{ $room->link }}
         <br />
         {{ $room->start_date }}
         <br />
         {{ $room->end_date }}
         <br />
         {{ $room->class_no }}
         <br />
             <a href="{{ turl('/rooms/edit/'.$room->id) }}">تعديل</a>
         <form id="form-id{{ $room->id  }}" action="{{ route('trainer.room.destroy', [$room->id]) }}" style="display:inline;" method="post">
             @csrf
             @method('DELETE')
         </form>
         <a href="#" onclick="document.getElementById('form-id{{ $room->id }}').submit();" class="btn btn-danger btn-min-width btn-glow mr-1 mb-1" ><i
             class="ft-delete"></i> {{ trans('admin.delete') }}</a>
         <br /><br />
         <hr />
         <br /><br />
     @endforeach
@endsection
