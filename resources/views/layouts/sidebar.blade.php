<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
  <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="{{ route('cms.dashboard.index') }}" class="brand-link">
      <!--begin::Brand Image-->
      {{-- <img src="/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow"> --}}
      <!--end::Brand Image--> <!--begin::Brand Text--> <span class="brand-text fw-light">Shora</span>
      <!--end::Brand Text--> </a> <!--end::Brand Link--> </div>
  <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
    <nav class="mt-2"> <!--begin::Sidebar Menu-->
      <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
        @if (request()->user()->hasPermissions(
                    \App\Enums\PermissionEnum::USERS__LIST,
                    \App\Enums\PermissionEnum::ROLES__LIST,
                    \App\Enums\PermissionEnum::PERMISSIONS__LIST))
          <li
            class="nav-item {{ request()->routeIs('cms.users.*') || request()->routeIs('cms.roles.*') || request()->routeIs('cms.permissions.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link"> <i class="nav-icon bi bi-person-bounding-box"></i>
              <p>
                User Management
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('viewAny', \App\Models\User::class)
                <li class="nav-item">
                  <a href="{{ route('cms.users.index') }}"
                    class="nav-link {{ request()->routeIs('cms.users.*') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-person"></i>
                    <p>{{ __('app.menu.users') }}</p>
                  </a>
                </li>
              @endcan

              @can('viewAny', \App\Models\Role::class)
                <li class="nav-item">
                  <a href="{{ route('cms.roles.index') }}"
                    class="nav-link {{ request()->routeIs('cms.roles.*') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-person-gear"></i>
                    <p>{{ __('app.menu.roles') }}</p>
                  </a>
                </li>
              @endcan

              @can('viewAny', \App\Models\Permission::class)
                <li class="nav-item">
                  <a href="{{ route('cms.permissions.index') }}"
                    class="nav-link {{ request()->routeIs('cms.permissions.*') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-shield-check"></i>
                    <p>{{ __('app.menu.permissions') }}</p>
                  </a>
                </li>
              @endcan
            </ul>
          </li>
        @endif

        @can('viewAny', \App\Models\Note::class)
          <li class="nav-item">
            <a href="{{ route('cms.notes.index') }}"
              class="nav-link {{ request()->routeIs('cms.notes.*') ? 'active' : '' }}">
              <i class="nav-icon bi bi-journal-text"></i>
              <p>{{ __('app.menu.notes') }}</p>
            </a>
          </li>
        @endcan
      </ul> <!--end::Sidebar Menu-->
    </nav>
  </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar--> <!--begin::App Main-->
