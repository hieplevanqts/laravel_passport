<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title') - VanHiep.NET</title>
    @yield('meta_tags')
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <base content="{{ URL::to('/') }}" id="base">
<link href="{{ Module::asset('dashboard:css/main.css') }} " rel="stylesheet">
@stack('styles')
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
       {{-- header --}}
       @include('dashboard::layouts.header')
       @include('dashboard::layouts.setting-theme')
       <div class="app-main">
          {{-- sidebar --}}
          @include('dashboard::layouts.sidebar')
          <div class="app-main__outer">
             <div class="app-main__inner">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                       <div class="page-title-heading">
                          <div class="page-title-icon">
                             <i class="pe-7s-car icon-gradient bg-mean-fruit">
                             </i>
                          </div>
                          <div>
                             Analytics Dashboard
                             <div class="page-title-subheading">This is an example dashboard created using build-in elements and components.
                             </div>
                          </div>
                       </div>
                       <div class="page-title-actions">
                          <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                          <i class="fa fa-star"></i>
                          </button>
                          <div class="d-inline-block dropdown">
                             <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow dropdown-toggle btn btn-info">
                             <span class="btn-icon-wrapper pr-2 opacity-7">
                             <i class="fa fa-business-time fa-w-20"></i>
                             </span>
                             Buttons
                             </button>
                             <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                <ul class="nav flex-column">
                                   <li class="nav-item">
                                      <a href="javascript:void(0);" class="nav-link">
                                         <i class="nav-link-icon lnr-inbox"></i>
                                         <span>
                                         Inbox
                                         </span>
                                         <div class="ml-auto badge badge-pill badge-secondary">86</div>
                                      </a>
                                   </li>
                                   <li class="nav-item">
                                      <a href="javascript:void(0);" class="nav-link">
                                         <i class="nav-link-icon lnr-book"></i>
                                         <span>
                                         Book
                                         </span>
                                         <div class="ml-auto badge badge-pill badge-danger">5</div>
                                      </a>
                                   </li>
                                   <li class="nav-item">
                                      <a href="javascript:void(0);" class="nav-link">
                                      <i class="nav-link-icon lnr-picture"></i>
                                      <span>
                                      Picture
                                      </span>
                                      </a>
                                   </li>
                                   <li class="nav-item">
                                      <a disabled href="javascript:void(0);" class="nav-link disabled">
                                      <i class="nav-link-icon lnr-file-empty"></i>
                                      <span>
                                      File Disabled
                                      </span>
                                      </a>
                                   </li>
                                </ul>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
                @yield('content')
             </div>
             {{-- footer --}}
             @include('dashboard::layouts.footer')
          </div>
          <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
       </div>
    </div>
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script type="text/javascript" src="{{ Module::asset('dashboard:scripts/main.js') }}"></script>
    <script type="text/javascript" src="{{ Module::asset('dashboard:js/admin.js') }}"></script>
    <script type="text/javascript" src="{{ Module::asset('dashboard:js/fix_scripts.js') }}"></script>

    @section('script')
    @show
 </body>
</html>
