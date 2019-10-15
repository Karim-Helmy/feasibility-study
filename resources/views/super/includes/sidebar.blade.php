<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">


      <!-- Main Page -->
      <li class="nav-item"><a href="{{ surl('/home') }}"><i class="la la-home"></i>
            <span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.dashboard') }}</span></a>
      </li>

      <!-- Profile -->
      <li class="nav-item"><a href="#"><i class="fas fa-user-secret"></i><span class="menu-title" data-i18n="nav.templates.main">{{ trans('admin.profile') }}</span></a>
        <ul class="menu-content">
          <li><a class="menu-item" href="{{ surl('/show') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.show') }}</a></li>
          <li><a class="menu-item" href="{{ surl('/edit') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.edit') }}</a></li>
        </ul>
      </li>

      <!-- Messages -->
      <li class="nav-item"><a href="#"><i class="fas fa-envelope"></i><span class="menu-title" data-i18n="nav.templates.main">{{ trans('admin.messages') }}</span></a>
        <ul class="menu-content">
          <li><a class="menu-item" href="{{ surl('/messages') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.show') }}</a></li>
        </ul>
      </li>

      <!-- Users -->
      <li class="nav-item"><a href="#"><i class="fas fa-user-secret"></i><span class="menu-title" data-i18n="nav.templates.main">{{ trans('admin.users') }}</span></a>
        <ul class="menu-content">
          <li><a class="menu-item" href="{{ surl('/users/excel') }}" data-i18n="nav.templates.horz.classic">Excel</a></li>
          <li><a class="menu-item" href="{{ surl('/users/create') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.add') }}</a></li>
          <li><a class="menu-item" href="{{ surl('/users') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.show') }}</a></li>
        </ul>
      </li>
      <!-- Courses -->
      <li class="nav-item"><a href="#"><i class="la la-graduation-cap"></i><span class="menu-title" data-i18n="nav.templates.main">{{ trans('admin.courses') }}</span></a>
        <ul class="menu-content">
          <li><a class="menu-item" href="{{ surl('/courses') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.show') }}</a></li>
          <li><a class="menu-item" href="{{ surl('/courses/create') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.add') }}</a></li>

        </ul>
      </li>


    </ul>

  </div>
</div>
