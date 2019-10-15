@extends('super.layouts.app')
@section('content')
    <a style="font-size:24px; color:#FF0000" href="{{ surl('/school/edit') }}">{{ trans('admin.edit') }}</a>
    <br />
     @include('home')
@endsection
