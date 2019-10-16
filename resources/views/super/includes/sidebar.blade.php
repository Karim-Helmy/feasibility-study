<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      <li class=" nav-item"><a href="{{ surl('/home') }}"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.dashboard') }}</span></a>

      </li>
        <!-- Courses -->
      <li class="nav-item"><a href="#"><i class="la la-graduation-cap"></i><span class="menu-title" data-i18n="nav.templates.main">{{ trans('admin.projects') }}</span></a>
        <ul class="menu-content">
          <li><a class="menu-item" href="{{ surl('/courses') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.show') }}</a></li>
          <li><a class="menu-item" href="{{ surl('/courses/create') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.add') }}</a></li>

        </ul>
      </li>
        <ul class="menu-content">


        </ul>
      </li>
    </ul>
  </div>
</div>
