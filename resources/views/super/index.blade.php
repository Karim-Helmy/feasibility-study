@extends('super.layouts.app')
@section('content')
    <!--HERO for large and medium devices-->
    @if(Session::has('project_id'))
<div class="col-md-9">
    @endif

    <!--Hero for mobile devices-->

    <div class="our_mobile_menu">
        <button><i class="fa fa-times"></i></button>
    </div>
<br>

    <section id="timeline" class="timeline-center timeline-wrapper col-md-12"  >
        <h3 class="page-title text-center">{{ trans('admin.my projects') }}</h3>
        <ul class="timeline">
            <li class="timeline-line"></li>

        </ul>
        <ul class="timeline">
            <li class="timeline-line"></li>
            <li class="timeline-item block">
                <div class="timeline-badge" >
                    <a  style="color: green !important;" title="" data-context="inverse" data-container="body" class="border-silc" href="#"
                        data-original-title="block highlight"></a>
                </div>
                <div class="card-headere">
                    <div class="text-center" style="margin-right: 30px">

                        <a href="{{ surl('/projects/create') }}" class="btn round btn-success mr-1 btn-glow "  > {{ trans('admin.intro') }} <i class="ft-bar-chart"></i></a>



                    </div>
                </div>

            </li>
            @if($projects !== null)
                @foreach($projects as $project)
                    <li class="timeline-item"  >
                        <div class="timeline-badge" >
                        </div>
                        <div class="timeline-card card border-grey border-lighten-2">
                            <div class="card-header">
                                <h4 class="card-title"><a href="{{ surl('/projects/edit/'.$project->id) }}"> {{$project->name}}</a></h4>
                            </div>
                            <div class="card-content" >
                                <div class="card-body">
                                    <p class="card-text" style="margin-top: -40px;">{!!$project->goal!!}</p>
                                </div>
                            </div>
                        </div>
                    </li>

                @endforeach
            @endif


        </ul>

    </section>


    @if(Session::has('project_id'))

</div>

@endif
    <style>     #timeline .timeline-item.block:nth-child(even):after {display: none !important;}
        #timeline .timeline-item.block:nth-child(even):before {display: none !important;}

    </style>
@endsection
