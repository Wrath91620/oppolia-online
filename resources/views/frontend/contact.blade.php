@extends('layouts.Frontend.mainlayoutfrontend')
@section('title') @lang('contact.page_title') @endsection

@section('content')

    <style>
        .form-control {
            background-color: white;
        }
        a {
            color: #0a4740;
        }

        .form-label { 
            color: #0a4740;
        }

        /* Fix text alignment for Arabic placeholder text */
        [dir="rtl"] .form-control::placeholder {
            text-align: right;
            direction: rtl;
        }

        [dir="rtl"] .form-control {
            text-align: right;
            direction: rtl;
        }

        [dir="ltr"] .form-control::placeholder {
            text-align: left;
            direction: ltr;
        }

        [dir="ltr"] .form-control {
            text-align: left;
            direction: ltr;
        }
    </style>

    <!-- Hero Banner Section -->
    <div class="container-fluid about-section p-0 position-relative">
        <div class="col-12 p-0">
            <img src="{{ asset('Frontend/assets/images/banners/contact-banner.png') }}" alt="Contact Us Banner" class="img-fluid about-image">
        </div>

        <div class="about-text-overlay">
            <h1 class="about-text">@lang('contact.page_title')</h1>
        </div>
    </div>

    <!-- Main Content Section -->
    <section class="py-5">
        <!-- Intro Section with Image - Full Width -->
        <div class="container-fluid p-0 mb-5">
            <div class="row align-items-center" style="background: rgba(131, 176, 171, 1);">
                <div class="col-lg-6 p-0">
                    <img src="{{ asset('Frontend/assets/images/gallery/AboutPillow.png') }}" alt="Contact Image" class="img-fluid vision-image">
                </div>
                <div class="col-lg-6 p-4 text-center">
                    <p class="contact-p mb-0">
                        @lang('contact.intro_paragraph')
                    </p>
                </div>
            </div>
        </div>

        <div class="container">

            <!-- Contact Form Section -->
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-sm border-0" style="border-radius: 15px;">
                        <div class="card-body p-4">
                            
                            <!-- Success/Error Messages -->
                            @if (session('success'))
                                <div class="alert alert-success text-center" role="alert" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger text-center" role="alert" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <!-- Contact Form -->
                            <form method="POST" action="{{ route('home.contact.store') }}">
                                @csrf

                                <div class="row g-4">
                                    <!-- Left Column -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold contact-titles">@lang('contact.full_name')</label>
                                            <input type="text" class="form-control" name="full_name" placeholder="@lang('contact.full_name_placeholder')" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold contact-titles">@lang('contact.phone')</label>
                                            <input type="tel" class="form-control" name="phone" placeholder="@lang('contact.phone_placeholder')" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold contact-titles">@lang('contact.email')</label>
                                            <input type="email" class="form-control" name="email" placeholder="@lang('contact.email_placeholder')" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" required>
                                        </div>
                                    </div>

                                    <!-- Right Column -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold contact-titles">@lang('contact.city')</label>
                                            <select class="form-control" name="sub_region_id" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" required>
                                                <option disabled selected>@lang('contact.city_placeholder')</option>
                                                @foreach($subRegions as $subRegion)
                                                    <option value="{{ $subRegion->id }}">
                                                        {{ app()->getLocale() === 'ar' ? $subRegion->name_ar : $subRegion->name_en }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold contact-titles">@lang('contact.message')</label>
                                            <textarea class="form-control" name="message" placeholder="@lang('contact.message_placeholder')" rows="6" style="height: 148px; resize: none;" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="text-center mt-4">
                                    <button type="submit" class="px-5 py-3  btn button_Dark_Green">@lang('contact.submit')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Information Section -->
            <div class="row justify-content-center mt-5">
                <div class="col-lg-8">
                    <div class="text-center">
                        <h5 class="fw-bold mb-4">@lang('contact.contact_info')</h5>
                        <div class="row g-4 justify-content-center">
                            <div class="col-md-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-envelope mb-2" style="font-size: 1.5rem; color: #0a4740;"></i>
                                    <p class="mb-0"><strong>@lang('contact.email_label'):</strong></p>
                                    <a href="mailto:info@oppoliaksa.com">info@oppoliaksa.com</a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fab fa-whatsapp mb-2" style="font-size: 1.5rem; color: #0a4740;"></i>
                                    <p class="mb-0"><strong>@lang('contact.whatsapp_label'):</strong></p>
                                    <a href="https://wa.me/966564444343" target="_blank" dir="ltr">+966564444343</a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-phone mb-2" style="font-size: 1.5rem; color: #0a4740;"></i>
                                    <p class="mb-0"><strong>@lang('contact.phone_label'):</strong></p>
                                    <a href="tel:+966564444343" dir="ltr">+966564444343</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
