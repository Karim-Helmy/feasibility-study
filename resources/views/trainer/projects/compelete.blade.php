@extends('trainer.layouts.app')
@section('content')
    @foreach ($projects as $project)
        {{ $project->id }}
        <br />
        {{ $project->project->title }}
        <br />
        {{ $project->user->name }}
        <br />
        {{ $project->grade ? $project->grade."/".$project->project->total : "Not Rate"}}
        <br />
        {{ $project->project->level->course->title }}
        <br />
            <a href="{{ turl('/projects/compelete/show/'.$project->id) }}">تقييم</a>
            <br />
            @if ($project->user->father_id)
                <a href="{{ turl('/messages/message/'.$project->user->father_id) }}">إرسال رسالة لولي الأمر</a>
                <br />
            @endif
                <br />
        <form id="form-id{{ $project->id  }}" action="{{ route('trainer.rate.destroy', [$project->id]) }}" style="display:inline;" method="post">
            @csrf
            @method('DELETE')
        </form>
        <a href="#" onclick="document.getElementById('form-id{{ $project->id }}').submit();" class="btn btn-danger btn-min-width btn-glow mr-1 mb-1" ><i
            class="ft-delete"></i> {{ trans('admin.delete') }}</a>
        <br /><br />
        <hr />
        <br /><br />
    @endforeach
@endsection
