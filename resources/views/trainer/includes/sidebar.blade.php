<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">


      <!-- Main Page -->
      <li class="nav-item"><a href="{{ turl('/home') }}"><i class="la la-home"></i>
            <span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.dashboard') }}</span></a>
      </li>

      <!-- Courses -->
      <li class="nav-item"><a href="{{ turl('/courses') }}"><i class="la la-home"></i>
            <span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.courses') }}</span></a>
      </li>

      <!-- Messages -->
      <li class="nav-item"><a href="#"><i class="fas fa-envelope"></i><span class="menu-title" data-i18n="nav.templates.main">{{ trans('admin.messages') }}</span></a>
        <ul class="menu-content">
          <li><a class="menu-item" href="{{ turl('/messages') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.show') }}</a></li>
        </ul>
      </li>

      <!-- Profile -->
      <li class="nav-item"><a href="#"><i class="fas fa-user-secret"></i><span class="menu-title" data-i18n="nav.templates.main">{{ trans('admin.profile') }}</span></a>
        <ul class="menu-content">
          <li><a class="menu-item" href="{{ turl('/show') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.show') }}</a></li>
          <li><a class="menu-item" href="{{ turl('/edit') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.edit') }}</a></li>
        </ul>
      </li>


    </ul>

  </div>
</div>
