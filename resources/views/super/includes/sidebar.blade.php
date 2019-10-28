<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      <li class=" nav-item"><a href="{{ surl('/') }}"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.dashboard') }}</span></a>

      </li>
        <!-- Courses -->

      @if(Session::has('project_id'))
      <li class=" nav-item"><a href="{{ surl('/team/')}}"><i class="la la-object-group"></i><span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.team') }}</span></a>

      </li>
        <li class=" nav-item"><a href="{{ surl('/elements/')}}"><i class="la la-cubes"></i><span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.elements') }}</span></a>

        </li>
        <li class=" nav-item"><a href="{{ surl('/outlay/')}}"><i class="la la-share-alt"></i><span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.outlay') }}</span></a>

        </li>
      <li class=" nav-item"><a href="{{ surl('/competitors') }}"><i class="la la-fire"></i><span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.competitors') }}</span></a>

      </li>
      <li class=" nav-item"><a href="{{ surl('/target') }}"><i class="la la-users"></i><span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.target') }}</span></a>

      </li>
        <li class=" nav-item"><a href="{{ surl('/plan') }}"><i class="la la-calendar"></i><span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.plan') }}</span></a>

        </li>






        <ul class="menu-content">


        </ul>
      </li>
      @endif
    </ul>
  </div>
</div>
