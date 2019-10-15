@extends('trainer.layouts.app')
@section('content')
        <a href="{{ turl('/videos/levels/'.$id) }}">فيديو<a/>
        <br />
        <a href="{{ turl('/photos/levels/'.$id) }}">صور<a/>
        <br />
        <a href="{{ turl('/attachments/levels/'.$id) }}">مرفقات<a/>
        <br />
@endsection
