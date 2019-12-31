@if(Session::has('project_id'))
<div class="col-md-3">
  <div class="profile_menu mb-md-0 mb-4">


    <div class="profile_details">
      <ul>
        <h2  class="text-center">  @if(!empty(Session::get('project_name')))({{  session()->get('project_name')}}) @endif</h2>
        <li class=" nav-item"><a href="{{ surl('/') }}"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.dashboard') }}</span></a>

        </li>

        <li class=" nav-item"><a href="{{ surl('/team/')}}"><i class="la la-object-group"></i><span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.team') }}</span></a>

        </li>
        <li class=" nav-item"><a href="{{ surl('/elements/')}}"><i class="la la-cubes"></i><span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.elements') }}</span></a>

        </li>
        <li class=" nav-item"><a href="{{ surl('/administrative/')}}"><i class="la la-calculator"></i><span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.administrative') }}</span></a>

        </li>
        <li class=" nav-item"><a href="{{ surl('/fixed/')}}"><i class="la la-bank"></i><span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.fixed') }}</span></a>

        </li>
        <li class=" nav-item"><a href="{{ surl('/outlay/')}}"><i class="la la-share-alt"></i><span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.outlay') }}</span></a>

        </li>
        <li class=" nav-item"><a href="{{ surl('/competitors') }}"><i class="la la-fire"></i><span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.competitors') }}</span></a>

        </li>
        <li class=" nav-item"><a href="{{ surl('/target') }}"><i class="la la-users"></i><span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.target') }}</span></a>

        </li>
        <li class=" nav-item"><a href="{{ surl('/finance') }}"><i class="la la-money"></i><span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.finance') }}</span></a>

        </li>
        <li class=" nav-item"><a href="{{ surl('/plan') }}"><i class="la la-calendar"></i><span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.plan') }}</span></a>

        </li>
        <li class=" nav-item"><a href="{{ surl('/firstyear') }}"><i class="la la-clock-o"></i><span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.firstyear') }}</span></a>

        </li>
        <li class=" nav-item"><a href="{{ surl('/grow') }}"><i class="la la-line-chart"></i><span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.grow') }}</span></a>

        </li>

        <li class=" nav-item"><a href="{{ surl('/tour') }}"><i class="la la-line-chart"></i><span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.tour') }}</span></a>

        </li>

      </ul>


    </div>
  </div>
</div>
@endif
