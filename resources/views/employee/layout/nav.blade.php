  <!-- HEADER MOBILE-->
  <header class="header-mobile d-block d-lg-none">
      <div class="header-mobile__bar">
          <div class="container-fluid">
              <div class="header-mobile-inner">
                  <a class="logo" href="{{ route('manager.home') }}">
                      <img src="{{ asset('assets/cool_dashboard/images/icon/logo.png') }}" alt="CoolAdmin" />
                  </a>
                  <button class="hamburger hamburger--slider" type="button">
                      <span class="hamburger-box">
                          <span class="hamburger-inner"></span>
                      </span>
                  </button>
              </div>
          </div>
      </div>
      <nav class="navbar-mobile">
          <div class="container-fluid">
              <ul class="navbar-mobile__list list-unstyled">

                  <li>
                      <a href="{{ route('manager.home') }}">
                          <i class="fas fa-chart-bar"></i>{{ trans('app.dashboard') }}</a>
                  </li>

              </ul>
          </div>
      </nav>
  </header>
  <!-- END HEADER MOBILE-->
