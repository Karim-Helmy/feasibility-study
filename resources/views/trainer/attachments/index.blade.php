@extends('trainer.layouts.app')
@section('content')
     <a href="{{ turl('/attachments/create/'.$id) }}">{{ trans('admin.add') }}</a>
     <br /><br />
     <a href="{{ turl('/attachments/choose/'.$id) }}">{{ trans('admin.choose') }}</a>
     <br /><br /><br /><hr /><br /><br />
     @foreach ($attachments as $attachment)
         {{ $attachment->attachment ->title }}
         <br />
         {{ $attachment->attachment ->attachments }}
         <br />
         {{ $attachment->attachment->user->name ?? "Admin" }}
         <br />
         @if ($attachment->attachment->user)
             <a href="{{ turl('/attachments/edit/'.$attachment->attachment_id) }}">تعديل</a>
         @endif
         <form id="form-id{{ $attachment->attachment_id  }}" action="{{ route('trainer.attachment.destroy', [$attachment->attachment_id]) }}" style="display:inline;" method="post">
             @csrf
             @method('DELETE')
         </form>
         <a href="#" onclick="document.getElementById('form-id{{ $attachment->attachment_id }}').submit();" class="btn btn-danger btn-min-width btn-glow mr-1 mb-1" ><i
             class="ft-delete"></i> {{ trans('admin.delete') }}</a>
         <br /><br />
         <hr />
         <br /><br />
     @endforeach
@endsection
