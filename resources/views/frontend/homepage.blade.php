@extends('layouts.Frontend.mainlayoutfrontend')
@section('title') الصفحة الرئيسية @endsection

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .rotate-180 {
            transform: rotate(180deg);
        }
        
        /* Unified spacing for homepage sections */
        .homepage-sections {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }
        
        .homepage-section {
            width: 100%;
        }
        
        /* Remove individual section margins/padding */
        .homepage-section .container,
        .homepage-section .container-fluid {
            padding-top: 0;
            padding-bottom: 0;
        }
        
        /* Specific section overrides if needed */
        .banner-wrapper {
            margin-bottom: 0 !important;
        }
        
        .kitchen-section {
            margin-bottom: 0 !important;
        }
        
        .steps-section {
            margin-bottom: 0 !important;
        }
        
        .benefits-section {
            margin-bottom: 0 !important;
        }
        
        .why-us-section {
            margin-bottom: 0 !important;
        }
        
        .showcase-section {
            margin-bottom: 0 !important;
        }
        
        .german-quality-section {
            margin-bottom: 0 !important;
        }
        
        .designers-section {
            margin-bottom: 0 !important;
        }
        
        /* Enhanced responsive design for Why Us section */
        .why-us-section .card {
            transition: all 0.3s ease;
        }
        
        /* Mobile optimizations */
        @media (max-width: 767px) {
            .why-us-section .card {
                margin-bottom: 1rem;
            }
            
            .why-us-section .why-us-icon {
                font-size: 14px !important;
                margin-bottom: 0.5rem;
            }
            
            .why-us-section .why-us-text {
                font-size: 14px !important;
                line-height: 1.5 !important;
                padding: 15px !important;
            }
            
            .why-us-section .card .d-flex {
                gap: 0.5rem;
            }
        }
        
        /* Tablet optimizations */
        @media (min-width: 768px) and (max-width: 991px) {
            .why-us-section .why-us-text {
                font-size: 15px !important;
                padding: 20px !important;
            }
        }
        
        /* Ensure equal height on all screen sizes */
        .why-us-section .row {
            align-items: stretch;
        }
        
        .why-us-section .col-12.col-md-6 {
            display: flex;
        }
        
        .why-us-section .card {
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        /* Add 2em gap to all flex containers in why-us cards */
        .why-us-section .d-flex.flex-column.flex-md-row {
            gap: 2em !important;
        }
        
        /* Fix why-us-icon alignment */
        .why-us-icon {
            width: 130px !important;
            text-align: center;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
    </style>
@endsection
@section('content')

<div class="homepage-sections">
    <!-- Banner -->
    <section class="homepage-section banner-wrapper position-relative">
        <div class="d-block d-md-none position-relative" dir="rtl">
            <img
                src="{{ asset('Frontend/assets/images/banners/Banner-homeMob.webp') }}"
                alt="Banner"
                class="banner-image img-fluid w-100">

            <!-- this sits on top of the image -->
            <div class="banner-overlay position-absolute top-0 start-0 w-100 h-100"></div>

            <!-- and this is your centered text -->
            <div
                class="banner-text-overlay position-absolute top-50 start-50  text-center px-3">
                <h1 class="banner-text text-nowrap reveal-text reveal-line">
                    @lang('homepage.Your ideas for a perfect home')<br>
                    @lang('homepage.Executing them has become easier')<span class="highlight">@lang('homepage.With Oppolia Online!')</span>
                </h1>
            </div>
        </div>


        <div class="d-none d-md-block">
            <img src="{{ asset('Frontend/assets/images/banners/banner-home.webp') }}"
                 alt="Banner"
                 class="banner-image img-fluid w-100">

            <div class="banner-text-overlay text-center">
                <h1 class="banner-text text-nowrap reveal-text reveal-line">
                    @lang('homepage.Your ideas for a perfect home')<br>
                    @lang('homepage.Executing them has become easier')<span class="highlight">@lang('homepage.With Oppolia Online!')</span>
                </h1>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="homepage-section kitchen-section position-relative justify-content-center"
             style="background-image: url('{{ asset('Frontend/assets/images/gallery/about-section.webp') }}');
                 background-position: center;">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-12 d-flex align-items-center justify-content-center p-4">
                    <h2 class="section-title2">@lang('homepage.About Oppolia')</h2>
                </div>
                <div class="col-12 col-md-9 col-lg-8 p-2 position-relative d-flex align-items-center justify-content-center">
                    <img src="{{ asset('Frontend/assets/images/banners/Vid.png') }}"
                         class="img-fluid w-100 video-style"
                         alt="Custom Video Thumbnail">
                </div>
            </div>
        </div>
    </section>

    <!-- Steps Section -->
    <section class="homepage-section steps-section">
        <div class="container">
            <!-- Heading -->
            <div class="text-center mb-4">
                <h2 class="text-white sub-title">@lang('homepage.Steps to Order from Us')</h2>
            </div>

            <!-- Icons + Arrows -->
            <div class="row g-3 justify-content-center text-white flex-column flex-lg-row align-items-center">
                <!-- Step 1 -->
                <div class="col-12 col-sm-4 col-md-1 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64px" height="64px" viewBox="0 0 64 64" fill="none">
                        <path
                            d="M44.5 13.3333V8M20.5 13.3333V8M9.16667 21.3333H55.8333M8.5 26.784C8.5 21.144 8.5 18.3227 9.66267 16.168C10.714 14.2461 12.3453 12.7053 14.324 11.7653C16.6067 10.6667 19.5933 10.6667 25.5667 10.6667H39.4333C45.4067 10.6667 48.3933 10.6667 50.676 11.7653C52.684 12.7307 54.3133 14.272 55.3373 16.1653C56.5 18.3253 56.5 21.1467 56.5 26.7867V39.8853C56.5 45.5253 56.5 48.3467 55.3373 50.5013C54.286 52.4232 52.6547 53.964 50.676 54.904C48.3933 56 45.4067 56 39.4333 56H25.5667C19.5933 56 16.6067 56 14.324 54.9013C12.3457 53.962 10.7144 52.4222 9.66267 50.5013C8.5 48.3413 8.5 45.52 8.5 39.88V26.784Z"
                            stroke="#F3F3F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <p class="mt-2 text-nowrap" style="place-self: center;">@lang('homepage.Book your appointment')</p>
                </div>

                <!-- Arrow 1→2 -->
                <div class="col-12 col-md-1 text-center align-content-center mb-2">
                    <!-- horizontal on md+ -->
                    <svg class="d-none d-lg-inline-block mx-auto {{ app()->getLocale() === 'en' ? 'rotate-180' : '' }}" xmlns="http://www.w3.org/2000/svg" width="32"
                         height="32" viewBox="0 0 32 32" fill="none">
                        <path d="M6.66663 16H14.6666M18.6666 16H20.6666M24.6666 16H25.3333"
                              stroke="#F3F3F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6.66663 16L12 21.3333" stroke="#F3F3F3" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                        <path d="M6.66663 16L12 10.6667" stroke="#F3F3F3" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                    </svg>
                    <!-- vertical on xs/sm -->
                    <svg class="d-inline-block d-lg-none mx-auto {{ app()->getLocale() === 'en' ? 'rotate-180' : '' }}" xmlns="http://www.w3.org/2000/svg" width="32"
                         height="32" viewBox="0 0 32 32" fill="none" style="transform: rotate(-90deg);">
                        <path d="M6.66663 16H14.6666M18.6666 16H20.6666M24.6666 16H25.3333"
                              stroke="#F3F3F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6.66663 16L12 21.3333" stroke="#F3F3F3" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                        <path d="M6.66663 16L12 10.6667" stroke="#F3F3F3" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                    </svg>
                </div>

                <!-- Step 2 -->
                <div class="col-12 col-sm-4 col-md-1 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="53.331px" height="64" viewBox="0 0 53.331 64"
                         fill="none">
                        <path
                            d="M29.4924 55.5193C29.0572 55.8319 28.5349 56 27.9991 56C27.4633 56 26.941 55.8319 26.5058 55.5193C13.6287 46.3408 -0.0378046 27.4611 13.778 13.8186C17.5709 10.0876 22.6788 7.99766 27.9991 8C33.3324 8 38.4496 10.0933 42.2203 13.8159C56.0361 27.4584 42.3696 46.3355 29.4924 55.5193Z"
                            stroke="#F5F5F5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M24.6658 31.9996C23.9585 31.9996 23.2803 31.7187 22.7802 31.2186C22.2801 30.7185 21.9991 30.0403 21.9991 29.333V23.0398L27.9991 18.6665L33.999 23.0398V29.333C33.999 30.0403 33.718 30.7185 33.2179 31.2186C32.7178 31.7187 32.0396 31.9996 31.3323 31.9996H24.6658Z"
                            stroke="#F5F5F5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <p class="mt-2 text-nowrap" style="place-self: center;">@lang('homepage.Choose Your Location')</p>
                </div>

                <!-- Arrow 2→3 -->
                <div class="col-12 col-md-1 text-center align-content-center mb-2">
                    <!-- horizontal on md+ -->
                    <svg class="d-none d-lg-inline-block mx-auto {{ app()->getLocale() === 'en' ? 'rotate-180' : '' }}" xmlns="http://www.w3.org/2000/svg" width="32"
                         height="32" viewBox="0 0 32 32" fill="none">
                        <path d="M6.66663 16H14.6666M18.6666 16H20.6666M24.6666 16H25.3333"
                              stroke="#F3F3F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6.66663 16L12 21.3333" stroke="#F3F3F3" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                        <path d="M6.66663 16L12 10.6667" stroke="#F3F3F3" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                    </svg>
                    <!-- vertical on xs/sm -->
                    <svg class="d-inline-block d-lg-none mx-auto {{ app()->getLocale() === 'en' ? 'rotate-180' : '' }}" xmlns="http://www.w3.org/2000/svg" width="32"
                         height="32" viewBox="0 0 32 32" fill="none" style="transform: rotate(-90deg);">
                        <path d="M6.66663 16H14.6666M18.6666 16H20.6666M24.6666 16H25.3333"
                              stroke="#F3F3F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6.66663 16L12 21.3333" stroke="#F3F3F3" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                        <path d="M6.66663 16L12 10.6667" stroke="#F3F3F3" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                    </svg>
                </div>

                <!-- Step 3 -->
                <div class="col-12 col-sm-4 col-md-1 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64" fill="none">
                        <path
                            d="M42.3139 8.0016C42.0817 8.03362 41.8655 8.14971 41.7053 8.32185L8.29729 41.7246C7.9009 42.1249 7.9009 42.7654 8.29729 43.1657L20.8213 55.6877C21.0135 55.8879 21.2817 56 21.558 56C21.8343 56 22.1025 55.8879 22.2947 55.6877L55.7027 22.285C56.0991 21.8847 56.0991 21.2442 55.7027 20.8439L43.1787 8.32185C43.1307 8.2618 43.0786 8.20976 43.0186 8.16172C42.8384 8.04563 42.6262 7.98959 42.41 8.0016C42.3779 8.0016 42.3459 8.0016 42.3139 8.0016ZM42.442 10.4996L53.5246 21.5805L21.558 53.51L10.4754 42.4612L13.3902 39.5468L15.8886 42.0448L17.362 40.5717L14.8636 38.0737L17.4901 35.4476L23.0634 41.02L24.5368 39.5468L18.9635 33.9744L21.59 31.3483L24.0884 33.8463L25.5618 32.3731L23.0634 29.8751L25.69 27.249L31.2633 32.8215L32.7367 31.3483L27.1634 25.7758L29.7899 23.1497L32.2883 25.6477L33.7617 24.1745L31.2633 21.6765L33.8898 19.0504L39.4632 24.6229L40.9366 23.1497L35.3632 17.5773L37.9897 14.9512L40.4881 17.4492L41.9615 15.976L39.4632 13.478L42.442 10.4996Z"
                            fill="#F3F3F3" />
                    </svg>
                    <p class="mt-2 text-nowrap" style="place-self: center;">@lang('homepage.Measurements & Details')</p>
                </div>

                <!-- Arrow 3→4 -->
                <div class="col-12 col-md-1 text-center align-content-center mb-2">
                    <!-- horizontal on md+ -->
                    <svg class="d-none d-lg-inline-block mx-auto {{ app()->getLocale() === 'en' ? 'rotate-180' : '' }}" xmlns="http://www.w3.org/2000/svg" width="32"
                         height="32" viewBox="0 0 32 32" fill="none">
                        <path d="M6.66663 16H14.6666M18.6666 16H20.6666M24.6666 16H25.3333"
                              stroke="#F3F3F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6.66663 16L12 21.3333" stroke="#F3F3F3" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                        <path d="M6.66663 16L12 10.6667" stroke="#F3F3F3" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                    </svg>
                    <!-- vertical on xs/sm -->
                    <svg class="d-inline-block d-lg-none mx-auto {{ app()->getLocale() === 'en' ? 'rotate-180' : '' }}" xmlns="http://www.w3.org/2000/svg" width="32"
                         height="32" viewBox="0 0 32 32" fill="none" style="transform: rotate(-90deg);">
                        <path d="M6.66663 16H14.6666M18.6666 16H20.6666M24.6666 16H25.3333"
                              stroke="#F3F3F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6.66663 16L12 21.3333" stroke="#F3F3F3" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                        <path d="M6.66663 16L12 10.6667" stroke="#F3F3F3" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                    </svg>
                </div>

                <!-- Step 4 -->
                <div class="col-12 col-sm-4 col-md-1 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="38" height="64" viewBox="0 0 38 64" fill="none">
                        <path
                            d="M15.0187 34.6186L7.78557 54.4842C7.73711 54.5922 7.61598 54.7425 7.42216 54.9352L6.49185 55.7851C6.24377 55.9971 5.98987 56.0501 5.73016 55.9441C5.47045 55.8381 5.31152 55.6627 5.25338 55.418L5.01789 54.201C4.97913 54.1258 5.00335 53.9273 5.09057 53.6054L12.504 33.312C12.8955 33.655 13.3006 33.9248 13.7192 34.1214C14.1398 34.3218 14.573 34.4856 15.0187 34.6128M19.5366 29.6811C17.5248 29.6811 15.8095 28.9777 14.3908 27.5708C12.9721 26.1639 12.2646 24.4584 12.2685 22.4541C12.2685 20.575 12.8596 19.0024 14.0419 17.7363C15.2261 16.4701 16.5731 15.7146 18.083 15.4699V9.44543C18.083 9.03493 18.2215 8.69092 18.4987 8.41341C18.7758 8.13589 19.1218 7.99809 19.5366 8.00002C19.9513 8.00195 20.2973 8.13974 20.5744 8.41341C20.8516 8.68707 20.9902 9.03108 20.9902 9.44543V15.4728C22.5 15.7175 23.847 16.472 25.0312 17.7363C26.2135 19.0024 26.8046 20.575 26.8046 22.4541C26.8046 24.4564 26.0972 26.162 24.6824 27.5708C23.2675 28.9796 21.5522 29.683 19.5366 29.6811ZM19.5366 26.7903C20.7324 26.7903 21.7587 26.3653 22.6153 25.5154C23.47 24.6636 23.8974 23.6432 23.8974 22.4541C23.8974 21.265 23.47 20.2445 22.6153 19.3927C21.7587 18.5428 20.7324 18.1179 19.5366 18.1179C18.3407 18.1179 17.3145 18.5428 16.4578 19.3927C15.6012 20.2426 15.1738 21.2631 15.1757 22.4541C15.1777 23.6451 15.605 24.6655 16.4578 25.5154C17.3145 26.3653 18.3407 26.7903 19.5366 26.7903ZM24.0544 34.6186C24.5002 34.4895 24.9333 34.3257 25.3539 34.1272C25.7726 33.9287 26.1592 33.6589 26.5139 33.3177L33.9273 53.6083C33.9389 53.6411 33.9632 53.8396 34 54.2038L33.7674 55.418C33.7073 55.6647 33.5474 55.841 33.2877 55.947C33.028 56.053 32.7731 56 32.5231 55.788L31.5957 54.9381L31.2323 54.4871L24.0544 34.6186Z"
                            fill="#F5F5F5" />
                    </svg>
                    <p class="mt-2 text-nowrap" style="place-self: center;">@lang('homepage.Start a Custom Design Plan')</p>
                </div>

                <!-- Arrow 4→5 -->
                <div class="col-12 col-md-1 text-center align-content-center mb-2">
                    <svg class="d-none d-lg-inline-block mx-auto {{ app()->getLocale() === 'en' ? 'rotate-180' : '' }}" xmlns="http://www.w3.org/2000/svg" width="32"
                         height="32" viewBox="0 0 32 32" fill="none">
                        <path d="M6.66663 16H14.6666M18.6666 16H20.6666M24.6666 16H25.3333"
                              stroke="#F3F3F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6.66663 16L12 21.3333" stroke="#F3F3F3" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                        <path d="M6.66663 16L12 10.6667" stroke="#F3F3F3" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                    </svg>
                    <svg class="d-inline-block d-lg-none mx-auto {{ app()->getLocale() === 'en' ? 'rotate-180' : '' }}" xmlns="http://www.w3.org/2000/svg" width="32"
                         height="32" viewBox="0 0 32 32" fill="none" style="transform: rotate(-90deg);">
                        <path d="M6.66663 16H14.6666M18.6666 16H20.6666M24.6666 16H25.3333"
                              stroke="#F3F3F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6.66663 16L12 21.3333" stroke="#F3F3F3" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                        <path d="M6.66663 16L12 10.6667" stroke="#F3F3F3" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                    </svg>
                </div>

                <!-- Step 5 -->
                <div class="col-12 col-sm-4 col-md-1 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64"
                         fill="none">
                        <path
                            d="M38.25 44.9248L29.3453 56L24 52.3072M38.25 26.4608L29.3453 37.5392L24 33.8464M38.25 8L29.3453 19.0784L24 15.3856M49.3333 49.6H81M49.3333 32H81M49.3333 14.4H81"
                            stroke="#F5F5F5" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <p class="mt-2 text-nowrap" style="place-self: center;">@lang('homepage.Follow up')</p>
                </div>

                <!-- Arrow 5→6 -->
                <div class="col-12 col-md-1 text-center align-content-center mb-2">
                    <svg class="d-none d-lg-inline-block mx-auto {{ app()->getLocale() === 'en' ? 'rotate-180' : '' }}" xmlns="http://www.w3.org/2000/svg" width="32"
                         height="32" viewBox="0 0 32 32" fill="none">
                        <path d="M6.66663 16H14.6666M18.6666 16H20.6666M24.6666 16H25.3333"
                              stroke="#F3F3F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6.66663 16L12 21.3333" stroke="#F3F3F3" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                        <path d="M6.66663 16L12 10.6667" stroke="#F3F3F3" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                    </svg>
                    <svg class="d-inline-block d-lg-none mx-auto" xmlns="http://www.w3.org/2000/svg" width="32"
                         height="32" viewBox="0 0 32 32" fill="none" style="transform: rotate(-90deg);">
                        <path d="M6.66663 16H14.6666M18.6666 16H20.6666M24.6666 16H25.3333"
                              stroke="#F3F3F3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6.66663 16L12 21.3333" stroke="#F3F3F3" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                        <path d="M6.66663 16L12 10.6667" stroke="#F3F3F3" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                    </svg>
                </div>

                <!-- Step 6 -->
                <div class="col-12 col-sm-4 col-md-1 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="65" height="64" viewBox="0 0 65 64" fill="none">
                        <mask id="path-1-inside-1_2404_254" fill="white">
                            <path d="M45.3499 8.00423C45.0658 8.01171 44.7706 8.03039 44.4828 8.06403C43.3354 8.19484 42.1506 8.50878 41.0145 8.93111C38.7421 9.77576 36.6492 11.054 35.3037 12.3994C33.8499 13.8533 33.136 15.6285 33.151 17.4524C33.1622 19.0296 33.7527 20.6217 34.616 22.1466L32.4334 24.3591C32.1493 24.5908 32.0185 24.9608 32.1008 25.3196C32.183 25.6747 32.4633 25.955 32.8183 26.0372C33.1771 26.1194 33.5471 25.9886 33.7789 25.7046L36.4698 23.0137C36.7875 22.6922 36.8361 22.1952 36.5894 21.8177C35.6102 20.304 35.0757 18.8091 35.0645 17.4524C35.0533 16.0957 35.5205 14.8736 36.6492 13.7449C37.6957 12.6984 39.669 11.4838 41.7022 10.7251C42.9804 10.2504 44.1987 10.071 45.32 10.0374L41.7022 13.6253C41.6909 13.644 41.6797 13.6664 41.6723 13.6851C40.6893 14.8063 40.6445 16.5143 41.7022 17.572L46.785 22.6549C46.7962 22.6661 46.8037 22.6736 46.8149 22.6848C47.9362 23.6677 49.6441 23.7126 50.7018 22.6549L54.3196 19.0371C54.2897 20.177 54.1103 21.4066 53.632 22.6848C52.877 24.7067 51.6623 26.6576 50.6121 27.7078C49.4834 28.8365 48.2837 29.2514 46.9345 29.2327C45.5853 29.214 44.0567 28.6833 42.4795 27.7377C42.1021 27.5135 41.6237 27.577 41.3135 27.8872L39.7886 29.4121C39.4074 29.7821 39.4037 30.3913 39.7737 30.7725C40.1437 31.1537 40.7529 31.1575 41.1341 30.7875L42.2104 29.7111C43.7652 30.5445 45.3274 31.1238 46.9046 31.1463C48.7135 31.1724 50.5038 30.5072 51.9576 29.0533C53.2993 27.7116 54.5813 25.6336 55.4259 23.3724C56.2706 21.1113 56.7153 18.6596 56.0239 16.5853C55.9155 16.2714 55.6539 16.0397 55.3325 15.9649C55.0073 15.8939 54.671 15.9911 54.4392 16.2265L49.3564 21.2795C49.0873 21.5486 48.5341 21.586 48.1305 21.2795C48.1118 21.2645 48.0894 21.2645 48.0707 21.2496L43.0476 16.2265C42.7636 15.9425 42.7486 15.3482 43.1074 14.9409L48.1305 9.91778C48.366 9.68606 48.4631 9.3497 48.3921 9.02454C48.3174 8.70313 48.0856 8.44151 47.7717 8.33312C47.0055 8.0715 46.1983 7.97807 45.3499 8.00423ZM11.7132 8.09393C11.5114 8.12383 11.3208 8.21726 11.175 8.36302L8.78309 10.755C8.47288 11.0652 8.40935 11.5436 8.63359 11.921L12.67 18.9175C12.8718 19.2463 13.2456 19.422 13.6268 19.3659L15.7197 19.0371L28.696 32.0133L28.2176 32.4917C27.1599 33.5494 27.1599 35.2611 28.2176 36.3188L28.8754 37.0065C29.6378 37.7689 30.688 37.7652 31.6261 37.455L33.2407 39.0397C33.1323 40.3291 33.5098 41.611 34.4366 42.5379L46.0974 54.2285C48.4594 56.5905 52.2865 56.5905 54.6485 54.2285C54.6485 54.2173 54.6485 54.2098 54.6485 54.1986C56.9171 51.8141 56.947 47.9758 54.6485 45.6773L42.9579 34.0166C41.9937 33.0523 40.7117 32.7533 39.4597 32.8206L37.8751 31.206C38.1853 30.268 38.189 29.2177 37.4266 28.4553L36.7389 27.7975C36.2119 27.2706 35.5205 26.9903 34.8253 26.9903C34.1302 26.9903 33.4388 27.2706 32.9118 27.7975L32.4334 28.2759L19.4571 15.2996L19.786 13.2067C19.8421 12.8255 19.6664 12.4517 19.3375 12.2499L12.3411 8.21353C12.1767 8.12009 11.9898 8.07898 11.8029 8.09393C11.773 8.09393 11.7431 8.09393 11.7132 8.09393ZM12.0421 10.2467L17.8127 13.5655L17.5137 15.5089C17.4726 15.8042 17.5735 16.1032 17.7828 16.3162L31.0879 29.6214L30.0415 30.6679L16.7363 17.3627C16.5233 17.1534 16.2243 17.0525 15.929 17.0936L13.9856 17.3926L10.6667 11.622L12.0421 10.2467ZM34.8253 28.9337C35.0384 28.9337 35.2514 29.001 35.3934 29.143L36.0512 29.8307C36.3651 30.1446 36.3614 30.6118 36.111 30.9071C35.7784 31.292 35.8045 31.8713 36.1708 32.2226L38.3534 34.4053C38.574 34.6258 38.8842 34.7267 39.1906 34.6744C40.0764 34.5286 41.0033 34.7528 41.6125 35.362L53.2732 47.0527C54.798 48.5775 54.813 51.2161 53.2732 52.8531C51.6175 54.5088 49.1284 54.5088 47.4727 52.8531L35.7821 41.1924C35.1468 40.557 34.8963 39.6563 35.0944 38.8603C35.1804 38.5239 35.0757 38.1726 34.8253 37.9334L32.6427 35.7507C32.2914 35.3845 31.7121 35.3583 31.3271 35.6909C31.0319 35.9413 30.5647 35.9451 30.2507 35.6311L29.5631 34.9734C29.279 34.6893 29.279 34.1212 29.5631 33.8372L34.2572 29.143C34.3993 29.001 34.6123 28.9337 34.8253 28.9337ZM25.437 31.804C25.2202 31.8339 25.0184 31.9423 24.8689 32.103L20.3242 36.6477C19.6739 36.5206 19.0348 36.4085 18.3807 36.4085C12.9877 36.4085 8.60369 40.7925 8.60369 46.1856C8.60369 51.5787 12.9877 55.9327 18.3807 55.9327C23.7738 55.9327 28.1279 51.5787 28.1279 46.1856C28.1279 45.4867 27.9709 44.7953 27.799 44.1225L31.0879 40.8336C31.4691 40.4636 31.4729 39.8544 31.1029 39.4732C30.7329 39.092 30.1237 39.0882 29.7425 39.4582L26.1247 43.1059C25.8518 43.3676 25.7584 43.7675 25.8855 44.1225C26.1247 44.7579 26.2143 45.397 26.2143 46.1856C26.2143 50.5509 22.746 54.0192 18.3807 54.0192C14.0155 54.0192 10.5172 50.5509 10.5172 46.1856C10.5172 41.8203 14.0155 38.3221 18.3807 38.3221C19.0647 38.3221 19.7524 38.4192 20.4438 38.5912C20.7689 38.6622 21.1091 38.5613 21.3408 38.3221L26.2143 33.4485C26.4984 33.1757 26.5844 32.7533 26.4311 32.3908C26.2816 32.0283 25.9191 31.7966 25.5267 31.804C25.4968 31.804 25.4669 31.804 25.437 31.804ZM38.8617 37.0663L37.4864 38.4417L48.9677 49.923L50.343 48.5476L38.8617 37.0663ZM19.3973 40.6243C19.345 40.6318 19.2964 40.6393 19.2478 40.6542L14.7629 41.91C14.4453 41.9997 14.1949 42.2501 14.1052 42.5678L12.8494 47.0527C12.7447 47.3928 12.8382 47.759 13.0886 48.0094L16.4373 51.3581C16.6802 51.5973 17.0353 51.6908 17.3642 51.5973L21.9687 50.3416C22.305 50.2556 22.5704 49.9903 22.6563 49.6539L23.7925 45.169C23.8859 44.8401 23.7925 44.4851 23.5533 44.2421L20.2046 40.8934C19.9916 40.6841 19.6926 40.5832 19.3973 40.6243ZM19.2179 42.6575L21.7893 45.2288L20.9222 48.6672L17.424 49.5941L14.8526 47.0228L15.7795 43.5843L19.2179 42.6575Z" />
                        </mask>
                        <path d="M45.3499 8.00423C45.0658 8.01171 44.7706 8.03039 44.4828 8.06403C43.3354 8.19484 42.1506 8.50878 41.0145 8.93111C38.7421 9.77576 36.6492 11.054 35.3037 12.3994C33.8499 13.8533 33.136 15.6285 33.151 17.4524C33.1622 19.0296 33.7527 20.6217 34.616 22.1466L32.4334 24.3591C32.1493 24.5908 32.0185 24.9608 32.1008 25.3196C32.183 25.6747 32.4633 25.955 32.8183 26.0372C33.1771 26.1194 33.5471 25.9886 33.7789 25.7046L36.4698 23.0137C36.7875 22.6922 36.8361 22.1952 36.5894 21.8177C35.6102 20.304 35.0757 18.8091 35.0645 17.4524C35.0533 16.0957 35.5205 14.8736 36.6492 13.7449C37.6957 12.6984 39.669 11.4838 41.7022 10.7251C42.9804 10.2504 44.1987 10.071 45.32 10.0374L41.7022 13.6253C41.6909 13.644 41.6797 13.6664 41.6723 13.6851C40.6893 14.8063 40.6445 16.5143 41.7022 17.572L46.785 22.6549C46.7962 22.6661 46.8037 22.6736 46.8149 22.6848C47.9362 23.6677 49.6441 23.7126 50.7018 22.6549L54.3196 19.0371C54.2897 20.177 54.1103 21.4066 53.632 22.6848C52.877 24.7067 51.6623 26.6576 50.6121 27.7078C49.4834 28.8365 48.2837 29.2514 46.9345 29.2327C45.5853 29.214 44.0567 28.6833 42.4795 27.7377C42.1021 27.5135 41.6237 27.577 41.3135 27.8872L39.7886 29.4121C39.4074 29.7821 39.4037 30.3913 39.7737 30.7725C40.1437 31.1537 40.7529 31.1575 41.1341 30.7875L42.2104 29.7111C43.7652 30.5445 45.3274 31.1238 46.9046 31.1463C48.7135 31.1724 50.5038 30.5072 51.9576 29.0533C53.2993 27.7116 54.5813 25.6336 55.4259 23.3724C56.2706 21.1113 56.7153 18.6596 56.0239 16.5853C55.9155 16.2714 55.6539 16.0397 55.3325 15.9649C55.0073 15.8939 54.671 15.9911 54.4392 16.2265L49.3564 21.2795C49.0873 21.5486 48.5341 21.586 48.1305 21.2795C48.1118 21.2645 48.0894 21.2645 48.0707 21.2496L43.0476 16.2265C42.7636 15.9425 42.7486 15.3482 43.1074 14.9409L48.1305 9.91778C48.366 9.68606 48.4631 9.3497 48.3921 9.02454C48.3174 8.70313 48.0856 8.44151 47.7717 8.33312C47.0055 8.0715 46.1983 7.97807 45.3499 8.00423ZM11.7132 8.09393C11.5114 8.12383 11.3208 8.21726 11.175 8.36302L8.78309 10.755C8.47288 11.0652 8.40935 11.5436 8.63359 11.921L12.67 18.9175C12.8718 19.2463 13.2456 19.422 13.6268 19.3659L15.7197 19.0371L28.696 32.0133L28.2176 32.4917C27.1599 33.5494 27.1599 35.2611 28.2176 36.3188L28.8754 37.0065C29.6378 37.7689 30.688 37.7652 31.6261 37.455L33.2407 39.0397C33.1323 40.3291 33.5098 41.611 34.4366 42.5379L46.0974 54.2285C48.4594 56.5905 52.2865 56.5905 54.6485 54.2285C54.6485 54.2173 54.6485 54.2098 54.6485 54.1986C56.9171 51.8141 56.947 47.9758 54.6485 45.6773L42.9579 34.0166C41.9937 33.0523 40.7117 32.7533 39.4597 32.8206L37.8751 31.206C38.1853 30.268 38.189 29.2177 37.4266 28.4553L36.7389 27.7975C36.2119 27.2706 35.5205 26.9903 34.8253 26.9903C34.1302 26.9903 33.4388 27.2706 32.9118 27.7975L32.4334 28.2759L19.4571 15.2996L19.786 13.2067C19.8421 12.8255 19.6664 12.4517 19.3375 12.2499L12.3411 8.21353C12.1767 8.12009 11.9898 8.07898 11.8029 8.09393C11.773 8.09393 11.7431 8.09393 11.7132 8.09393ZM12.0421 10.2467L17.8127 13.5655L17.5137 15.5089C17.4726 15.8042 17.5735 16.1032 17.7828 16.3162L31.0879 29.6214L30.0415 30.6679L16.7363 17.3627C16.5233 17.1534 16.2243 17.0525 15.929 17.0936L13.9856 17.3926L10.6667 11.622L12.0421 10.2467ZM34.8253 28.9337C35.0384 28.9337 35.2514 29.001 35.3934 29.143L36.0512 29.8307C36.3651 30.1446 36.3614 30.6118 36.111 30.9071C35.7784 31.292 35.8045 31.8713 36.1708 32.2226L38.3534 34.4053C38.574 34.6258 38.8842 34.7267 39.1906 34.6744C40.0764 34.5286 41.0033 34.7528 41.6125 35.362L53.2732 47.0527C54.798 48.5775 54.813 51.2161 53.2732 52.8531C51.6175 54.5088 49.1284 54.5088 47.4727 52.8531L35.7821 41.1924C35.1468 40.557 34.8963 39.6563 35.0944 38.8603C35.1804 38.5239 35.0757 38.1726 34.8253 37.9334L32.6427 35.7507C32.2914 35.3845 31.7121 35.3583 31.3271 35.6909C31.0319 35.9413 30.5647 35.9451 30.2507 35.6311L29.5631 34.9734C29.279 34.6893 29.279 34.1212 29.5631 33.8372L34.2572 29.143C34.3993 29.001 34.6123 28.9337 34.8253 28.9337ZM25.437 31.804C25.2202 31.8339 25.0184 31.9423 24.8689 32.103L20.3242 36.6477C19.6739 36.5206 19.0348 36.4085 18.3807 36.4085C12.9877 36.4085 8.60369 40.7925 8.60369 46.1856C8.60369 51.5787 12.9877 55.9327 18.3807 55.9327C23.7738 55.9327 28.1279 51.5787 28.1279 46.1856C28.1279 45.4867 27.9709 44.7953 27.799 44.1225L31.0879 40.8336C31.4691 40.4636 31.4729 39.8544 31.1029 39.4732C30.7329 39.092 30.1237 39.0882 29.7425 39.4582L26.1247 43.1059C25.8518 43.3676 25.7584 43.7675 25.8855 44.1225C26.1247 44.7579 26.2143 45.397 26.2143 46.1856C26.2143 50.5509 22.746 54.0192 18.3807 54.0192C14.0155 54.0192 10.5172 50.5509 10.5172 46.1856C10.5172 41.8203 14.0155 38.3221 18.3807 38.3221C19.0647 38.3221 19.7524 38.4192 20.4438 38.5912C20.7689 38.6622 21.1091 38.5613 21.3408 38.3221L26.2143 33.4485C26.4984 33.1757 26.5844 32.7533 26.4311 32.3908C26.2816 32.0283 25.9191 31.7966 25.5267 31.804C25.4968 31.804 25.4669 31.804 25.437 31.804ZM38.8617 37.0663L37.4864 38.4417L48.9677 49.923L50.343 48.5476L38.8617 37.0663ZM19.3973 40.6243C19.345 40.6318 19.2964 40.6393 19.2478 40.6542L14.7629 41.91C14.4453 41.9997 14.1949 42.2501 14.1052 42.5678L12.8494 47.0527C12.7447 47.3928 12.8382 47.759 13.0886 48.0094L16.4373 51.3581C16.6802 51.5973 17.0353 51.6908 17.3642 51.5973L21.9687 50.3416C22.305 50.2556 22.5704 49.9903 22.6563 49.6539L23.7925 45.169C23.8859 44.8401 23.7925 44.4851 23.5533 44.2421L20.2046 40.8934C19.9916 40.6841 19.6926 40.5832 19.3973 40.6243ZM19.2179 42.6575L21.7893 45.2288L20.9222 48.6672L17.424 49.5941L14.8526 47.0228L15.7795 43.5843L19.2179 42.6575Z" stroke="#F3F3F3" stroke-width="14.2222" mask="url(#path-1-inside-1_2404_254)" />
                    </svg>
                    <p class="mt-2 text-nowrap" style="place-self: center;">@lang('homepage.Delivery & Installation')</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="homepage-section benefits-section">
        <div class="container p-5">
        <div class="row">
            <div class="col-12 ">
                <h3 class="section-title2 fw-bold mb-5 ">@lang('homepage.What Will You Gain from Oppolia Online Services?')</h3>
                <div class="row ">
                    <div class="col-12 col-md-4 mb-4">
                        <div class="text-title">
                            <span class="badge bg-success number-span">1</span>
                            <h5 class="text-title">@lang('homepage.Visualize It Clearly')</h5>
                        </div>
                        <p class="text-content">@lang('homepage.Get a realistic design that helps you picture your new kitchen before you even start.')</p>
                    </div>
                    <div class="col-12 col-md-4 mb-4">
                        <div class="text-title">
                            <span class="badge bg-success number-span">2</span>
                            <h5 class="text-title">@lang('homepage.Your Style, Your Choice')</h5>
                        </div>
                        <p class="text-content">@lang('homepage.Pick the design you love — we’ll tailor the cost study to fit your budget.')</p>
                    </div>
                    <div class="col-12 col-md-4 mb-4">
                        <div class="text-title">
                            <span class="badge bg-success number-span">3</span>
                            <h5 class="text-title">@lang('homepage.With You Every Step of the Way')</h5>
                        </div>
                        <p class="text-content">@lang('homepage.From the first idea to final execution, we’re by your side to ensure everything fits your needs.')</p>
                    </div>
                    <div class="col-12 col-md-4 mb-4">
                        <div class="text-title">
                            <span class="badge bg-success number-span">4</span>
                            <h5 class="text-title">@lang('homepage.Your Taste in Every Detail')</h5>
                        </div>
                        <p class="text-content">@lang('homepage.Choose the materials, colors, and finishes that reflect your style.')</p>
                    </div>
                    <div class="col-12 col-md-4 mb-4">
                        <div class="text-title">
                            <span class="badge bg-success number-span">5</span>
                            <h5 class="text-title">@lang('homepage.Delivered to Your Door')</h5>
                        </div>
                        <p class="text-content">@lang('homepage.Your kitchen is delivered to your home effortlessly, with no hassle.')</p>
                    </div>
                    <div class="col-12 col-md-4 mb-4">
                        <div class="text-title">
                            <span class="badge bg-success number-span">6</span>
                            <h5 class="text-title">@lang('homepage.Support That Stays')</h5>
                        </div>
                        <p class="text-content">@lang('homepage.Even after installation, we’re here to ensure everything runs smoothly and you enjoy your new kitchen to the fullest.')</p>
                    </div>
                </div>
            </div>

            <div class="col-12 text-center mt-5">
                <img src="{{ asset('Frontend/assets/images/gallery/Saudi-Guy.webp') }}"
                class="img-fluid"
                     alt="Customer Happy in Kitchen"
                     >
            </div>
        </div>
        </div>
    </section>

    <!-- Why Us Section -->
    <section class="homepage-section why-us-section py-5" style="background: rgba(80, 159, 150, 0.47);">
        <div class="container text-center" >
            <h2 class="fw-bold mb-5" style="color: rgba(10, 71, 64, 1);">@lang('homepage.Why Choose Us?')</h2>
            <div class="row g-4 justify-content-center align-items-stretch">

                <!-- Card 1 -->
                <div class="col-12 col-md-6 d-flex">
                    <div class="card text-end shadow p-4 w-100 d-flex flex-column justify-content-center tryout h-100">
                        <div class="d-flex flex-column flex-md-row align-items-center
            text-center " style="gap: 2em;">

                        <div class="d-flex flex-column align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="71" height="70" viewBox="0 0 71 70" fill="none">
                                    <path d="M15.9936 3L15.039 3.91315L4.41315 14.539L3.5 15.4936L4.41315 16.4483L25.1667 37.2018L8.52235 53.8461C8.35113 54.0018 8.22142 54.2041 8.14879 54.4272L5.49234 64.3889C5.373 64.8455 5.5079 65.328 5.83996 65.66C6.17201 65.9921 6.65453 66.127 7.11111 66.0077L17.0728 63.3512C17.2959 63.2786 17.4982 63.1489 17.6539 62.9776L63.5607 17.0709C63.5555 17.0761 64.6398 15.9917 64.6398 15.9917C67.1666 13.465 67.1614 9.38171 64.6398 6.86015C62.1131 4.33341 58.035 4.3386 55.5083 6.86015L37.7018 24.6667L16.9483 3.91315L15.9936 3ZM15.9936 6.77714L18.152 8.9355L16.4502 10.6373L18.3595 12.5466L20.0613 10.8448L22.1367 12.9202L19.1066 15.9502L21.016 17.8595L24.046 14.8295L26.1213 16.9049L24.4195 18.6066L26.3289 20.516L28.0307 18.8142L30.106 20.8895L27.076 23.9195L28.9853 25.8289L32.0153 22.7989L34.0907 24.8742L32.3889 26.576L34.0907 28.2778L27.076 35.2925L7.27714 15.4936L15.9936 6.77714ZM56.2969 9.80715L61.6928 15.2031L16.0351 60.8608L10.6392 55.4649L56.2969 9.80715ZM47.954 34.9604L46.9994 35.8736L44.3429 38.53L46.2522 40.4393L47.954 38.7375L50.0294 40.8129L46.9994 43.8429L48.9087 45.7522L51.9387 42.7222L54.014 44.7976L52.3123 46.4994L54.2216 48.4087L55.9234 46.7069L57.9987 48.7822L54.9687 51.8123L56.878 53.7216L59.908 50.6916L61.9834 52.7669L60.2816 54.4687L62.1909 56.378L63.8927 54.6762L64.7229 55.5064L56.0064 64.2229L37.3282 45.5862L35.4604 47.454L55.0517 67.0868L56.0064 68L56.961 67.0868L67.5868 56.461L68.5 55.5064L67.5868 54.5517L47.954 34.9604Z" fill="#509F96" />
                                </svg>
                                <h5 class="why-us-icon">@lang('homepage.Unique Designs')</h5>
                            </div>
                            <div class="ms-0 ms-md-3 mt-3 mt-md-0">
                                <p class="why-us-text">@lang('homepage.We offer a wide range of modern designs to suit every taste, with customization options to meet your specific needs.')</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-12 col-md-6 d-flex">
                    <div class="card text-end shadow p-4 w-100 d-flex flex-column justify-content-center tryout h-100">
                        <div class="d-flex flex-column flex-md-row align-items-center
            text-center h-100">

                        <div class="d-flex flex-column align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="71" height="70" viewBox="0 0 71 70" fill="none">
                                    <g clip-path="url(#clip0_2369_2702)">
                                        <path d="M46.1944 51.1691H49.6361V45.3834H52.2533C53.4044 45.3834 54.3896 44.9771 55.2089 44.1646C56.0282 43.352 56.4378 42.3749 56.4378 41.2331V28.7707C56.4378 27.629 56.0282 26.6506 55.2089 25.8354C54.3896 25.0229 53.4044 24.6166 52.2533 24.6166H43.5772C42.4261 24.6166 41.4409 25.0229 40.6217 25.8354C39.7998 26.648 39.3889 27.6251 39.3889 28.7669V41.2331C39.3889 42.3749 39.7985 43.352 40.6178 44.1646C41.4396 44.9771 42.4261 45.3834 43.5772 45.3834H46.1944V51.1691ZM14.5583 45.3834H18V37.6691H28.1733V45.3834H31.6111V24.6166H28.1694V34.2594H18V24.6166H14.5583V45.3834ZM44.0244 41.9737C43.7263 41.9737 43.4528 41.8503 43.2039 41.6034C42.955 41.3566 42.8306 41.084 42.8306 40.7857V29.2143C42.8306 28.9186 42.955 28.646 43.2039 28.3966C43.4528 28.1471 43.7263 28.0237 44.0244 28.0263H51.8022C52.103 28.0263 52.3778 28.1497 52.6267 28.3966C52.8756 28.646 53 28.9186 53 29.2143V40.7857C53 41.084 52.8756 41.3566 52.6267 41.6034C52.3778 41.8503 52.103 41.9737 51.8022 41.9737H44.0244ZM6.78056 62C4.99167 62 3.49704 61.406 2.29667 60.218C1.0963 59.03 0.497416 57.5463 0.500008 55.7669V14.2331C0.500008 12.4563 1.10019 10.9739 2.30056 9.78586C3.50093 8.59786 4.99427 8.00257 6.78056 8H64.2194C66.0083 8 67.5017 8.59528 68.6994 9.78586C69.8972 10.9764 70.4974 12.4589 70.5 14.2331V55.7707C70.5 57.545 69.8998 59.0274 68.6994 60.218C67.4991 61.4086 66.0057 62.0026 64.2194 62H6.78056ZM6.78056 58.1429H64.2194C64.8157 58.1429 65.3641 57.896 65.8644 57.4023C66.3648 56.9086 66.6137 56.3634 66.6111 55.7669V14.2331C66.6111 13.6391 66.3622 13.094 65.8644 12.5977C65.3667 12.1014 64.8183 11.8546 64.2194 11.8571H6.78056C6.18427 11.8571 5.63593 12.104 5.13556 12.5977C4.63519 13.0914 4.3863 13.6366 4.3889 14.2331V55.7707C4.3889 56.3621 4.63778 56.906 5.13556 57.4023C5.63334 57.8986 6.18167 58.1454 6.78056 58.1429Z" fill="#509F96" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2369_2702">
                                            <rect width="70" height="70" fill="white" transform="translate(0.5)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <h5 class="why-us-icon">@lang('homepage.High Quality')</h5>
                            </div>
                            <div class="ms-0 ms-md-3 mt-3 mt-md-0">
                                <p class="why-us-text">@lang('homepage.We use the finest materials and techniques in every piece we create to ensure comfort and durability.')</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-12 col-md-6 d-flex">
                    <div class="card text-end shadow p-4 w-100 d-flex flex-column justify-content-center tryout h-100">
                        <div class="d-flex flex-column flex-md-row align-items-center
            text-center  h-100">

                        <div class="d-flex flex-column align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="75" height="70" viewBox="0 0 75 70" fill="none">
                                    <mask id="path-1-inside-1_2369_2692" fill="white">
                                        <path d="M37.5 3C24.6541 3 14.0616 12.8051 12.7894 25.3438C11.528 25.7543 10.5253 26.7591 10.1156 28.0233C8.14805 28.4176 6.43922 29.7682 5.2425 31.5672C3.81398 33.7119 3 36.5372 3 39.6489C3 42.7606 3.81398 45.586 5.2425 47.7307C6.43922 49.5297 8.14805 50.8802 10.1156 51.2746C10.6547 52.9385 12.2072 54.1702 14.04 54.1702C16.3095 54.1702 18.18 52.2956 18.18 50.0213V29.2766C18.18 27.5587 17.0965 26.1001 15.5925 25.4734C16.8 14.388 26.115 5.76596 37.5 5.76596C48.885 5.76596 58.2 14.388 59.4075 25.4734C57.9035 26.1001 56.82 27.5587 56.82 29.2766V50.0213C56.82 51.7878 57.9682 53.2734 59.5369 53.8677C59.3482 56.5094 58.4534 58.4974 57.0356 59.9182C55.4346 61.5227 53.0951 62.4681 49.92 62.4681H45.5213C44.9445 60.869 43.4243 59.7021 41.64 59.7021H34.74C32.4705 59.7021 30.6 61.5767 30.6 63.8511C30.6 66.1254 32.4705 68 34.74 68H41.64C43.4243 68 44.9445 66.8331 45.5213 65.234H49.92C53.6449 65.234 56.8254 64.105 59.0194 61.9062C60.9923 59.929 62.092 57.1631 62.2969 53.9109C63.5152 53.4841 64.4855 52.5063 64.8844 51.2746C66.852 50.8802 68.5608 49.5297 69.7575 47.7307C71.186 45.586 72 42.7606 72 39.6489C72 36.5372 71.186 33.7119 69.7575 31.5672C68.5608 29.7682 66.852 28.4176 64.8844 28.0233C64.4747 26.7591 63.472 25.7543 62.2106 25.3438C60.9384 12.8051 50.3459 3 37.5 3ZM14.04 27.8936C14.8162 27.8936 15.42 28.4987 15.42 29.2766V50.0213C15.42 50.7992 14.8162 51.4043 14.04 51.4043C13.2638 51.4043 12.66 50.7992 12.66 50.0213V29.2766C12.66 28.4987 13.2638 27.8936 14.04 27.8936ZM60.96 27.8936C61.7362 27.8936 62.34 28.4987 62.34 29.2766V50.0213C62.34 50.7992 61.7362 51.4043 60.96 51.4043C60.1838 51.4043 59.58 50.7992 59.58 50.0213V29.2766C59.58 28.4987 60.1838 27.8936 60.96 27.8936ZM9.9 30.9621V48.3358C9.04289 47.9684 8.22891 47.2715 7.52812 46.2181C6.46078 44.6136 5.76 42.2636 5.76 39.6489C5.76 37.0342 6.46078 34.6843 7.52812 33.0798C8.22891 32.0263 9.04289 31.3295 9.9 30.9621ZM65.1 30.9621C65.9571 31.3295 66.7711 32.0263 67.4719 33.0798C68.5392 34.6843 69.24 37.0342 69.24 39.6489C69.24 42.2636 68.5392 44.6136 67.4719 46.2181C66.7711 47.2715 65.9571 47.9684 65.1 48.3358V30.9621ZM34.74 62.4681H41.64C42.4162 62.4681 43.02 63.0731 43.02 63.8511C43.02 64.629 42.4162 65.234 41.64 65.234H34.74C33.9638 65.234 33.36 64.629 33.36 63.8511C33.36 63.0731 33.9638 62.4681 34.74 62.4681Z" />
                                    </mask>
                                    <path d="M12.7894 25.3438L14.1435 29.5039L16.8543 28.6216L17.142 25.7854L12.7894 25.3438ZM10.1156 28.0233L10.9754 32.313L13.4876 31.8094L14.2775 29.3721L10.1156 28.0233ZM5.2425 31.5672L8.88373 33.9925L8.88513 33.9903L5.2425 31.5672ZM5.2425 47.7307L8.88513 45.3075L8.88372 45.3054L5.2425 47.7307ZM10.1156 51.2746L14.2776 49.9262L13.4879 47.4885L10.9754 46.9849L10.1156 51.2746ZM15.5925 25.4734L11.2432 24.9997L10.8888 28.2531L13.9098 29.5119L15.5925 25.4734ZM59.4075 25.4734L61.0902 29.5119L64.1112 28.2531L63.7568 24.9997L59.4075 25.4734ZM59.5369 53.8677L63.9008 54.1794L64.1328 50.9303L61.0867 49.7764L59.5369 53.8677ZM45.5213 62.4681L41.4058 63.9526L42.4484 66.8431H45.5213V62.4681ZM45.5213 65.234V60.859H42.4484L41.4058 63.7496L45.5213 65.234ZM59.0194 61.9062L55.9225 58.816V58.816L59.0194 61.9062ZM62.2969 53.9109L60.8504 49.7819L58.1129 50.7409L57.9305 53.6359L62.2969 53.9109ZM64.8844 51.2746L64.0246 46.9849L61.5118 47.4886L60.7222 49.9266L64.8844 51.2746ZM69.7575 47.7307L66.1163 45.3054L66.1149 45.3075L69.7575 47.7307ZM69.7575 31.5672L66.1149 33.9903L66.1163 33.9925L69.7575 31.5672ZM64.8844 28.0233L60.7225 29.3721L61.5124 31.8094L64.0246 32.313L64.8844 28.0233ZM62.2106 25.3438L57.858 25.7854L58.1457 28.6216L60.8565 29.5039L62.2106 25.3438ZM9.9 30.9621H14.275V24.3271L8.17652 26.9409L9.9 30.9621ZM9.9 48.3358L8.17652 52.357L14.275 54.9708V48.3358H9.9ZM7.52812 46.2181L3.88549 48.6413L3.88549 48.6413L7.52812 46.2181ZM7.52812 33.0798L3.88549 30.6566L3.88549 30.6566L7.52812 33.0798ZM65.1 30.9621L66.8235 26.9409L60.725 24.3271V30.9621H65.1ZM67.4719 33.0798L63.8292 35.503V35.503L67.4719 33.0798ZM67.4719 46.2181L63.8292 43.7949V43.7949L67.4719 46.2181ZM65.1 48.3358H60.725V54.9708L66.8235 52.357L65.1 48.3358ZM37.5 -1.375C22.3789 -1.375 9.93251 10.1597 8.43672 24.9021L17.142 25.7854C18.1906 15.4505 26.9294 7.375 37.5 7.375V-1.375ZM11.4353 21.1836C8.83907 22.0286 6.7944 24.0805 5.95374 26.6745L14.2775 29.3721C14.2645 29.4123 14.2458 29.4378 14.23 29.4537C14.2142 29.4695 14.1872 29.4897 14.1435 29.5039L11.4353 21.1836ZM9.25584 23.7336C5.86653 24.4129 3.25985 26.6486 1.59987 29.144L8.88513 33.9903C9.61858 32.8878 10.4296 32.4224 10.9754 32.313L9.25584 23.7336ZM1.60128 29.1418C-0.372858 32.1057 -1.375 35.8038 -1.375 39.6489H7.375C7.375 37.2707 8.00083 35.318 8.88372 33.9925L1.60128 29.1418ZM-1.375 39.6489C-1.375 43.4941 -0.372858 47.1922 1.60128 50.156L8.88372 45.3054C8.00083 43.9799 7.375 42.0272 7.375 39.6489H-1.375ZM1.59987 50.1539C3.25985 52.6493 5.86653 54.885 9.25584 55.5643L10.9754 46.9849C10.4296 46.8755 9.61858 46.4101 8.88513 45.3075L1.59987 50.1539ZM5.9536 52.623C7.0389 55.9729 10.1889 58.5452 14.04 58.5452V49.7952C14.0752 49.7952 14.1145 49.8016 14.1511 49.8142C14.186 49.8262 14.2104 49.8409 14.2257 49.8524C14.2502 49.8709 14.2667 49.8923 14.2776 49.9262L5.9536 52.623ZM14.04 58.5452C18.7346 58.5452 22.555 54.703 22.555 50.0213H13.805C13.805 49.937 13.8424 49.8801 13.8641 49.8584C13.8859 49.8365 13.9471 49.7952 14.04 49.7952V58.5452ZM22.555 50.0213V29.2766H13.805V50.0213H22.555ZM22.555 29.2766C22.555 25.6465 20.2704 22.683 17.2752 21.4349L13.9098 29.5119C13.8995 29.5075 13.8831 29.4991 13.8622 29.4691C13.8499 29.4515 13.835 29.4245 13.8231 29.3877C13.8107 29.3493 13.805 29.3101 13.805 29.2766H22.555ZM19.9418 25.9472C20.9123 17.0369 28.3925 10.141 37.5 10.141V1.39096C23.8375 1.39096 12.6877 11.7391 11.2432 24.9997L19.9418 25.9472ZM37.5 10.141C46.6075 10.141 54.0877 17.0369 55.0582 25.9472L63.7568 24.9997C62.3123 11.7391 51.1625 1.39096 37.5 1.39096V10.141ZM57.7248 21.4349C54.7296 22.683 52.445 25.6465 52.445 29.2766H61.195C61.195 29.3101 61.1893 29.3493 61.1769 29.3877C61.165 29.4245 61.1501 29.4515 61.1378 29.4691C61.1169 29.4991 61.1005 29.5075 61.0902 29.5119L57.7248 21.4349ZM52.445 29.2766V50.0213H61.195V29.2766H52.445ZM52.445 50.0213C52.445 53.7657 54.8722 56.779 57.987 57.959L61.0867 49.7764C61.0949 49.7795 61.1105 49.7862 61.1324 49.8164C61.1454 49.8343 61.1618 49.8626 61.1749 49.9021C61.1887 49.9433 61.195 49.9855 61.195 50.0213H52.445ZM55.173 53.556C55.0463 55.3303 54.4953 56.2702 53.9387 56.828L60.1325 63.0085C62.4114 60.7247 63.6501 57.6885 63.9008 54.1794L55.173 53.556ZM53.9387 56.828C53.3248 57.4432 52.192 58.0931 49.92 58.0931V66.8431C53.9982 66.8431 57.5444 65.6022 60.1325 63.0085L53.9387 56.828ZM49.92 58.0931H45.5213V66.8431H49.92V58.0931ZM49.6367 60.9836C48.476 57.7657 45.3882 55.3271 41.64 55.3271V64.0771C41.6061 64.0771 41.5681 64.0711 41.5324 64.0592C41.4983 64.0478 41.474 64.0337 41.4582 64.0223C41.4325 64.0035 41.4167 63.9827 41.4058 63.9526L49.6367 60.9836ZM41.64 55.3271H34.74V64.0771H41.64V55.3271ZM34.74 55.3271C30.0454 55.3271 26.225 59.1694 26.225 63.8511H34.975C34.975 63.9353 34.9376 63.9922 34.9159 64.014C34.8941 64.0358 34.8329 64.0771 34.74 64.0771V55.3271ZM26.225 63.8511C26.225 68.5328 30.0454 72.375 34.74 72.375V63.625C34.8329 63.625 34.8941 63.6663 34.9159 63.6882C34.9376 63.7099 34.975 63.7668 34.975 63.8511H26.225ZM34.74 72.375H41.64V63.625H34.74V72.375ZM41.64 72.375C45.3882 72.375 48.476 69.9364 49.6367 66.7185L41.4058 63.7496C41.4167 63.7194 41.4325 63.6986 41.4582 63.6799C41.474 63.6684 41.4983 63.6543 41.5324 63.6429C41.5681 63.631 41.6061 63.625 41.64 63.625V72.375ZM45.5213 69.609H49.92V60.859H45.5213V69.609ZM49.92 69.609C54.5068 69.609 58.9115 68.2083 62.1163 64.9965L55.9225 58.816C54.7393 60.0017 52.783 60.859 49.92 60.859V69.609ZM62.1163 64.9965C64.9966 62.1099 66.4069 58.2561 66.6632 54.1859L57.9305 53.6359C57.7772 56.07 56.988 57.7481 55.9225 58.816L62.1163 64.9965ZM63.7433 58.0399C66.2267 57.1699 68.2185 55.1794 69.0465 52.6226L60.7222 49.9266C60.7389 49.8751 60.7628 49.843 60.7801 49.8254C60.7968 49.8085 60.8189 49.793 60.8504 49.7819L63.7433 58.0399ZM65.7442 55.5643C69.1335 54.885 71.7401 52.6493 73.4001 50.1539L66.1149 45.3075C65.3814 46.4101 64.5704 46.8755 64.0246 46.9849L65.7442 55.5643ZM73.3987 50.156C75.3729 47.1922 76.375 43.4941 76.375 39.6489H67.625C67.625 42.0272 66.9992 43.9799 66.1163 45.3054L73.3987 50.156ZM76.375 39.6489C76.375 35.8038 75.3729 32.1057 73.3987 29.1418L66.1163 33.9925C66.9992 35.318 67.625 37.2707 67.625 39.6489H76.375ZM73.4001 29.144C71.7401 26.6486 69.1335 24.4129 65.7442 23.7336L64.0246 32.313C64.5704 32.4224 65.3814 32.8878 66.1149 33.9903L73.4001 29.144ZM69.0463 26.6745C68.2056 24.0805 66.1609 22.0286 63.5647 21.1836L60.8565 29.5039C60.8128 29.4897 60.7858 29.4695 60.77 29.4537C60.7542 29.4378 60.7355 29.4123 60.7225 29.3721L69.0463 26.6745ZM66.5633 24.9021C65.0675 10.1597 52.6211 -1.375 37.5 -1.375V7.375C48.0706 7.375 56.8094 15.4505 57.858 25.7854L66.5633 24.9021ZM14.04 32.2686C12.3911 32.2686 11.045 30.906 11.045 29.2766H19.795C19.795 26.0913 17.2414 23.5186 14.04 23.5186V32.2686ZM11.045 29.2766V50.0213H19.795V29.2766H11.045ZM11.045 50.0213C11.045 48.3919 12.3911 47.0293 14.04 47.0293V55.7793C17.2414 55.7793 19.795 53.2065 19.795 50.0213H11.045ZM14.04 47.0293C15.6889 47.0293 17.035 48.3919 17.035 50.0213H8.285C8.285 53.2065 10.8386 55.7793 14.04 55.7793V47.0293ZM17.035 50.0213V29.2766H8.285V50.0213H17.035ZM17.035 29.2766C17.035 30.906 15.6889 32.2686 14.04 32.2686V23.5186C10.8386 23.5186 8.285 26.0913 8.285 29.2766H17.035ZM60.96 32.2686C59.3111 32.2686 57.965 30.906 57.965 29.2766H66.715C66.715 26.0913 64.1614 23.5186 60.96 23.5186V32.2686ZM57.965 29.2766V50.0213H66.715V29.2766H57.965ZM57.965 50.0213C57.965 48.3919 59.3111 47.0293 60.96 47.0293V55.7793C64.1614 55.7793 66.715 53.2065 66.715 50.0213H57.965ZM60.96 47.0293C62.6089 47.0293 63.955 48.3919 63.955 50.0213H55.205C55.205 53.2065 57.7586 55.7793 60.96 55.7793V47.0293ZM63.955 50.0213V29.2766H55.205V50.0213H63.955ZM63.955 29.2766C63.955 30.906 62.6089 32.2686 60.96 32.2686V23.5186C57.7586 23.5186 55.205 26.0913 55.205 29.2766H63.955ZM5.525 30.9621V48.3358H14.275V30.9621H5.525ZM11.6235 44.3145C11.7033 44.3488 11.5041 44.296 11.1708 43.7949L3.88549 48.6413C4.95371 50.2471 6.38244 51.5881 8.17652 52.357L11.6235 44.3145ZM11.1708 43.7949C10.6571 43.0227 10.135 41.5498 10.135 39.6489H1.385C1.385 42.9774 2.26448 46.2045 3.88549 48.6413L11.1708 43.7949ZM10.135 39.6489C10.135 37.748 10.6571 36.2752 11.1708 35.503L3.88549 30.6566C2.26448 33.0934 1.385 36.3205 1.385 39.6489H10.135ZM11.1708 35.503C11.5041 35.0019 11.7033 34.9491 11.6235 34.9833L8.17652 26.9409C6.38244 27.7098 4.95371 29.0508 3.88549 30.6566L11.1708 35.503ZM63.3765 34.9833C63.2967 34.9491 63.4959 35.0019 63.8292 35.503L71.1145 30.6566C70.0463 29.0508 68.6176 27.7098 66.8235 26.9409L63.3765 34.9833ZM63.8292 35.503C64.3429 36.2752 64.865 37.748 64.865 39.6489H73.615C73.615 36.3205 72.7355 33.0934 71.1145 30.6566L63.8292 35.503ZM64.865 39.6489C64.865 41.5498 64.3429 43.0227 63.8292 43.7949L71.1145 48.6413C72.7355 46.2045 73.615 42.9774 73.615 39.6489H64.865ZM63.8292 43.7949C63.4959 44.296 63.2967 44.3488 63.3765 44.3145L66.8235 52.357C68.6176 51.5881 70.0463 50.2471 71.1145 48.6413L63.8292 43.7949ZM69.475 48.3358V30.9621H60.725V48.3358H69.475ZM34.74 66.8431H41.64V58.0931H34.74V66.8431ZM41.64 66.8431C39.9911 66.8431 38.645 65.4805 38.645 63.8511H47.395C47.395 60.6658 44.8414 58.0931 41.64 58.0931V66.8431ZM38.645 63.8511C38.645 62.2216 39.9911 60.859 41.64 60.859V69.609C44.8414 69.609 47.395 67.0363 47.395 63.8511H38.645ZM41.64 60.859H34.74V69.609H41.64V60.859ZM34.74 60.859C36.3889 60.859 37.735 62.2216 37.735 63.8511H28.985C28.985 67.0363 31.5386 69.609 34.74 69.609V60.859ZM37.735 63.8511C37.735 65.4805 36.3889 66.8431 34.74 66.8431V58.0931C31.5386 58.0931 28.985 60.6658 28.985 63.8511H37.735Z" fill="#509F96" mask="url(#path-1-inside-1_2369_2692)" />
                                </svg>
                                <h5 class="why-us-icon">@lang('homepage.Exceptional Customer Experience')</h5>
                            </div>
                            <div class="ms-0 ms-md-3 mt-3 mt-md-0">
                                <p class="why-us-text">@lang('homepage.We care about customer satisfaction and strive to deliver outstanding service from start to finish.')</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col-12 col-md-6 d-flex">
                    <div class="card text-end shadow p-4 w-100 d-flex flex-column justify-content-center tryout h-100">
                        <div class="d-flex flex-column flex-md-row align-items-center
            text-center h-100">

                        <div class="d-flex flex-column align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="71" height="70" viewBox="0 0 71 70" fill="none">
                                    <path d="M64.4661 20.8921C64.3766 21.6089 64.287 22.4152 64.1974 23.1319C63.839 25.282 64.3766 27.0738 65.8996 28.5968C67.333 29.9406 68.4976 31.4636 68.9456 33.4346C69.5727 36.3014 68.9456 38.8995 67.0642 41.1392C66.7059 41.5871 66.3475 41.9455 65.8996 42.3934C64.287 43.9165 63.7494 45.7978 64.1974 47.9479C64.6453 50.3668 64.3766 52.6961 63.0327 54.8463C61.4201 57.3548 59.0012 58.609 56.1344 58.9674C53.9843 59.2361 52.4613 60.4008 51.4758 62.3717C50.7591 63.8947 49.8632 65.2386 48.5194 66.224C45.9213 68.1054 43.0544 68.4638 40.0084 67.3887C39.7397 67.2991 39.4709 67.2095 39.2021 67.0303C36.7832 65.5073 34.3643 65.6865 31.8559 66.9408C27.2868 69.2701 22.449 67.6575 20.0301 63.0884C19.9406 62.9988 19.9406 62.9093 19.851 62.8197C18.7759 60.4008 16.8945 59.1465 14.2965 58.7882C10.0858 58.2506 7.21896 55.2942 6.77102 51.1731C6.68143 50.1877 6.77102 49.023 6.95019 48.0375C7.30855 45.7978 6.77102 43.8269 5.15842 42.3039C3.63541 40.8704 2.47076 39.1683 2.1124 36.9285C1.66446 33.8825 2.56035 31.2844 4.71048 29.1343C5.69595 28.0592 6.77102 27.0738 6.95019 25.5508C7.03978 24.4757 6.95019 23.311 6.86061 22.1464C6.23348 17.0398 9.36909 12.8292 14.4756 12.1125C16.2674 11.8437 17.88 11.3062 19.0447 9.78315C19.4926 9.15603 19.851 8.43932 20.2093 7.81219C21.0156 6.28919 22.0907 5.12453 23.5241 4.22865C26.0326 2.79523 28.6307 2.61605 31.3183 3.69111C31.8559 3.87029 32.3934 4.13906 32.9309 4.40782C34.7227 5.3933 36.6041 5.3933 38.3958 4.49741C39.9188 3.69111 41.5314 2.9744 43.3232 3.06399C46.5484 3.06399 49.1465 4.49741 50.8487 7.27466C51.207 7.81219 51.4758 8.43932 51.8341 9.06644C52.73 10.7686 54.253 11.7541 56.1344 12.1125C57.2095 12.2916 58.2845 12.5604 59.3596 12.9188C62.4056 14.173 64.4661 17.3982 64.4661 20.8921ZM61.3305 20.9817C61.241 20.6234 61.241 20.0858 61.1514 19.5483C60.4347 17.0398 58.7325 15.696 56.224 15.3376C52.6404 14.8897 50.0424 13.0083 48.5194 9.78315C48.3402 9.42479 48.161 9.15602 47.9818 8.79767C46.9963 7.27466 45.6525 6.46836 43.8607 6.28919C42.5169 6.11001 41.2627 6.55795 40.098 7.18507C38.3958 8.17055 36.5145 8.70808 34.5435 8.26014C33.1101 7.99137 31.7663 7.36425 30.512 6.82672C27.5556 5.48289 24.5096 6.46836 22.9866 9.3352C22.8074 9.78315 22.5386 10.1415 22.3595 10.5894C20.926 13.1875 18.8655 14.7105 15.9091 15.1585C15.2819 15.2481 14.6548 15.3376 14.0277 15.5168C11.0713 16.3231 9.45868 19.0108 10.0858 22.3256C10.7129 25.7299 9.81703 28.6864 7.30855 31.0157C7.03978 31.2844 6.77102 31.5532 6.59184 31.822C4.71048 33.9721 4.71048 37.0181 6.59184 39.2578C7.03978 39.7058 7.48773 40.1537 7.84608 40.6017C9.72744 42.6622 10.5337 45.0811 10.1754 47.8584C9.99621 49.023 9.90662 50.2773 10.0858 51.4419C10.4442 53.8608 12.4151 55.4734 15.1924 55.8318C18.5967 56.2797 21.1052 57.9819 22.6282 61.1175C22.8074 61.4758 22.9866 61.9238 23.2553 62.2821C24.5096 64.1635 26.2118 65.149 28.4515 64.7906C29.5266 64.6114 30.6016 64.1635 31.5871 63.7156C33.2893 62.9093 34.9915 62.4613 36.7832 62.8197C38.0375 63.0884 39.2917 63.5364 40.4564 64.0739C43.7712 65.5969 46.7276 64.701 48.5194 61.4758C48.6985 61.1175 48.9673 60.6695 49.1465 60.3112C50.5799 57.8923 52.6404 56.3693 55.4177 55.9213C56.0448 55.8318 56.6719 55.7422 57.2991 55.563C60.2555 54.7567 61.8681 52.069 61.241 48.7542C60.6138 45.3499 61.5097 42.3934 64.0182 40.0641C64.287 39.7954 64.5557 39.5266 64.8245 39.2578C66.6163 37.1077 66.7059 34.1513 64.8245 32.0012C64.3766 31.5532 63.9286 31.1053 63.4807 30.5677C61.5993 28.5072 60.793 26.0883 61.1514 23.311C61.0618 22.5943 61.1514 21.8776 61.3305 20.9817Z" fill="#509F96" stroke="#509F96" stroke-width="0.583333" stroke-miterlimit="10" />
                                    <path d="M22.4483 46.7834C22.6275 46.5146 22.8962 46.0667 23.2546 45.6187C29.0779 39.7955 34.8115 33.9722 40.6348 28.2385C42.337 26.5363 44.1288 24.7446 45.831 23.0424C46.4581 22.5048 47.1748 22.4153 47.8019 22.7736C48.429 23.132 48.7874 23.9383 48.5186 24.5654C48.3394 24.9237 48.0707 25.2821 47.8019 25.6404C42.4266 31.0158 37.0513 36.3911 31.6759 41.7664C29.5258 43.9165 27.4653 45.9771 25.3151 48.1272C24.7776 48.6647 24.1505 48.8439 23.5234 48.5752C22.8067 48.2168 22.4483 47.7689 22.4483 46.7834Z" fill="#509F96" stroke="#509F96" stroke-width="0.583333" stroke-miterlimit="10" />
                                    <path d="M22.3597 24.5653C22.3597 20.8026 25.4057 17.8462 29.1684 17.8462C32.8416 17.8462 35.8876 20.8922 35.8876 24.5653C35.8876 28.2385 32.8416 31.2845 29.1684 31.2845C25.3161 31.3741 22.3597 28.3281 22.3597 24.5653ZM32.5728 24.6549C32.5728 22.684 31.0498 21.0714 29.0788 21.0714C27.1079 21.0714 25.4953 22.684 25.4953 24.6549C25.4953 26.6259 27.1079 28.2385 29.0788 28.2385C31.0498 28.1489 32.5728 26.6259 32.5728 24.6549Z" fill="#509F96" stroke="#509F96" stroke-width="0.583333" stroke-miterlimit="10" />
                                    <path d="M48.6981 46.5146C48.6981 50.2773 45.6521 53.2337 41.979 53.2337C38.3058 53.2337 35.2598 50.1877 35.2598 46.5146C35.2598 42.8414 38.3058 39.7954 41.979 39.7058C45.6521 39.7954 48.6981 42.7518 48.6981 46.5146ZM38.3954 46.425C38.3954 48.3959 39.9184 50.0085 41.979 50.0085C43.9499 50.0085 45.4729 48.3959 45.5625 46.5146C45.5625 44.5436 43.9499 42.931 41.979 42.931C40.008 42.931 38.3954 44.454 38.3954 46.425Z" fill="#509F96" stroke="#509F96" stroke-width="0.583333" stroke-miterlimit="10" />
                                </svg>
                                <h5 class="why-us-icon">@lang('homepage.Competitive Pricing')</h5>
                            </div>
                            <div class="ms-0 ms-md-3 mt-3 mt-md-0">
                                <p class="why-us-text">@lang('homepage.We offer market-competitive prices without compromising on quality.')</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="col-12 col-md-6 d-flex">
                    <div class="card text-end shadow p-4 w-100 d-flex flex-column justify-content-center tryout h-100">
                        <div class="d-flex flex-column flex-md-row align-items-center
            text-center h-100">

                        <div class="d-flex flex-column align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="71" height="70" viewBox="0 0 71 70" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M32.3475 16.2203C32.3475 21.8649 27.7717 26.4407 22.1271 26.4407C16.4826 26.4407 11.9068 21.8649 11.9068 16.2203C11.9068 10.5758 16.4826 6 22.1271 6C27.7717 6 32.3475 10.5758 32.3475 16.2203ZM26.9111 28.5486C31.8479 26.6315 35.3475 21.8346 35.3475 16.2203C35.3475 8.91895 29.4285 3 22.1271 3C14.8257 3 8.90678 8.91895 8.90678 16.2203C8.90678 21.8346 12.4064 26.6315 17.3431 28.5486C14.0636 29.3959 11.0382 31.1069 8.6022 33.5429C5.01517 37.1299 3 41.995 3 47.0678H6C6 42.7906 7.6991 38.6886 10.7235 35.6642C13.7479 32.6398 17.8499 30.9407 22.1271 30.9407C26.4043 30.9407 30.5063 32.6398 33.5307 35.6642C34.1549 36.2884 34.7225 36.9583 35.2304 37.6662L35.3542 37.5774C35.5256 43.0079 38.9721 47.6122 43.7838 49.4807C40.5042 50.328 37.4789 52.0391 35.0429 54.475C31.4559 58.0621 29.4407 62.9271 29.4407 67.9999H32.4407C32.4407 63.7228 34.1398 59.6208 37.1642 56.5964C40.1886 53.5719 44.2906 51.8728 48.5678 51.8728C52.845 51.8728 56.947 53.5719 59.9714 56.5964C62.9958 59.6208 64.6949 63.7228 64.6949 68H67.6949C67.6949 62.9271 65.6797 58.0621 62.0927 54.475C59.6567 52.0391 56.6314 50.328 53.3518 49.4807C58.2885 47.5636 61.7881 42.7668 61.7881 37.1525C61.7881 29.8511 55.8692 23.9322 48.5678 23.9322C42.4622 23.9322 37.3233 28.0711 35.8038 33.6964C35.7535 33.6449 35.7029 33.5938 35.652 33.5429C33.2161 31.1069 30.1907 29.3959 26.9111 28.5486ZM58.7881 37.1525C58.7881 42.797 54.2123 47.3728 48.5678 47.3728C42.9233 47.3728 38.3475 42.797 38.3475 37.1525C38.3475 31.508 42.9233 26.9322 48.5678 26.9322C54.2123 26.9322 58.7881 31.508 58.7881 37.1525ZM39.7543 7.66113C38.9258 7.66113 38.2543 8.33271 38.2543 9.16113C38.2543 9.98956 38.9258 10.6611 39.7543 10.6611H52.0255V20.7289C52.0255 21.5574 52.697 22.2289 53.5255 22.2289C54.3539 22.2289 55.0255 21.5574 55.0255 20.7289V9.16113C55.0255 8.33271 54.3539 7.66113 53.5255 7.66113H39.7543Z" fill="#509F96" />
                                </svg>
                                <h5 class="why-us-icon">@lang('homepage.Easy Communication')</h5>
                            </div>
                            <div class="ms-0 ms-md-3 mt-3 mt-md-0">
                                <p class="why-us-text">@lang('homepage.We are with you every step of the way—from design to installation—and provide follow-up even after completion.')</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="col-12 col-md-6 d-flex">
                    <div class="card text-end shadow p-4 w-100 d-flex flex-column justify-content-center tryout h-100">
                        <div class="d-flex flex-column flex-md-row align-items-center
            text-center h-100">

                        <div class="d-flex flex-column align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="71" height="70" viewBox="0 0 71 70" fill="none">
                                    <g clip-path="url(#clip0_2277_2473)">
                                        <path d="M56 42.2089C54.0789 42.2085 52.2167 42.8765 50.7285 44.0998C49.2403 45.3231 48.2176 47.0266 47.8333 48.922H24.3333V15.3565H61C62.7681 15.3565 64.4638 16.0638 65.714 17.3228C66.9643 18.5817 67.6667 20.2892 67.6667 22.0696V48.922H64.1667C63.7824 47.0266 62.7597 45.3231 61.2715 44.0998C59.7833 42.8765 57.9211 42.2085 56 42.2089ZM56 58.9916C57.9211 58.992 59.7833 58.324 61.2715 57.1007C62.7597 55.8774 63.7824 54.1739 64.1667 52.2785H71V22.0696C71 19.399 69.9464 16.8377 68.0711 14.9493C66.1957 13.0609 63.6522 12 61 12H24.3333C23.4493 12 22.6014 12.3536 21.9763 12.9831C21.3512 13.6126 21 14.4663 21 15.3565V22.0696H11L1 35.4958V52.2785H7.83333C8.21586 54.1754 9.23788 55.8809 10.7262 57.1058C12.2146 58.3308 14.0777 59 16 59C17.9223 59 19.7854 58.3308 21.2738 57.1058C22.7621 55.8809 23.7841 54.1754 24.1667 52.2785H47.8333C48.2176 54.1739 49.2403 55.8774 50.7285 57.1007C52.2167 58.324 54.0789 58.992 56 58.9916ZM56 45.5654C57.3261 45.5654 58.5979 46.0959 59.5355 47.0401C60.4732 47.9843 61 49.2649 61 50.6002C61 51.9355 60.4732 53.2162 59.5355 54.1604C58.5979 55.1046 57.3261 55.635 56 55.635C54.6739 55.635 53.4021 55.1046 52.4645 54.1604C51.5268 53.2162 51 51.9355 51 50.6002C51 49.2649 51.5268 47.9843 52.4645 47.0401C53.4021 46.0959 54.6739 45.5654 56 45.5654ZM16 42.2089C14.0789 42.2085 12.2167 42.8765 10.7285 44.0998C9.2403 45.3231 8.21755 47.0266 7.83333 48.922H4.33334V36.5699L5.13333 35.4958H21V43.8871C19.6 42.8466 17.8667 42.2089 16 42.2089ZM16 45.5654C17.3261 45.5654 18.5979 46.0959 19.5355 47.0401C20.4732 47.9843 21 49.2649 21 50.6002C21 51.9355 20.4732 53.2162 19.5355 54.1604C18.5979 55.1046 17.3261 55.635 16 55.635C14.6739 55.635 13.4022 55.1046 12.4645 54.1604C11.5268 53.2162 11 51.9355 11 50.6002C11 49.2649 11.5268 47.9843 12.4645 47.0401C13.4022 46.0959 14.6739 45.5654 16 45.5654ZM21 25.4262V32.1393H7.66667L12.6667 25.4262H21Z" fill="#509F96" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2277_2473">
                                            <rect width="70" height="70" fill="white" transform="matrix(-1 0 0 1 70.5 0)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <h5 class="why-us-icon">@lang('homepage.Convenient Delivery')</h5>
                            </div>
                            <div class="ms-0 ms-md-3 mt-3 mt-md-0">
                                <p class="why-us-text">@lang('homepage.We ensure safe and hassle-free delivery of all items.')</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 7 -->
                <div class="col-12 col-md-6 d-flex">
                    <div class="card text-end shadow p-4 w-100 d-flex flex-column justify-content-center tryout h-100">
                        <div class="d-flex flex-column flex-md-row align-items-center
            text-center h-100">

                        <div class="d-flex flex-column align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="71" height="70" viewBox="0 0 71 70" fill="none">
                                    <path d="M51.75 10.2222V3M19.25 10.2222V3M3.90278 21.0556H67.0972M3 28.4367C3 20.7992 3 16.9786 4.57444 14.0608C5.99811 11.4583 8.2072 9.37182 10.8867 8.09889C13.9778 6.61111 18.0222 6.61111 26.1111 6.61111H44.8889C52.9778 6.61111 57.0222 6.61111 60.1133 8.09889C62.8325 9.40611 65.0389 11.4933 66.4256 14.0572C68 16.9822 68 20.8028 68 28.4403V46.1781C68 53.8156 68 57.6361 66.4256 60.5539C65.0019 63.1564 62.7928 65.2429 60.1133 66.5158C57.0222 68 52.9778 68 44.8889 68H26.1111C18.0222 68 13.9778 68 10.8867 66.5122C8.20774 65.2402 5.99871 63.1551 4.57444 60.5539C3 57.6289 3 53.8083 3 46.1708V28.4367Z" stroke="#509F96" stroke-width="3.2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M46.6161 34.4158L33.1084 51.0458L25 45.5024" stroke="#509F96" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <h5 class="why-us-icon">@lang('homepage.On-Time Commitment')</h5>
                            </div>
                            <div class="ms-0 ms-md-3 mt-3 mt-md-0">
                                <p class="why-us-text">@lang('homepage.We stick to agreed timelines for delivery and installation to ensure a smooth, stress-free experience.')</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 8 -->
                <div class="col-12 col-md-6 d-flex">
                    <div class="card text-end shadow p-4 w-100 d-flex flex-column justify-content-center tryout h-100">
                        <div class="d-flex flex-column flex-md-row align-items-center
            text-center h-100">

                        <div class="d-flex flex-column align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="71" height="70" viewBox="0 0 71 70" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M48.6151 62.7387L46.4484 63.5546C45.5294 63.982 44.6045 64.5124 43.6347 65.0698L43.5945 65.0928C41.1026 66.5217 38.5245 68 35.5 68C32.4694 68 29.887 66.5157 27.3963 65.0842L27.3713 65.0698C26.4015 64.5124 25.4766 63.982 24.5576 63.5546L22.3909 62.7298C21.7145 62.5125 21.0002 62.3149 20.2684 62.1125L20.1989 62.0932L20.1975 62.0928C17.4336 61.3279 14.5771 60.5374 12.5184 58.4786C11.2229 57.1831 10.4264 55.5708 9.82873 53.8644L8.99942 51.1418L8.90529 50.8026C8.53322 49.4563 8.18207 48.1862 7.69644 47.0162C7.2388 45.9116 6.60568 44.81 5.93505 43.6431L5.93023 43.6347L5.90715 43.5945C4.47829 41.1026 3 38.5245 3 35.5C3 32.4651 4.48397 29.8797 5.91884 27.3799L5.92724 27.3653L5.93211 27.3568C6.60272 26.19 7.23582 25.0884 7.69345 23.9838C8.17833 22.8156 8.52915 21.5476 8.90058 20.2051L8.9023 20.1989L8.91034 20.1699C9.67587 17.4145 10.4665 14.5688 12.5199 12.5184C14.5805 10.4608 17.4345 9.67034 20.1974 8.90529C21.5437 8.53322 22.8138 8.18207 23.9838 7.69644C25.0884 7.2388 26.19 6.6057 27.3568 5.93508L27.3653 5.93023L27.4055 5.90715C29.8974 4.47829 32.4755 3 35.5 3C38.5245 3 41.1026 4.47829 43.5945 5.90715L43.6347 5.93023L43.6431 5.93505C44.81 6.60568 45.9116 7.2388 47.0162 7.69644C48.1844 8.18133 49.4524 8.53215 50.795 8.90358L50.8011 8.90529C53.5655 9.67034 56.424 10.4623 58.4816 12.5199C60.5383 14.5766 61.3289 17.4319 62.0937 20.1937L62.0947 20.1974C62.4668 21.5437 62.8179 22.8138 63.3036 23.9838C63.7612 25.0884 64.3943 26.19 65.065 27.3569L65.0698 27.3653L65.0928 27.4055C66.5217 29.8974 68 32.4755 68 35.5C68 38.5402 66.5108 41.1294 65.0706 43.6333L65.0698 43.6347L65.065 43.643C64.3943 44.8099 63.7612 45.9116 63.3036 47.0162C62.8187 48.1844 62.4679 49.4524 62.0964 50.795L62.0947 50.8012L62.0006 51.1418L61.1757 53.8733C60.578 55.5798 59.7831 57.1921 58.4861 58.4891C56.4294 60.5457 53.5741 61.3364 50.8124 62.1011L50.8086 62.1022C50.051 62.3114 49.3188 62.5146 48.6151 62.7387ZM42.517 63.1317L42.507 63.1375C40.1587 64.4847 37.9381 65.7586 35.5 65.7586C33.0601 65.7586 30.8381 64.4829 28.482 63.1301L28.477 63.1272L28.4754 63.1263C27.2954 62.4482 26.0767 61.7478 24.837 61.2325C23.5385 60.6946 22.1474 60.3076 20.7906 59.934L20.7889 59.9336C18.191 59.215 15.7381 58.5365 14.0978 56.8962C12.4575 55.2559 11.779 52.803 11.0605 50.2051L11.06 50.2034L11.0432 50.143C10.6748 48.8166 10.2914 47.4361 9.76149 46.157C9.2462 44.9173 8.54577 43.6985 7.86765 42.5185L7.86678 42.517C6.51299 40.1651 5.2354 37.9416 5.2354 35.494C5.2354 33.0541 6.50498 30.8429 7.85403 28.4932L7.86678 28.471L7.86767 28.4695C8.54579 27.2895 9.2462 26.0707 9.76149 24.831C10.2994 23.5325 10.6864 22.1414 11.06 20.7846L11.0605 20.7829C11.779 18.185 12.4575 15.7322 14.0978 14.0918C15.7235 12.4661 18.1533 11.7969 20.7255 11.0885L20.7966 11.069L20.857 11.0522C22.1834 10.6838 23.5639 10.3003 24.843 9.77046C26.0827 9.25517 27.3014 8.55476 28.4814 7.87665L28.483 7.87575C30.8349 6.51897 33.0584 5.24138 35.5 5.24138C37.9399 5.24138 40.1619 6.51714 42.5179 7.86986L42.523 7.87276L42.5246 7.87366C43.7045 8.55177 44.9233 9.25218 46.163 9.76747C47.4615 10.3054 48.8526 10.6924 50.2094 11.066L50.2111 11.0664C52.809 11.785 55.2618 12.4635 56.9022 14.1038C58.5425 15.7441 59.221 18.197 59.9395 20.7949L59.94 20.7966L59.9568 20.8571C60.3252 22.1834 60.7086 23.5639 61.2385 24.843C61.7538 26.0827 62.4542 27.3015 63.1323 28.4814L63.1332 28.483C64.487 30.8349 65.7646 33.0584 65.7646 35.506C65.7646 37.9459 64.495 40.1571 63.146 42.5068L63.1332 42.529L63.1323 42.5305C62.4542 43.7105 61.7538 44.9293 61.2385 46.169C60.7006 47.4675 60.3136 48.8586 59.94 50.2154L59.9395 50.2171C59.221 52.815 58.5425 55.2678 56.9022 56.9082C55.2764 58.5339 52.8467 59.2031 50.2744 59.9115L50.2034 59.931L50.143 59.9478C48.8166 60.3162 47.4361 60.6997 46.157 61.2295C44.9138 61.748 43.6975 62.4489 42.523 63.1272L42.517 63.1317Z" fill="#509F96" />
                                    <path d="M65.0698 43.6347L65.065 43.643M65.0698 43.6347L65.0706 43.6333C66.5108 41.1294 68 38.5402 68 35.5C68 32.4755 66.5217 29.8974 65.0928 27.4055M65.0698 43.6347C65.0682 43.6375 65.0666 43.6402 65.065 43.643M65.0698 27.3653L65.0928 27.4055M65.0698 27.3653L65.065 27.3569M65.0698 27.3653C65.0682 27.3625 65.0666 27.3597 65.065 27.3569M65.0698 27.3653C65.0775 27.3787 65.0851 27.3921 65.0928 27.4055M43.6347 5.93023L43.6431 5.93505M43.6347 5.93023L43.5945 5.90715M43.6347 5.93023C43.6213 5.92254 43.6079 5.91485 43.5945 5.90715M43.6347 5.93023C43.6375 5.93184 43.6403 5.93344 43.6431 5.93505M27.3653 5.93023L27.4055 5.90715M27.3653 5.93023L27.3568 5.93508M27.3653 5.93023C27.3625 5.93185 27.3597 5.93346 27.3568 5.93508M27.3653 5.93023C27.3787 5.92254 27.3921 5.91485 27.4055 5.90715M8.9023 20.1989L8.91034 20.1699M8.9023 20.1989L8.90058 20.2051C8.52915 21.5476 8.17833 22.8156 7.69345 23.9838C7.23582 25.0884 6.60272 26.19 5.93211 27.3568M8.9023 20.1989C8.90498 20.1892 8.90766 20.1795 8.91034 20.1699M5.92724 27.3653L5.93211 27.3568M5.92724 27.3653L5.91884 27.3799M5.92724 27.3653C5.92444 27.3702 5.92164 27.375 5.91884 27.3799M5.92724 27.3653C5.92886 27.3625 5.93049 27.3596 5.93211 27.3568M5.93023 43.6347L5.90715 43.5945M5.93023 43.6347L5.93505 43.6431M5.93023 43.6347C5.93184 43.6375 5.93344 43.6403 5.93505 43.6431M5.93023 43.6347C5.92254 43.6213 5.91485 43.6079 5.90715 43.5945M27.3713 65.0698C26.4015 64.5124 25.4766 63.982 24.5576 63.5546L22.3909 62.7298C21.7145 62.5125 21.0002 62.3149 20.2684 62.1125M27.3713 65.0698L27.3963 65.0842M27.3713 65.0698C27.3796 65.0746 27.388 65.0794 27.3963 65.0842M43.6347 65.0698C44.6045 64.5124 45.5294 63.982 46.4484 63.5546L48.6151 62.7387C49.3188 62.5146 50.051 62.3114 50.8086 62.1022L50.8124 62.1011C53.5741 61.3364 56.4294 60.5457 58.4861 58.4891C59.7831 57.1921 60.578 55.5798 61.1757 53.8733L62.0006 51.1418L62.0947 50.8011L62.0964 50.795C62.4679 49.4524 62.8187 48.1844 63.3036 47.0162C63.7612 45.9116 64.3943 44.8099 65.065 43.643M43.6347 65.0698L43.5945 65.0928M43.6347 65.0698C43.6213 65.0775 43.6079 65.0851 43.5945 65.0928M20.1989 62.0932L20.2684 62.1125M20.1989 62.0932L20.1975 62.0928C17.4336 61.3279 14.5771 60.5374 12.5184 58.4786C11.2229 57.1831 10.4264 55.5708 9.82873 53.8644L8.99942 51.1418L8.90529 50.8026C8.53322 49.4563 8.18207 48.1862 7.69644 47.0162C7.2388 45.9116 6.60568 44.81 5.93505 43.6431M20.1989 62.0932C20.222 62.0996 20.2452 62.106 20.2684 62.1125M42.517 63.1317L42.523 63.1272C43.6975 62.4489 44.9138 61.748 46.157 61.2295C47.4361 60.6997 48.8166 60.3162 50.143 59.9478M42.517 63.1317L42.507 63.1375M42.517 63.1317C42.5137 63.1336 42.5103 63.1356 42.507 63.1375M11.06 50.2034L11.0432 50.143M11.06 50.2034L11.0605 50.2051C11.779 52.803 12.4575 55.2559 14.0978 56.8962C15.7381 58.5365 18.191 59.215 20.7889 59.9335L20.7906 59.934C22.1474 60.3076 23.5385 60.6946 24.837 61.2325C26.0767 61.7478 27.2954 62.4482 28.4754 63.1263L28.477 63.1272L28.482 63.1301C30.8381 64.4829 33.0601 65.7586 35.5 65.7586C37.9381 65.7586 40.1587 64.4847 42.507 63.1375M11.06 50.2034C11.0544 50.1833 11.0488 50.1631 11.0432 50.143M7.86678 28.471L7.86767 28.4695C8.54579 27.2895 9.2462 26.0707 9.76149 24.831C10.2994 23.5325 10.6864 22.1414 11.06 20.7846L11.0605 20.7829C11.779 18.185 12.4575 15.7322 14.0978 14.0918C15.7235 12.4661 18.1533 11.7969 20.7255 11.0885M7.86678 28.471L7.85403 28.4932M7.86678 28.471C7.86253 28.4784 7.85828 28.4858 7.85403 28.4932M20.7966 11.069L20.857 11.0522M20.7966 11.069L20.7255 11.0885M20.7966 11.069C20.7729 11.0755 20.7492 11.082 20.7255 11.0885M20.7966 11.069C20.8167 11.0634 20.8369 11.0578 20.857 11.0522M59.94 20.7966L59.9568 20.8571M59.94 20.7966L59.9395 20.7949C59.221 18.197 58.5425 15.7441 56.9022 14.1038C55.2618 12.4635 52.809 11.785 50.2111 11.0664L50.2094 11.066C48.8526 10.6924 47.4615 10.3054 46.163 9.76747C44.9233 9.25218 43.7045 8.55177 42.5246 7.87366L42.523 7.87276L42.5179 7.86986C40.1619 6.51714 37.9399 5.24138 35.5 5.24138C33.0584 5.24138 30.8349 6.51897 28.483 7.87575L28.4814 7.87665C27.3014 8.55476 26.0827 9.25517 24.843 9.77046C23.5639 10.3003 22.1834 10.6838 20.857 11.0522M59.94 20.7966C59.9456 20.8167 59.9512 20.8369 59.9568 20.8571M63.1332 42.529L63.1323 42.5305C62.4542 43.7105 61.7538 44.9293 61.2385 46.169C60.7006 47.4675 60.3136 48.8586 59.94 50.2154L59.9395 50.2171C59.221 52.815 58.5425 55.2678 56.9022 56.9082C55.2764 58.5339 52.8467 59.2031 50.2744 59.9115M63.1332 42.529L63.146 42.5068M63.1332 42.529C63.1375 42.5216 63.1417 42.5142 63.146 42.5068M50.2034 59.931L50.143 59.9478M50.2034 59.931L50.2744 59.9115M50.2034 59.931C50.2271 59.9245 50.2508 59.918 50.2744 59.9115M50.2034 59.931C50.1833 59.9366 50.1631 59.9422 50.143 59.9478M65.065 27.3569C64.3943 26.19 63.7612 25.0884 63.3036 23.9838C62.8179 22.8138 62.4668 21.5437 62.0947 20.1974L62.0937 20.1937C61.3289 17.4319 60.5383 14.5766 58.4816 12.5199C56.424 10.4623 53.5655 9.67034 50.8011 8.90529L50.795 8.90358C49.4524 8.53215 48.1844 8.18133 47.0162 7.69644C45.9116 7.2388 44.81 6.60568 43.6431 5.93505M43.5945 5.90715C41.1026 4.47829 38.5245 3 35.5 3C32.4755 3 29.8974 4.47829 27.4055 5.90715M27.3568 5.93508C26.19 6.6057 25.0884 7.2388 23.9838 7.69644C22.8138 8.18207 21.5437 8.53322 20.1974 8.90529C17.4345 9.67034 14.5805 10.4608 12.5199 12.5184C10.4665 14.5688 9.67587 17.4145 8.91034 20.1699M5.91884 27.3799C4.48397 29.8797 3 32.4651 3 35.5C3 38.5245 4.47829 41.1026 5.90715 43.5945M27.3963 65.0842C29.887 66.5157 32.4694 68 35.5 68C38.5245 68 41.1026 66.5217 43.5945 65.0928M63.146 42.5068C64.495 40.1571 65.7646 37.9459 65.7646 35.506C65.7646 33.0584 64.487 30.8349 63.1332 28.483L63.1323 28.4814C62.4542 27.3015 61.7538 26.0827 61.2385 24.843C60.7086 23.5639 60.3252 22.1834 59.9568 20.8571M7.85403 28.4932C6.50498 30.8429 5.2354 33.0541 5.2354 35.494C5.2354 37.9416 6.51299 40.1651 7.86678 42.517L7.86765 42.5185C8.54577 43.6985 9.2462 44.9173 9.76149 46.157C10.2914 47.4361 10.6748 48.8166 11.0432 50.143" stroke="#509F96" stroke-width="0.5" />
                                    <path d="M60.5284 35.4999C60.5284 21.699 49.3005 10.4712 35.4996 10.4712C21.6987 10.4712 10.4709 21.699 10.4709 35.4999C10.4709 49.3008 21.6987 60.5287 35.4996 60.5287C49.3005 60.5287 60.5284 49.3008 60.5284 35.4999ZM35.4996 58.2873C22.9344 58.2873 12.7123 48.0651 12.7123 35.4999C12.7123 22.9348 22.9344 12.7126 35.4996 12.7126C48.0648 12.7126 58.287 22.9348 58.287 35.4999C58.287 48.0651 48.0648 58.2873 35.4996 58.2873Z" fill="#509F96" stroke="#509F96" stroke-width="0.5" />
                                    <path d="M50.1309 26.9513L41.5912 29.4198L36.4644 20.7352C36.3654 20.5673 36.2242 20.4281 36.055 20.3314C35.8857 20.2347 35.6941 20.1838 35.4991 20.1838C35.3042 20.1838 35.1126 20.2347 34.9433 20.3314C34.774 20.4281 34.6329 20.5673 34.5338 20.7352L29.4071 29.4198L20.8674 26.9513C20.6623 26.8909 20.4443 26.8903 20.2389 26.9496C20.0335 27.0089 19.8494 27.1256 19.7081 27.2861C19.5668 27.4465 19.4743 27.6439 19.4414 27.8552C19.4086 28.0664 19.4367 28.2826 19.5226 28.4784L24.1652 39.0876C24.4273 39.6879 24.8592 40.1985 25.4077 40.5566C25.9561 40.9147 26.5973 41.1048 27.2523 41.1033H43.7459C44.3995 41.1034 45.0389 40.913 45.5859 40.5552C46.1329 40.1974 46.5637 39.6879 46.8256 39.0891L51.4682 28.4799C51.5532 28.2848 51.581 28.0696 51.5483 27.8593C51.5156 27.6491 51.4238 27.4524 51.2836 27.2924C51.1435 27.1323 50.9607 27.0154 50.7565 26.9552C50.5524 26.8951 50.3354 26.8942 50.1309 26.9528V26.9513ZM44.7725 38.191C44.6852 38.3906 44.5416 38.5604 44.3593 38.6796C44.1769 38.7988 43.9637 38.8622 43.7459 38.862H27.2523C27.0345 38.8622 26.8213 38.7988 26.639 38.6796C26.4567 38.5604 26.313 38.3906 26.2258 38.191L22.541 29.7679L29.6192 31.8136C29.858 31.8823 30.1129 31.8699 30.3438 31.7782C30.5747 31.6865 30.7687 31.5208 30.8953 31.307L35.4991 23.5085L40.1029 31.307C40.2295 31.5208 40.4235 31.6865 40.6545 31.7782C40.8854 31.8699 41.1402 31.8823 41.379 31.8136L48.4573 29.7679L44.7725 38.191Z" fill="#509F96" stroke="#509F96" stroke-width="0.5" />
                                    <path d="M44.4652 42.9712H26.5341C25.6427 42.972 24.788 43.3265 24.1577 43.9568C23.5273 44.5871 23.1728 45.4418 23.1721 46.3333V47.4539C23.1728 48.3454 23.5273 49.2001 24.1577 49.8304C24.788 50.4608 25.6427 50.8152 26.5341 50.816H44.4652C45.3566 50.8152 46.2113 50.4608 46.8416 49.8304C47.472 49.2001 47.8264 48.3454 47.8272 47.4539V46.3333C47.8264 45.4418 47.472 44.5871 46.8416 43.9568C46.2113 43.3265 45.3566 42.972 44.4652 42.9712ZM45.5858 47.4539C45.5858 47.7512 45.4678 48.0362 45.2576 48.2464C45.0474 48.4566 44.7624 48.5746 44.4652 48.5746H26.5341C26.2369 48.5746 25.9519 48.4566 25.7417 48.2464C25.5315 48.0362 25.4134 47.7512 25.4134 47.4539V46.3333C25.4134 46.036 25.5315 45.751 25.7417 45.5408C25.9519 45.3306 26.2369 45.2126 26.5341 45.2126H44.4652C44.7624 45.2126 45.0474 45.3306 45.2576 45.5408C45.4678 45.751 45.5858 46.036 45.5858 46.3333V47.4539Z" fill="#509F96" stroke="#509F96" stroke-width="0.5" />
                                </svg>
                                <h5 class="why-us-icon">@lang('homepage.Warranty')</h5>
                            </div>
                            <div class="ms-0 ms-md-3 mt-3 mt-md-0">
                                <p class="why-us-text">@lang('homepage.We offer a 15-year warranty on our products, reflecting our confidence in the quality of our designs. This warranty covers all manufacturing or material-related defects.')</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Showcase Section -->
    <section class="homepage-section showcase-section">
        <div class="container-fluid p-5">
        <div class="container text-center">
            <h2 class="fw-bold" style="color: rgba(10, 71, 64, 1) !important;">
                @lang('homepage.We guarantee safe, hassle-free delivery — every step of the way.')
            </h2>
            <p class="mt-3" style="font-size: 20px;">
                @lang('homepage.Thinking about a new kitchen? We’re here to help.')<br>
                @lang('homepage.At Oppolia Online, bringing your dream kitchen to life has never been easier. Your request is our mission!')
            </p>

            <!-- Showcase Grid with Equal Sizing -->
            <div class="row g-4 mt-4 justify-content-center align-items-stretch">

                <div class="col-12 col-sm-6 col-md-3 d-flex">
                    <a href="{{ route('category.products', 26) }}" class="d-flex flex-column w-100">
                        <div class="showcase-image-container tryout flex-grow-1 d-flex align-items-center">
                            <img src="{{ asset('Frontend/assets/images/gallery/NewClassic.webp') }}"
                                 class="img-fluid rounded shadow w-100 h-100"
                                 style="object-fit: cover;"
                                 alt="مطابخ نيو كلاسيك">
                        </div>
                        <h5 class="mt-3 fw-bold" style="color: rgba(36, 77, 77, 1) !important;">
                            @lang('homepage.New Classic Kitchens')
                        </h5>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3 d-flex">
                    <a href="{{ route('category.products', 27) }}" class="d-flex flex-column w-100">
                        <div class="showcase-image-container tryout flex-grow-1 d-flex align-items-center">
                            <img src="{{ asset('Frontend/assets/images/gallery/Modern.webp') }}"
                                 class="img-fluid rounded shadow w-100 h-100"
                                 style="object-fit: cover;"
                                 alt="مطابخ حديثة">
                        </div>
                        <h5 class="mt-3 fw-bold" style="color: rgba(36, 77, 77, 1) !important;">
                            @lang('homepage.Modern Kitchens')
                        </h5>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3 d-flex">
                    <a href="{{ route('category.products', 29) }}" class="d-flex flex-column w-100">
                        <div class="showcase-image-container tryout flex-grow-1 d-flex align-items-center">
                            <img src="{{ asset('Frontend/assets/images/gallery/L-Shaped.webp') }}"
                                 class="img-fluid rounded shadow w-100 h-100"
                                 style="object-fit: cover;"
                                 alt="مطابخ على شكل حرف L">
                        </div>
                        <h5 class="mt-3 fw-bold" style="color: rgba(36, 77, 77, 1) !important;">
                            @lang('homepage.L-Shaped Kitchens')
                        </h5>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-md-3 d-flex">
                    <a href="{{ route('category.products', 30) }}" class="d-flex flex-column w-100">
                        <div class="showcase-image-container tryout flex-grow-1 d-flex align-items-center">
                            <img src="{{ asset('Frontend/assets/images/gallery/U-Shaped.webp') }}"
                                 class="img-fluid rounded shadow w-100 h-100"
                                 style="object-fit: cover;"
                                 alt="مطابخ على شكل حرف U">
                        </div>
                        <h5 class="mt-3 fw-bold" style="color: rgba(36, 77, 77, 1) !important;">
                        @lang('homepage.U-Shaped Kitchens')
                        </h5>
                    </a>
                </div>

            </div>
        </div>
        </div>
    </section>

    <!-- German Quality Slider -->
    <section class="homepage-section german-quality-section">
        <div class="container p-5">
        <div class="row align-items-center justify-content-center">
            <!-- Image Slider -->

            <!-- ✅ Text Section -->
            <div class="col-md-5 ">
                <h3 class="section-title">@lang('homepage.German Quality')</h3>
                <p class="text-section">
                @lang('homepage.At Oppolia, we take pride in offering designs that reflect renowned German quality—precision and durability at its finest. We use high-grade materials and advanced techniques to ensure long-lasting home furniture that blends beauty with functionality. With us, you are choosing the best for your home, where German quality is the foundation of every design.')
                </p>
                <p class="text-section">
                   @lang('homepage.With us, make sure you choose the best for your home, where German quality is the foundation of every design.')
                </p>
            </div>

            <div class="col-md-6 position-relative">
                <div id="germanQualitySlider" class="carousel slide" data-bs-ride="carousel">

                    <!-- ✅ Indicators (Positioned Correctly) -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#germanQualitySlider" data-bs-slide-to="0"
                                class="active"></button>
                        <button type="button" data-bs-target="#germanQualitySlider" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#germanQualitySlider" data-bs-slide-to="2"></button>
                        <button type="button" data-bs-target="#germanQualitySlider" data-bs-slide-to="3"></button>

                    </div>

                    <!-- ✅ Carousel Images -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('Frontend/assets/images/gallery/01.png') }}" class="d-block w-100 rounded-4"
                                 alt="German Quality Kitchen">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('Frontend/assets/images/gallery/02.png') }}" class="d-block w-100 rounded-4"
                                 alt="Luxury Kitchen">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('Frontend/assets/images/gallery/03.png') }}" class="d-block w-100 rounded-4"
                                 alt="Modern Kitchen">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('Frontend/assets/images/gallery/04.png') }}" class="d-block w-100 rounded-4"
                                 alt="Modern Kitchen">
                        </div>
                    </div>

                    <!-- ✅ Navigation Controls -->
                    <div class="carousel-controls">
                        <!-- Previous Button -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#germanQualitySlider"
                                data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>

                        <!-- Next Button -->
                        <button class="carousel-control-next" type="button" data-bs-target="#germanQualitySlider"
                                data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>

    <!-- Designers Section -->
    <section class="homepage-section designers-section">
        <div class="container text-center p-5">
        <h2 class="section-title">@lang('homepage.Oppolia Online Designers!')</h2>
        <p class="mt-3 designers-text">
            @lang('homepage.At Oppolia Online, we have a professional team of specialized designers who combine creativity with competence.')
            <br> @lang('homepage.Our designers work to understand your needs and provide you with the perfect home, turning your ideas into reality.')
        </p>
        <a href="/joinasdesigner">
            <p class="be-a-designer">@lang('homepage.Join Now!')</p>
        </a>
        <div class="row row-cols-1 row-cols-md-3 g-4 m-3">
            @forelse($designer as $designer)
                @php
                    $avgRating = $designer->ratings->avg('rating'); // نأخذ المعدل بدقة
                    $ratingCount = $designer->ratings->count();
                @endphp
                <div class="col d-flex align-items-stretch">
                    <div class="card p-4 text-center h-100 d-flex flex-column w-100 shadow-sm" data-bs-toggle="modal" data-bs-target="#designerModal{{ $designer->id }}" style="cursor: pointer;">
                        <img src="{{ asset($designer->profile_image ? 'storage/' . $designer->profile_image : 'storage/profile_images/ProfilePlaceholder.jpg') }}"
                             class="card-img-top img-fluid rounded-4 mb-3"
                             alt="Designer Image" style="object-fit: cover; height: 277px;">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-2">
                                @if(App::getLocale() == 'ar')
                                    {{ $designer->user->name ?? 'مصمم' }}
                                @else
                                    {{ $designer->user->name_en ?? 'Designer' }}
                                @endif
                            </h5>

                            <!-- عرض التقييم داخل الكارد -->
                            <div class="mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($avgRating))
                                        <i class="fas fa-star text-warning"></i>
                                    @elseif($i - $avgRating < 1)
                                        <i class="fas fa-star-half-alt text-warning"></i> <!-- نصف نجمة -->
                                    @else
                                        <i class="far fa-star text-muted"></i>
                                    @endif
                                @endfor
                                    @if(App::getLocale() == 'ar')
                                <small class="text-muted d-block">
                                    {{ number_format($avgRating, 1) }} من 5 ({{ $ratingCount }} تقييم{{ $ratingCount == 1 ? '' : 'ات' }})
                                </small>
                                    @else
                                        <small class="text-muted d-block">
                                            {{ number_format($avgRating, 1) }} out of 5 ({{ $ratingCount }} rating{{ $ratingCount == 1 ? '' : 's' }})
                                        </small>
                                     @endif
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Modal لكل مصمم -->

                <div class="modal fade" id="designerModal{{ $designer->id }}" tabindex="-1" aria-labelledby="designerModalLabel{{ $designer->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">

                        <div class="modal-content rounded-4 p-4">


                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>

                            <div class="modal-body d-flex flex-column flex-md-row align-items-center">


                                <!-- صورة المصمم -->
                                <div class="col-md-4 text-center mb-4 mb-md-0">
                                    <img src="{{ asset($designer->profile_image ? 'storage/' . $designer->profile_image : 'storage/profile_images/ProfilePlaceholder.jpg') }}"
                                         class="img-fluid "
                                         alt="Designer Image" style="width: 150px; height: 150px; object-fit: cover;   border-radius: 10px;">
                                </div>

                                <!-- معلومات المصمم -->
                                <div class="col-md-8 {{ App::getLocale() == 'ar' ? 'text-end' : 'text-start' }}" style="direction: {{ App::getLocale() == 'ar' ? 'rtl' : 'ltr' }}; text-align: {{ App::getLocale() == 'ar' ? 'right' : 'left' }}; ">
                                    <h4>
                                        @if(App::getLocale() == 'ar')
                                            {{ $designer->user->name ?? 'مصمم' }}
                                        @else
                                            {{ $designer->user->name_en ?? 'Designer' }}
                                        @endif
                                    </h4>
                                    <p class="text-muted mb-1">
                                        @if(App::getLocale() == 'ar')
                                            الخبرة: {{ $designer->experience_years }} سنوات
                                        @else
                                            {{ $designer->experience_years }} years of experience
                                        @endif
                                    </p>

                                    <!-- نجوم التقييم -->
                                    <div class="mb-3">
                                        @php
                                            $avgRating = $designer->ratings->avg('rating') ?? 0;
                                            $ratingCount = $designer->ratings->count() ?? 0;
                                        @endphp

                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= floor($avgRating))
                                                <i class="fas fa-star text-warning"></i>
                                            @elseif($i - $avgRating < 1)
                                                <i class="fas fa-star-half-alt text-warning"></i>
                                            @else
                                                <i class="far fa-star text-muted"></i>
                                            @endif
                                        @endfor
                                        <small class="text-muted">
                                            @if(App::getLocale() == 'ar')
                                                ({{ number_format($avgRating, 1) }} / {{ $ratingCount }} تقييمات)
                                            @else
                                                ({{ number_format($avgRating, 1) }} / {{ $ratingCount }} ratings)
                                            @endif
                                        </small>
                                    </div>

                                    <!-- الوصف Description -->
                                    <p class="{{ App::getLocale() == 'ar' ? 'text-right' : 'text-left' }}">
                                        @if(App::getLocale() == 'ar')
                                            {{ $designer->description_ar ?? 'لا يوجد وصف متوفر' }}
                                        @else
                                            {{ $designer->description ?? 'No description available' }}
                                        @endif
                                    </p>
                                </div>

                            </div>

                            <!-- سلايدر صور البورتفوليو -->
                            @if ($designer->portfolio_images)
                                @php
                                    $portfolioImages = json_decode($designer->portfolio_images);
                                @endphp

                                @if(count($portfolioImages) > 0)
                                    <div id="portfolioCarousel{{ $designer->id }}" class="carousel slide mt-4" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach($portfolioImages as $key => $image)
                                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('storage/' . $image) }}" class="d-block w-100 rounded-4" alt="Portfolio Image" style="height: 300px; object-fit: cover;">
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#portfolioCarousel{{ $designer->id }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#portfolioCarousel{{ $designer->id }}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                @else
                                    <p class="text-center text-muted py-3">
                                        @if(App::getLocale() == 'ar')
                                            لا توجد صور بورتفوليو متاحة
                                        @else
                                            No portfolio images available
                                        @endif
                                    </p>
                                @endif
                            @else
                                <p class="text-center text-muted py-3">
                                    @if(App::getLocale() == 'ar')
                                        لا توجد صور بورتفوليو متاحة
                                    @else
                                        No portfolio images available
                                    @endif
                                </p>
                            @endif




                        </div>
                    </div>
                </div>

            @empty
                <div class="col-12 text-center">
                    <p>لا يوجد مصممين متاحين حالياً.</p>
                </div>
            @endforelse
        </div>


        @php
            $isEnglish = App::getLocale() === 'en';
        @endphp

        <div class="text-center mt-4">
            <a href="{{ route('home.designers') }}" class="d-flex align-items-center justify-content-center gap-2 chevron-hover">
                @if($isEnglish)
                    <span>@lang('homepage.Show All')</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 15" fill="none" class="ms-2">
                        <path d="M1 13.5L7 7.5L1 1.5" stroke="#2F2F2F" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                @else
                    <span>@lang('homepage.Show All')</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 15" fill="none" class="ms-2">
                        <path d="M8 13.5L2 7.5L8 1.5" stroke="#2F2F2F" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                @endif
            </a>
        </div>


        </div>
    </section>

</div>

@endsection
