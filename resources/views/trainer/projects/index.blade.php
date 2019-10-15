@extends('trainer.layouts.app')
@section('content')
     <a href="{{ turl('/projects/create/'.$id) }}">{{ trans('admin.add') }}</a>
     <br /><br /><br /><hr /><br /><br />
     @foreach ($projects as $project)
         {{ $project->id }}
         <br />
         {{ $project->title }}
         <br />
         {{ $project->total }}
         <br />
         {{ $project->level->course->title }}
         <br />
             <a href="{{ turl('/projects/edit/'.$project->id) }}">تعديل</a>
             <br />
                 <a href="{{ turl('/projects/compelete/'.$project->id) }}">التسليمات</a>
         <form id="form-id{{ $project->id  }}" action="{{ route('trainer.project.destroy', [$project->id]) }}" style="display:inline;" method="post">
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
