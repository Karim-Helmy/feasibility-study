<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">


      <!-- Main Page -->
      <li class="nav-item"><a href="{{ aurl('/index') }}"><i class="la la-home"></i>
            <span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.dashboard') }}</span></a>
      </li>

      <!-- Messages From Land Page -->
      <li class=" nav-item"><a href="{{ aurl('/contacts') }}"><i class="icon-envelope-letter"></i>
          <span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.visit_messages') }}</span><span class="badge badge badge-pill badge-danger float-right mr-2">{{ $contactt->count() }}</span></a>
      </li>

      <!-- Messages From Supervisor -->
      <li class=" nav-item"><a href="{{ aurl('/messages') }}"><i class="icon-envelope-letter"></i>
          <span class="menu-title" data-i18n="nav.dash.main">{{ trans('admin.messages') }}</span></a>
      </li>

      <!-- Other Links In Menu -->
      <li class=" navigation-header">
        <span data-i18n="nav.category.support">{{ trans('admin.Menu') }}</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip"
          data-placement="right" data-original-title="Support"></i>
      </li>

      <!-- Admins -->
      <li class="nav-item"><a href="#"><i class="fas fa-user-secret"></i><span class="menu-title" data-i18n="nav.templates.main">{{ trans('admin.admins') }}</span></a>
        <ul class="menu-content">
          <li><a class="menu-item" href="{{ aurl('/admins') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.all admins') }}</a></li>
          <li><a class="menu-item" href="{{ aurl('/admins/create') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.create new admin') }}</a></li>
        </ul>
      </li>

      <!-- Categories -->
      <li class="nav-item"><a href="#"><i class="la la-bars"></i><span class="menu-title" data-i18n="nav.templates.main">{{ trans('admin.Categories') }}</span></a>
          <ul class="menu-content">
              <li><a class="menu-item" href="{{ aurl('/categories') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.all category') }}</a></li>
              <li><a class="menu-item" href="{{ aurl('/categories/create') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.add category') }}</a></li>
          </ul>
      </li>

      <!-- Digital repository -->
      <li><a class="menu-item" href="#" data-i18n="nav.templates.horz.main"><i class="la la-file"></i><span class="menu-title" data-i18n="nav.templates.main">{{ trans('admin.Digital repository') }}</span></a>
          <ul class="menu-content">
              <!-- Scorms -->
              <li class="nav-item"><a href="#"><i class="la la-book"></i><span class="menu-title" data-i18n="nav.templates.main">{{ trans('admin.Scorms') }}</span></a>
                <ul class="menu-content">
                  <li><a class="menu-item" href="{{ aurl('/scorms') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.all scorm') }}</a></li>
                  <li><a class="menu-item" href="{{ aurl('/scorms/create') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.add scorm') }}</a></li>
                </ul>
              </li>
              <!-- Photos -->
              <li class="nav-item"><a href="#"><i class="la la-image"></i><span class="menu-title" data-i18n="nav.templates.main">{{ trans('admin.Photos') }}</span></a>
                <ul class="menu-content">
                  <li><a class="menu-item" href="{{ aurl('/photos') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.all photo') }}</a></li>
                  <li><a class="menu-item" href="{{ aurl('/photos/create') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.add photo') }}</a></li>
                </ul>
              </li>
              <!-- Videos -->
              <li class="nav-item"><a href="#"><i class="la la-file-video-o"></i><span class="menu-title" data-i18n="nav.templates.main">{{ trans('admin.Videos') }}</span></a>
                  <ul class="menu-content">
                      <li><a class="menu-item" href="{{ aurl('/videos') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.all videos') }}</a></li>
                      <li><a class="menu-item" href="{{ aurl('/videos/create') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.add videos') }}</a></li>
                  </ul>
              </li>
              <!-- Attachments -->
              <li class="nav-item"><a href="#"><i class="la la-file-text"></i><span class="menu-title" data-i18n="nav.templates.main">{{ trans('admin.Attachments') }}</span></a>
                  <ul class="menu-content">
                      <li><a class="menu-item" href="{{ aurl('/attachments') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.all attachments') }}</a></li>
                      <li><a class="menu-item" href="{{ aurl('/attachments/create') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.add attachments') }}</a></li>
                  </ul>
              </li>
          </ul>
       </li>

      <!-- Packages -->
      <li><a class="menu-item" href="#" data-i18n="nav.templates.horz.main"><i class="la la-server"></i><span class="menu-title" data-i18n="nav.templates.main">{{ trans('admin.packages') }}</span></a>
          <ul class="menu-content">
            <li><a class="menu-item" href="{{ aurl('/options') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.all option') }}</a></li>
            <li><a class="menu-item" href="{{ aurl('/options/create') }}" data-i18n="nav.templates.horz.top_icon">{{ trans('admin.add option') }}</a></li>
            <li><a class="menu-item" href="{{ aurl('/packages') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.all package') }}</a></li>
            <li><a class="menu-item" href="{{ aurl('/packages/create') }}" data-i18n="nav.templates.horz.top_icon">{{ trans('admin.add package') }}</a></li>
          </ul>
       </li>

       <!-- Subscribers -->
       <li><a class="menu-item" href="#" data-i18n="nav.templates.horz.main"><i class="la la-users"></i><span class="menu-title" data-i18n="nav.templates.main">{{ trans('admin.subscribers') }}</span><span class="badge badge badge-pill badge-danger float-right mr-2">{{ $waiting_count }}</span></a>
           <ul class="menu-content">
              <li><a class="menu-item" href="{{ aurl('/subscribers/create') }}" data-i18n="nav.templates.horz.top_icon">{{ trans('admin.add subscriber') }}</a></li>
             <li><a class="menu-item" href="{{ aurl('/subscribers') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.subscribers') }}</a></li>
              <li><a class="menu-item" href="{{ aurl('/subscribers/details') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.Subscribers Statistics') }}</a></li>
             <li><a class="menu-item" href="{{ aurl('/subscribers?status=1') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.subsciber_agree') }}</a></li>
             <li><a class="menu-item" href="{{ aurl('/subscribers?status=0') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.subsciber_waiting1') }}<span class="badge badge badge-pill badge-danger float-right mr-2" style="margin-left:0; margin-right:0;">{{ $waiting_count }}</span></a></li>
             </li>
           </ul>
        </li>

        <!-- Logos -->
        <li class="nav-item"><a href="#"><i class="ft ft-image"></i><span class="menu-title" data-i18n="nav.templates.main">{{ trans('admin.Logos') }}</span></a>
          <ul class="menu-content">
            <li><a class="menu-item" href="{{ aurl('/logos') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.all logo') }}</a></li>
            <li><a class="menu-item" href="{{ aurl('/logos/create') }}" data-i18n="nav.templates.horz.classic">{{ trans('admin.add logo') }}</a></li>
          </ul>
        </li>

       <!-- Settings -->
      <li class=" navigation-header">
        <span data-i18n="nav.category.support">{{ trans('admin.settings') }}</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip"
        data-placement="right" data-original-title="Support"></i>
      </li>
      <li class=" nav-item">
        <a href="{{ aurl('/settings') }}"><i class="icon-settings"></i>
          <span class="menu-title" data-i18n="nav.support_documentation.main">{{ trans('admin.settings') }}</span>
        </a>
      </li>

    </ul>

  </div>
</div>
