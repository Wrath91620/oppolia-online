<div class="header-wrapper  sticky-top navbar-inverse">

    <div class="header-content bg-warning">
        <div class="container-fluid">
            <div class="row align-items-center ">
                <div class="col-auto ">
                    <div class="d-flex align-items-center gap-3">
                        <div class="mobile-toggle-menu d-inline d-xl-none" data-bs-toggle="offcanvas"
                             data-bs-target="#offcanvasNavbar">
                            <i class="bx bx-menu"></i>
                        </div>
                        <div class="d-none d-xl-flex my_nav_backgrond1">
                            @if(app()->getLocale() == 'ar')
                                <a href="{{ url('set/lang/en') }}" class="border-3 mx-2 myfont_2">EN</a>
                            @else
                                <a href="{{ url('set/lang/ar') }}" class="border-3 mx-2 myfont_2">AR</a>
                            @endif

                            <?php if(auth()->check()): ?>

                        <!-- إذا كان المستخدم مسجل دخول -->
                                <a href="{{route('orders.myOrders')}}" class="border-3 mx-2 myfont_3 link-offset-4-hover">@lang('home.My Orders')</a>
                                <div class="m dropdown mydropdown">
                                    <a href="#" class="nav-link dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="{{asset('Frontend/assets/images/icons/person.png')}}" alt="User Icon" class="img-fluid" >
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">

                                        <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                                            <i class="bx bx-edit me-2"></i>
                                           @lang('home.Edit Profile')
                                        </a>

                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="dropdown-item d-flex align-items-center">
                                                    <i class="bx bx-log-out me-2"></i>
                                                    @lang('home.Logout')
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>

                            <?php else: ?>
                        <!-- إذا لم يكن المستخدم مسجل دخول -->
                            <a href="#" class="border-3 mx-2 myfont_3 link-offset-4-hover" data-bs-toggle="modal" data-bs-target="#phoneModal">
                                @lang('home.Login')
                            </a>
                            <?php endif; ?>


                        </div>
                    </div>
                </div>
                @if(!auth()->check())
                <div class="col-auto">
                    <div class="top-cart-icons">
                        <nav class="navbar navbar-expand">
                            <ul class="navbar-nav">


                                    {{-- عنصر يظهر فقط على الموبايل --}}
                                    <li class="nav-item d-lg-none">
                                        <a href="#" class="header-font-login"  data-bs-toggle="modal" data-bs-target="#phoneModal">
                                            @lang('home.Login')
                                        </a>
                                    </li>


                            </ul>
                        </nav>
                    </div>
                </div>
                @endif

            @if(auth()->check() && auth()->user()->role === 'user')

                <div class="col-auto ">
                    <div class="top-cart-icons">
                        <nav class="navbar navbar-expand">
                            <ul class="navbar-nav">

                                {{-- Notifications Dropdown --}}
                                @if(isset($notifications) && $notifications->isNotEmpty())
                                    <li class="m nav-item dropdown dropdown-large">

                                        {{-- Notification Bell Icon --}}
                                        <a href="#" class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                                           data-bs-toggle="dropdown"
                                           aria-expanded="false"
                                           role="button">
                                          <span class="alert-count rounded-pill">
                                                 {{ auth()->user()->unreadNotifications->count() }}
                                          </span>
                                            <i class="bx bx-bell fs-5">
                                                <span class="visually-hidden">Notifications</span>
                                            </i>
                                        </a>

                                        {{-- Dropdown Menu --}}
                                        <div class="dropdown-menu dropdown-menu-end shadow-lg border-0"
                                             style="min-width: 320px; max-height: 400px; overflow-y: auto;">

                                            {{-- Dropdown Header --}}
                                            <div class="dropdown-header bg-light py-3">
                                                <div class="d-flex align-items-center">
                                                    <h6 class="mb-0 fw-semibold">

                                                    </h6>

                                                </div>
                                            </div>

                                            {{-- Notifications List --}}
                                            <div class="list-group list-group-flush">
                                                @foreach ($notifications as $notification)
                                                    <a href="{{ route('user.order.show', [
                                'order' => $notification->data['order_id'],
                                'notificationId' => $notification->id
                            ])}}"
                               class="list-group-item list-group-item-action py-3
                                      border-bottom {{ $notification->unread() ? 'bg-light' : '' }}">
                                                        <div class="d-flex align-items-start">

                                                            {{-- Notification Icon --}}
                                                            <div class="flex-shrink-0 me-3">
                                                                <i class="bx bx-info-circle text-warning fs-4"></i>
                                                            </div>

                                                            {{-- Notification Content --}}
                                                            <div class="flex-grow-1">
                                                                <h6 class="mb-1 fw-semibold text-dark">
                                                                    {{ $notification->data['message'] }}
                                                                </h6>
                                                                <p class="mb-0 small text-muted">
                                                                    Order #{{ $notification->data['order_id'] }}
                                                                </p>
                                                                <div class="d-flex justify-content-between align-items-center mt-2">
                                            <span class="badge bg-light text-dark small">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </span>
                                                                    @if($notification->unread())
                                                                        <span class="badge Primary_Green_background small">
                                                New
                                            </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>

                                            {{-- Dropdown Footer --}}
                                            <div class="dropdown-footer bg-light py-3 text-center">

                                            </div>
                                        </div>
                                    </li>
                                @endif

                            </ul>
                        </nav>
                    </div>
                </div>
                @endif




                <div class="col-12 col-xl order-4 order-xl-0">
                    <div class="d-none d-lg-flex justify-content-center pb-3 pb-xl-0"  style="direction: {{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
                        <a href="{{ route('welcome') }}"
                           class="myfont_1 border-3 mx-2 hover-underline {{ Route::currentRouteName() == 'welcome' ? 'myfont_2' : '' }}">
                            @lang('home.Home')
                        </a>
                        <a href="{{ route('home.about') }}" class="myfont_1  hover-underline border-3 mx-2 {{ Route::currentRouteName() == 'home.about' ? 'myfont_2' : '' }}">@lang('home.About')</a>
                        <li class="nav-item dropdown position-relative myfont_1  hover-underline border-3 mx-2 " style="display: block">
                            <a class="nav-link dropdown-toggle myfont_1 {{ Route::currentRouteName() == 'home.products' ? 'myfont_2' : '' }}"
                               href="{{ route('home.products') }}">
                                @lang('home.Product')
                            </a>

                            <ul class="dropdown-menu position-absolute start-0" style="top:100%;">
                                @foreach($categories as $category)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('category.products', $category->id) }}">
                                            {{ app()->getLocale() == 'ar' ? $category->title_ar : $category->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <a href="{{route('home.designers') }}" class="myfont_1  hover-underline border-3 mx-2 {{ Route::currentRouteName() == 'home.designers' ? 'myfont_2' : '' }}">@lang('home.Designers')</a>
                        <a href="{{ route('home.contact') }}" class="myfont_1  hover-underline border-3 mx-2 {{ Route::currentRouteName() == 'home.contact' ? 'myfont_2' : '' }}">@lang('home.Contact')</a>
                        <a href="{{ route('joinasdesigner.create') }}" class="myfont_1 hover-underline  border-3 mx-2 {{ Route::currentRouteName() == 'joinasdesigner.create' ? 'myfont_2' : '' }}">@lang('home.Join As A Designer')</a>
                        @php
                            $allowedRoles = ['admin', 'Area manager', 'Sales manager'];
                        @endphp

                        @if(auth()->check() && in_array(auth()->user()->role, $allowedRoles))
                            <a href="{{ route('admin.orders.index') }}"
                               class="myfont_1 border-3 mx-2 hover-underline {{ Route::currentRouteName() == 'joinasdesigner.create' ? 'myfont_2' : '' }}">
                                @lang('home.dashboard')
                            </a>
                        @endif

                        @if(auth()->check() && auth()->user()->role === 'designer')
                            <a href="{{ route('designer.notification') }}"
                               class="myfont_1 border-3 mx-2 hover-underline {{ Route::currentRouteName() == 'designer.dashboard' ? 'myfont_2' : '' }}">
                                @lang('home.dashboard')
                            </a>
                        @endif



                    </div>
                </div>

                <div class="col-auto ms-auto">
                    <div class="top-cart-icons">


                                <img class="header-logo" src="{{asset('Frontend/assets/images/icons/OPPOLIA ONLINE LOGO.png')}}">




                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <div class="primary-menu d-lg-none">
        <nav class="navbar navbar-expand-xl w-100 navbar-dark container mb-0 p-0">
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">
                <div class="offcanvas-header">
                    <div class="offcanvas-logo"><img src="assets/images/logo-icon.png" width="100" alt="">
                    </div>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body primary-menu">
                    <ul class="navbar-nav justify-content-start flex-grow-1 gap-1">
                        @if(auth()->check())
                        <li class="nav-item">
                            <a href="{{ route('orders.myOrders') }}" class="nav-link mydesplayright">
                                @lang('home.My Orders')
                            </a>
                        </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link mydesplayright"  href="{{ route('welcome') }}">   @lang('home.Home') </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link mydesplayright" href="{{ route('home.about') }}">
                                @lang('home.About')
                            </a>

                        </li>
                        <li class="nav-item ">
                            <a class="nav-link mydesplayright" href="{{route('home.products') }}" >
                                @lang('home.Product')
                            </a>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link mydesplayright" href="{{route('home.designers') }}">@lang('home.Designers')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mydesplayright" href="{{ route('home.contact') }}">@lang('home.Contact')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mydesplayright" href="{{ route('joinasdesigner.create') }}">@lang('home.Join As A Designer')</a>
                        </li>


                            <li class="nav-item">
                                @if(app()->getLocale() == 'ar')
                                    <a class="nav-link mydesplayright" href="{{ url('set/lang/en') }}"> English</a>
                                @else
                                    <a class="nav-link mydesplayright" href="{{ url('set/lang/ar') }}">عربي</a>
                                @endif
                            </li>


                            @if(auth()->check())
                                <li class="nav-item">
                                    <a class="nav-link mydesplayright d-flex align-items-center justify-content-between border-top border-bottom py-4" href="{{ route('profile.edit') }}">
                                        @lang('home.Edit Profile')
                                        <img src="{{ asset('Frontend/assets/images/icons/person1.png') }}" alt="person" width="20" height="20">
                                    </a>
                                </li>

                                <li class="nav-item" style="display: inline-table;     direction: rtl;">
                                    <form method="POST" action="{{ route('logout') }}" >
                                        @csrf
                                        <button type="submit" class="nav-link btn m-2 " >
                                            <i class="bx bx-log-out me-2 py-5"></i>
                                            @lang('home.Logout')

                                        </button>
                                    </form>
                                </li>
                            @endif


                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
