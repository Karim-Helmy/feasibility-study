@extends('trainer.layouts.app')
@section('content')

     @foreach ($discussions as $discussion)
         {{ $discussion->comment }}
         <br />
         {{ $discussion->user->name }}
         <br />
         {{ $discussion->type }}
         <br />


         <br /><br />
         <hr />
         <br /><br />
     @endforeach
     <form id="form-id" action="{{ turl('/discussions/comment/'.$id) }}" style="display:inline;" method="post">
         @csrf
         <div class="form-group row">
             <label class="col-md-3 label-control" for="timesheetinput2">{{ trans('admin.comment') }}</label>
             <div class="col-md-9">
                 <div class="position-relative has-icon-left">
                     <input type="text" required  class="form-control" placeholder="{{ trans('admin.comment') }}"
                     name="comment" value="{{ old('comment') }}">
                     <div class="form-control-position">
                         <i class="la la-tag"></i>
                     </div>
                 </div>
             </div>
         </div>
     </form>
@endsection
