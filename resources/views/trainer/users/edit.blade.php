@extends('trainer.layouts.app')
@section('content')
    <form class="form form-horizontal striped-rows form-bordered" method="post" enctype="multipart/form-data"  action="{{ route('trainer.user.update') }}">
        @csrf
        @method('PATCH')
     @include('edit')
     </form>
@endsection
