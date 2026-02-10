 <!-- begin::Credons Sidebar Menu -->
    <aside class="app-menubar-tabs show" id="appMenubar">

      <div class="app-navbar-brand">
        <a class="navbar-brand-logo" href="index.html">
          <img src="{{asset('assets/images/logo.svg')}}"Credons Admin Dashboard Logo">
        </a>
      </div>
      <div class="app-navbar-tabs" data-simplebar>
        <ul class="nav" id="appMenubarTabs" role="tablist" aria-orientation="vertical">
          <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Dashboard">
            <a class="menu-link active" href="#dashboardTab" role="tab" aria-controls="dashboardTab" aria-selected="true" data-bs-toggle="tab">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.5" d="M2 12.2039C2 9.91549 2 8.77128 2.5192 7.82274C3.0384 6.87421 3.98695 6.28551 5.88403 5.10813L7.88403 3.86687C9.88939 2.62229 10.8921 2 12 2C13.1079 2 14.1106 2.62229 16.116 3.86687L18.116 5.10812C20.0131 6.28551 20.9616 6.87421 21.4808 7.82274C22 8.77128 22 9.91549 22 12.2039V13.725C22 17.6258 22 19.5763 20.8284 20.7881C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.7881C2 19.5763 2 17.6258 2 13.725V12.2039Z" stroke="var(--bs-heading-color)" stroke-width="2" />
                <path d="M12 15V18" stroke="var(--bs-heading-color)" stroke-width="2" stroke-linecap="round" />
              </svg>
            </a>
          </li>
      
          <li class="nav-item-hr"></li>
         

          <li class="nav-item mb-auto" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Add Customer">
            <a href="{{route('costomers-new')}}" class="btn btn-icon btn-lg btn-white waves-effect waves-light">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.5" d="M2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12Z" stroke="var(--bs-primary)" stroke-width="2" />
                <path d="M15 12H12M12 12H9M12 12V9M12 12V15" stroke="var(--bs-primary)" stroke-width="2" stroke-linecap="round" />
              </svg>
            </a>
          </li>
        
<li class="nav-item mt-5" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Log out">
  <a class="menu-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">


              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.5" d="M9.00195 7C9.01406 4.82497 9.11051 3.64706 9.87889 2.87868C10.7576 2 12.1718 2 15.0002 2H16.0002C18.8286 2 20.2429 2 21.1215 2.87868C22.0002 3.75736 22.0002 5.17157 22.0002 8V16C22.0002 18.8284 22.0002 20.2426 21.1215 21.1213C20.2429 22 18.8286 22 16.0002 22H15.0002C12.1718 22 10.7576 22 9.87889 21.1213C9.11051 20.3529 9.01406 19.175 9.00195 17" stroke="var(--bs-heading-color)" stroke-width="2" stroke-linecap="round" />
                <path d="M15 12H2M2 12L5.5 9M2 12L5.5 15" stroke="var(--bs-heading-color)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </a>
          </li>
        </ul>
      </div>
      <div class="app-tab-content">
        <div class="app-side-brands">
          <a class="navbar-brand-text" href="index.html">CredOns</a>
        </div>
        <div class="app-content-inner">
          <div class="tab-content" id="appMenubarTabsContent">
            <div class="tab-pane fade show active" id="dashboardTab" role="tabpanel" tabindex="0">
              <nav class="app-navbar" data-simplebar>
                <ul class="side-menubar">
                  <li class="menu-heading">
                    <span class="menu-label">Dashboard</span>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="{{route('dashboard')}}" role="button">
                      <i class="fi fi-rr-house-blank"></i>
                      <span class="menu-label"> Dashboard</span>
                    </a>
                  </li>
                   <li class="menu-item">
                    <a class="menu-link" href="{{route('customers.index')}}" role="button">
                      <i class="fi fi-rr-user"></i>
                      <span class="menu-label">Show Customers Data</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="{{route('costomers-new')}}" role="button">
                      <i class="fi fi-rr-settings"></i>
                      <span class="menu-label">New Customers Data</span>
                    </a>
                  </li>

                 @if(in_array(auth()->user()->role, ['admin','super_admin']))
<li class="menu-item">
  <a class="menu-link" href="{{ route('wordpress.customers.index') }}" role="button">
    <i class="fi fi-rr-globe-alt"></i>
    <span class="menu-label">Website  Data</span>
  </a>
</li>
@endif


                  {{-- Employees List (Admin + Super Admin only) --}}
@if(in_array(auth()->user()->role, ['admin','super_admin']))
<li class="menu-item">
  <a class="menu-link" href="{{ route('employees.index') }}" role="button">
    <i class="fi fi-rr-users"></i>
    <span class="menu-label">Employees</span>
  </a>
</li>
@endif


{{-- Register Employee (Admin + Super Admin only) --}}
@if(in_array(auth()->user()->role, ['admin','super_admin']))
<li class="menu-item">
  <a class="menu-link" href="{{ route('employees.create') }}" role="button">
    <i class="fi fi-rr-user-add"></i>
    <span class="menu-label">Register Employee</span>
  </a>
</li>
@endif

                 
                 
                 
             @auth
  @if(in_array(auth()->user()->role, ['super_admin','admin']))
    <li class="menu-item">
      <a class="menu-link" href="{{ route('ip.whitelist') }}">
        <i class="fi fi-rr-shield-check"></i>

        <span class="menu-label">IP Whitelist</span>
      </a>
    </li>
  @endif
@endauth


                
                
                 
                </ul>
              </nav>
            </div>
            <div class="tab-pane fade" id="appsTab" role="tabpanel" tabindex="0">
              <nav class="app-navbar" data-simplebar>
                <ul class="side-menubar">
                  <li class="menu-heading">
                    <span class="menu-label">Apps</span>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="chat.html">
                      <i class="fi fi-rr-comment"></i>
                      <span class="menu-label">Chat</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="calendar.html">
                      <i class="fi fi-rr-calendar"></i>
                      <span class="menu-label">Calendar</span>
                    </a>
                  </li>
                  <li>
                    <div class="menu-divider"></div>
                  </li>
                  <li class="menu-heading">
                    <span class="menu-label">Email</span>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="email/inbox.html">
                      <i class="fi fi-rr-inbox-in"></i>
                      <span class="menu-label">Inbox</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="email/compose.html">
                      <i class="fi fi-rr-pen-field"></i>
                      <span class="menu-label">Compose</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="email/read-email.html">
                      <i class="fi fi-rr-envelope"></i>
                      <span class="menu-label">Read email</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="tab-pane fade" id="pagesTab" role="tabpanel" tabindex="0">
              <nav class="app-navbar" data-simplebar>
                <ul class="side-menubar">
                  <li class="menu-heading">
                    <span class="menu-label">Pages</span>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="pages/pricing.html">
                      <i class="fi fi-rs-usd-circle"></i>
                      <span class="menu-label">Pricing</span>
                    </a>
                  </li>
                  <li>
                    <div class="menu-divider"></div>
                  </li>
                  <li class="menu-heading">
                    <span class="menu-label">Blog</span>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="pages/blog.html">
                      <i class="fi fi-rr-blog-text"></i>
                      <span class="menu-label">Blog Grid</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="pages/blog-list.html">
                      <i class="fi fi-rr-blog-text"></i>
                      <span class="menu-label">Blog List</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="pages/blog-details.html">
                      <i class="fi fi-rr-blog-text"></i>
                      <span class="menu-label">Blog Details</span>
                    </a>
                  </li>
                  <li>
                    <div class="menu-divider"></div>
                  </li>
                  <li class="menu-heading">
                    <span class="menu-label">Error</span>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="pages/error-404.html">
                      <i class="fi fi-rs-404"></i>
                      <span class="menu-label">Basic</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="pages/error-404-cover.html">
                      <i class="fi fi-rs-404"></i>
                      <span class="menu-label">Cover</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="pages/error-404-full.html">
                      <i class="fi fi-rs-404"></i>
                      <span class="menu-label">Full</span>
                    </a>
                  </li>
                  <li>
                    <div class="menu-divider"></div>
                  </li>
                  <li class="menu-heading">
                    <span class="menu-label">Under Construction</span>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="pages/under-construction.html">
                      <i class="fi fi-rr-under-construction"></i>
                      <span class="menu-label">Basic</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="pages/under-construction-cover.html">
                      <i class="fi fi-rr-under-construction"></i>
                      <span class="menu-label">Cover</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="pages/under-construction-full.html">
                      <i class="fi fi-rr-under-construction"></i>
                      <span class="menu-label">Full</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="tab-pane fade" id="authenticationTab" role="tabpanel" tabindex="0">
              <nav class="app-navbar" data-simplebar>
                <ul class="side-menubar">
                  <li class="menu-heading">
                    <span class="menu-label">Login</span>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="authentication/login-basic.html">
                      <i class="fi fi-rr-unlock"></i>
                      <span class="menu-label">Basic</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="authentication/login-cover.html">
                      <i class="fi fi-rr-unlock"></i>
                      <span class="menu-label">Cover</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="authentication/login-frame.html">
                      <i class="fi fi-rr-unlock"></i>
                      <span class="menu-label">Frame</span>
                    </a>
                  </li>
                  <li>
                    <div class="menu-divider"></div>
                  </li>
                  <li class="menu-heading">
                    <span class="menu-label">Register</span>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="authentication/register-basic.html">
                      <i class="fi fi-rr-enter"></i>
                      <span class="menu-label">Basic</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="authentication/register-cover.html">
                      <i class="fi fi-rr-enter"></i>
                      <span class="menu-label">Cover</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="authentication/register-frame.html">
                      <i class="fi fi-rr-enter"></i>
                      <span class="menu-label">Frame</span>
                    </a>
                  </li>
                  <li>
                    <div class="menu-divider"></div>
                  </li>
                  <li class="menu-heading">
                    <span class="menu-label">Forgot Password</span>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="authentication/forgot-password-basic.html">
                      <i class="fi fi-rs-otp"></i>
                      <span class="menu-label">Basic</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="authentication/forgot-password-cover.html">
                      <i class="fi fi-rs-otp"></i>
                      <span class="menu-label">Cover</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="authentication/forgot-password-frame.html">
                      <i class="fi fi-rs-otp"></i>
                      <span class="menu-label">Frame</span>
                    </a>
                  </li>
                  <li>
                    <div class="menu-divider"></div>
                  </li>
                  <li class="menu-heading">
                    <span class="menu-label">New Password</span>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="authentication/new-password-basic.html">
                      <i class="fi fi-rr-password-alt"></i>
                      <span class="menu-label">Basic</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="authentication/new-password-cover.html">
                      <i class="fi fi-rr-password-alt"></i>
                      <span class="menu-label">Cover</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="authentication/new-password-frame.html">
                      <i class="fi fi-rr-password-alt"></i>
                      <span class="menu-label">Frame</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="tab-pane fade" id="componentsTab" role="tabpanel" tabindex="0">
              <nav class="app-navbar" data-simplebar>
                <ul class="side-menubar">
                  <li class="menu-heading">
                    <span class="menu-label">UI Components</span>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="components/accordion.html">
                      <i class="fi fi-rr-flux-capacitor"></i>
                      <span class="menu-label">Accordion</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="components/alerts.html">
                      <i class="fi fi-rs-bell"></i>
                      <span class="menu-label">Alerts</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="components/badge.html">
                      <i class="fi fi-rr-tags"></i>
                      <span class="menu-label">Badge</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="components/breadcrumb.html">
                      <i class="fi fi-rr-flux-capacitor"></i>
                      <span class="menu-label">Breadcrumb</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="components/buttons.html">
                      <i class="fi fi-rr-toggle-on"></i>
                      <span class="menu-label">Buttons</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="components/typography.html">
                      <i class="fi fi-rr-text"></i>
                      <span class="menu-label">Typography</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="components/button-group.html">
                      <i class="fi fi-rr-toggle-on"></i>
                      <span class="menu-label">Button Group</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="components/card.html">
                      <i class="fi fi-rr-credit-card"></i>
                      <span class="menu-label">Card</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="components/collapse.html">
                      <i class="fi fi-rr-flux-capacitor"></i>
                      <span class="menu-label">Collapse</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="components/carousel.html">
                      <i class="fi fi-rr-flux-capacitor"></i>
                      <span class="menu-label">Carousel</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="components/dropdowns.html">
                      <i class="fi fi-rs-settings-sliders"></i>
                      <span class="menu-label">Dropdowns</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="components/modal.html">
                      <i class="fi fi-rr-flux-capacitor"></i>
                      <span class="menu-label">Modal</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="components/navbar.html">
                      <i class="fi fi-rr-flux-capacitor"></i>
                      <span class="menu-label">Navbar</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="components/list-group.html">
                      <i class="fi fi-rr-list"></i>
                      <span class="menu-label">List Group</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="components/tabs.html">
                      <i class="fi fi-rr-tab-folder"></i>
                      <span class="menu-label">Tabs</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="components/offcanvas.html">
                      <i class="fi fi-rr-flux-capacitor"></i>
                      <span class="menu-label">Offcanvas</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="components/pagination.html">
                      <i class="fi fi-rr-flux-capacitor"></i>
                      <span class="menu-label">Pagination</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="components/popovers.html">
                      <i class="fi fi-rr-flux-capacitor"></i>
                      <span class="menu-label">Popovers</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="components/progress.html">
                      <i class="fi fi-sr-bars-progress"></i>
                      <span class="menu-label">Progress</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="components/scrollspy.html">
                      <i class="fi fi-rr-flux-capacitor"></i>
                      <span class="menu-label">Scrollspy</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="components/spinners.html">
                      <i class="fi fi-br-loading"></i>
                      <span class="menu-label">Spinners</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="components/toasts.html">
                      <i class="fi fi-rr-flux-capacitor"></i>
                      <span class="menu-label">Toasts</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="components/tooltips.html">
                      <i class="fi fi-rr-flux-capacitor"></i>
                      <span class="menu-label">Tooltips</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="tab-pane fade" id="extendedTab" role="tabpanel" tabindex="0">
              <nav class="app-navbar" data-simplebar>
                <ul class="side-menubar">
                  <li class="menu-heading">
                    <span class="menu-label">Extended UI</span>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="extended-ui/avatar.html">
                      <i class="fi fi-rr-circle-user"></i>
                      <span class="menu-label">Avatar</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="extended-ui/card-action.html">
                      <i class="fi fi-rr-credit-card"></i>
                      <span class="menu-label">Card action</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="extended-ui/drag-and-drop.html">
                      <i class="fi fi-rr-arrows"></i>
                      <span class="menu-label">Drag & drop</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="extended-ui/simplebar.html">
                      <i class="fi fi-rr-star"></i>
                      <span class="menu-label">Simplebar</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="extended-ui/swiper.html">
                      <i class="fi fi-rr-sliders-h-square"></i>
                      <span class="menu-label">Swiper</span>
                    </a>
                  </li>
                  <li>
                    <div class="menu-divider"></div>
                  </li>
                  <li class="menu-heading">
                    <span class="menu-label">Icons</span>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="icons/flaticon.html">
                      <i class="fi fi-rr-star"></i>
                      <span class="menu-label">Flaticon</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="icons/lucide.html">
                      <i class="fi fi-rr-star"></i>
                      <span class="menu-label">Lucide</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="icons/fontawesome.html">
                      <i class="fi fi-rr-star"></i>
                      <span class="menu-label">Font Awesome</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="tab-pane fade" id="formElementsTab" role="tabpanel" tabindex="0">
              <nav class="app-navbar" data-simplebar>
                <ul class="side-menubar">
                  <li class="menu-heading">
                    <span class="menu-label">Forms</span>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="forms/form-elements.html">
                      <i class="fi fi-rr-form"></i>
                      <span class="menu-label">Form Elements</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="forms/form-floating.html">
                      <i class="fi fi-rr-form"></i>
                      <span class="menu-label">Form Floating</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="forms/form-input-group.html">
                      <i class="fi fi-rr-form"></i>
                      <span class="menu-label">Form Input Group</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="forms/form-layout.html">
                      <i class="fi fi-rr-form"></i>
                      <span class="menu-label">Form Layout</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="forms/form-validation.html">
                      <i class="fi fi-rr-form"></i>
                      <span class="menu-label">Form Validation</span>
                    </a>
                  </li>

                  <li class="menu-heading">
                    <span class="menu-label">Forms Plugins</span>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="forms/flatpickr.html">
                      <i class="fi fi-rr-calendar-lines"></i>
                      <span class="menu-label">Flatpickr</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="forms/tagify.html">
                      <i class="fi fi-rr-tags"></i>
                      <span class="menu-label">Tagify</span>
                    </a>
                  </li>
                  <li>
                    <div class="menu-divider"></div>
                  </li>
                  <li class="menu-heading">
                    <span class="menu-label">Table</span>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="table/tables-basic.html">
                      <i class="fi fi-rr-table-list"></i>
                      <span class="menu-label">Table</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="table/tables-datatable.html">
                      <i class="fi fi-rr-table"></i>
                      <span class="menu-label">Datatable</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="tab-pane fade" id="chartsTab" role="tabpanel" tabindex="0">
              <nav class="app-navbar" data-simplebar>
                <ul class="side-menubar">
                  <li class="menu-heading">
                    <span class="menu-label">Charts</span>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="chart/apexchart.html">
                      <i class="fi fi-br-chart-histogram"></i>
                      <span class="menu-label">Apex Chart</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="chart/chartjs.html">
                      <i class="fi fi-rr-chart-pie-alt"></i>
                      <span class="menu-label">Chart JS</span>
                    </a>
                  </li>
                  <li>
                    <div class="menu-divider"></div>
                  </li>
                  <li class="menu-heading">
                    <span class="menu-label">Maps</span>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="maps/jsvectormap.html">
                      <i class="fi fi-rr-marker"></i>
                      <span class="menu-label">JS Vector Map</span>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a class="menu-link" href="maps/leaflet.html">
                      <i class="fi fi-rr-map-marker"></i>
                      <span class="menu-label">Leaflet</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
          <div class="card card-gradient mx-3 d-none d-xl-block">
            <div class="card-body">
              <h5>Upgrade to Pro</h5>
              <p class="text-1xs">Get unlimited leads, advanced analytics, and 24/7 priority support.</p>
              <a target="_blank" href="https://themeforest.net/item/Credons-crm-admin-dashboard-bootstrap-template/60903033" class="btn btn-primary waves-effect">Upgrade Now</a>
            </div>
          </div>
        </div>
      </div>
    </aside>
    <!-- end::Credons Sidebar Menu -->