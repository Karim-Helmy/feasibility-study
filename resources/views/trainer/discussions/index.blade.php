@extends('trainer.layouts.app')
@section('content')
     <a href="{{ turl('/discussions/create/'.$id) }}">{{ trans('admin.add') }}</a>
     <br /><br /><br /><hr /><br /><br />
     @foreach ($discussions as $discussion)
         {{ $discussion->title }}
         <br />

         <br />
             <a href="{{ turl('/discussions/edit/'.$discussion->id) }}">تعديل</a>
             <br />
             <a href="{{ turl('/discussions/show/'.$discussion->id) }}">عرض</a>
             <br />
         <form id="form-id{{ $discussion->id  }}" action="{{ route('trainer.discussion.destroy', [$discussion->id]) }}" style="display:inline;" method="post">
             @csrf
             @method('DELETE')
         </form>
         <a href="#" onclick="document.getElementById('form-id{{ $discussion->id }}').submit();" class="btn btn-danger btn-min-width btn-glow mr-1 mb-1" ><i
             class="ft-delete"></i> {{ trans('admin.delete') }}</a>
         <br /><br />
         <hr />
         <br /><br />
     @endforeach
@endsection
