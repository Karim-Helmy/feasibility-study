@extends('trainer.layouts.app')
@section('content')
     <a href="{{ turl('/scorms/choose/'.$id) }}">{{ trans('admin.choose') }}</a>
     <br /><br /><br /><hr /><br /><br />
     @foreach ($scorms as $scorm)
         {{ $scorm->scorm ->title }}
         <br />
         {{ $scorm->scorm ->scorm }}
         <br />
         <form id="form-id{{ $scorm->scorm_id  }}" action="{{ route('trainer.scorm.destroy', [$scorm->scorm_id]) }}" style="display:inline;" method="post">
             @csrf
             @method('DELETE')
         </form>
         <a href="#" onclick="document.getElementById('form-id{{ $scorm->scorm_id }}').submit();" class="btn btn-danger btn-min-width btn-glow mr-1 mb-1" ><i
             class="ft-delete"></i> {{ trans('admin.delete') }}</a>
         <br /><br />
         <hr />
         <br /><br />
     @endforeach
@endsection
