@extends('trainer.layouts.app')
@section('content')
    @foreach ($users as $user)
        {{ $user->user_id }}
        <br />
        {{ $user->user->name }}
        <br />
        {{ $user->type == 2 ? trans('admin.trainer') : trans('admin.student') }}
        <br /><br />
        <a href="{{ turl('/users/type/'.$user->id) }}">تعديل</a>
        <br />
        <form id="form-id{{ $user->id  }}" action="{{ route('trainer.users.destroy', [$user->id]) }}" style="display:inline;" method="post">
                     @csrf
                     @method('DELETE')
       </form>
       <a href="#" onclick="document.getElementById('form-id{{ $user->id }}').submit();" class="btn btn-danger btn-min-width btn-glow mr-1 mb-1" ><i
               class="ft-delete"></i> {{ trans('admin.delete') }}</a>
        <br />
        <a href="{{ turl('/messages/message/'.$user->user->id) }}">إرسال رسالة</a>
        <br />
        @if ($user->user->father_id)
            <a href="{{ turl('/messages/message/'.$user->user->father_id) }}">إرسال رسالة لولي الأمر</a>
            <br />
        @endif
        <br/><br /><hr /><br /><br />
    @endforeach
@endsection
