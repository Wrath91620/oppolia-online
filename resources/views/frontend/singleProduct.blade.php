@extends('layouts.Frontend.mainlayoutfrontend')
@section('title') @lang('home.products') @endsection
@section('content')
    <style>
        .my_img_product {
            height: 750px;
        }
        .my-des-product {
            color: rgba(10, 71, 64, 1); font-size: 30px; font-weight:500;
        }

        /* لأجهزة التابلت */
        @media (max-width: 1024px) {
            .my_img_product {
                height: 500px;
            }
        }

        /* لأجهزة الموبايل */
        @media (max-width: 768px) {
            .my_img_product {
                height: 300px;
            }
            .my-des-product {
                font-size: 16px;
            }
        }
    </style>

<div class="container p-5">
    <!-- Arrow and Product Name in One Line -->
    <div class="row mb-4">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <h1 class="text-right m-0 my-des-product" >
                @if(App::getLocale() === 'ar')
                    {{ $product->name_ar ?? $product->name }}
                @else
                    {{ $product->name }}
                @endif
            </h1>
            <a href="{{ url('/products') }}" class="black-color">
                <i class="fas  me-2 "></i>@lang('order.back')
            </a>
        </div>
    </div>

    <!-- Product Image Section -->
    <div class="row">
        <div class="col-md-12 text-center">
            <img src="{{ asset($product->image ? 'storage/' . $product->image : 'storage/profile_images/ProfilePlaceholder.jpg') }}"
                 class="img-fluid rounded-4 w-100 mb-4 my_img_product"
                 alt="Product Image">
        </div>
    </div>

    <!-- Description Section -->
    @foreach($product->descriptions as $description)
    <div class="row">
        <div class="col-md-12">
            <p class="p-2 text-justify">
                @if(App::getLocale() === 'ar')
                    {!! $description->description_ar  ?? $description->description !!}
                @else
                    {!! $description->description !!}
                @endif
            </p>
        </div>
    </div>

    <!-- Additional Images Section -->
    @if($description->images)
        @php
            $images = json_decode($description->images);
        @endphp
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="{{ asset('storage/' . $images[0]) }}" alt="Main Image" class="img-fluid rounded-4 w-100 mb-4">
            </div>
        </div>
        <div class="row">
            @foreach(array_slice($images, 1) as $image)
                <div class="col-md-6 mb-3">
                    <img src="{{ asset('storage/' . $image) }}" alt="Side Image" class="img-fluid rounded-4 w-100">
                </div>
            @endforeach
        </div>
    @endif
    @endforeach


    <div class="container p-2">
        @if (session('success'))
                            <div style="color: green;" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div style="color: red;" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                    {{ session('error') }}
                </div>
            @endif

        <form method="POST" action="{{ route('home.contact.store') }}">
            @csrf

            <div class="row">
                <div class="col-md-6" >
                    <div class="mb-4">
                        <label class="form-label fw-bold contact-titles">@lang('contact.full_name')</label>
                        <input type="text" class="form-control" name="full_name" placeholder="@lang('contact.full_name_placeholder')" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold contact-titles">@lang('contact.phone')</label>
                        <input type="tel" class="form-control" name="phone" placeholder="@lang('contact.phone_placeholder')" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold contact-titles">@lang('contact.email')</label>
                        <input type="email" class="form-control" name="email" placeholder="@lang('contact.email_placeholder')" required>
                    </div>
                </div>

                <div class="col-md-6" >
                    <div class="mb-4">
                        <label class="form-label fw-bold contact-titles">@lang('contact.city')</label>
                        <select class="form-control" name="sub_region_id" required>
                            <option disabled selected>@lang('contact.city_placeholder')</option>
                            @foreach($subRegions as $subRegion)
                                <option value="{{ $subRegion->id }}">
                                    {{ app()->getLocale() === 'ar' ? $subRegion->name_ar : $subRegion->name_en }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold contact-titles">@lang('contact.message')</label>
                        <textarea class="form-control" name="message" placeholder="@lang('contact.message_placeholder')" required></textarea>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 text-end" style="justify-self: center; text-align-last: center;">
                <button type="submit" class="px-5 py-2 btn button_Dark_Green">@lang('contact.submit')</button>
            </div>
        </form>
    </div>
</div>

@endsection
