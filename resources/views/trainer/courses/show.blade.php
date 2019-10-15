@extends('trainer.layouts.app')
@section('content')
    {{ $course->title }}
    <br />
    {!! $course->description !!}
    <br />
    <a href="{{ turl('/rooms/'.$course->id) }}">الفصول الإفتراضية</a>
    <br />
    <a href="{{ turl('/discussions/'.$course->id) }}">المناقشات</a>
    <br />
    <a href="{{ turl('/users/'.$course->id) }}">قائمة الملتحقين</a>
    <br /><br /><br /><br />
    @foreach ($course->level as $level)
        {{ $level->title }}
        <br /><br />
        <a href="{{ turl('/levels/edit/'.$level->id) }}">تعديل</a>
        <form id="form-id{{ $level->id  }}" action="{{ route('trainer.level.destroy', [$level->id]) }}" style="display:inline;" method="post">
                     @csrf
                     @method('DELETE')
       </form>
       <a href="#" onclick="document.getElementById('form-id{{ $level->id }}').submit();" class="btn btn-danger btn-min-width btn-glow mr-1 mb-1" ><i
               class="ft-delete"></i> {{ trans('admin.delete') }}</a>
        <br /><br />
        <a href="{{ turl('/levels/media/'.$level->id) }}">الوسائط<a/>
        <br />
        <a href="{{ turl('/scorms/levels/'.$level->id) }}">ملقات التعليم الذاتي<a/>
        <br />
        <a href="{{ turl('/projects/'.$level->id) }}">المشاريع<a/>
        <br />
    @endforeach
    <br />
    <a href="#">الإختبارات<a/>
@endsection
