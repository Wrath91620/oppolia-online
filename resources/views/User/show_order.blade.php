@extends('layouts.Frontend.mainlayoutfrontend')

@section('title', 'الطلب')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Modern Order Details Page Styling */
        .order-details-container {
            background: #f8f9fa;
            border-radius: 16px;
            padding: 2.5rem;
            margin: 2rem 0;
            border: 1px solid #e9ecef;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        
        .order-header {
            background: linear-gradient(135deg, #0A4740, #509F96);
            color: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }
        
        .order-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            transform: translate(30px, -30px);
        }
        
        .order-header h1 {
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }
        
        .order-header .back-link {
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }
        
        .order-header .back-link:hover {
            color: white;
            transform: translateX(-5px);
        }
        
        .order-status-section {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid #e9ecef;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        
        .status-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .status-item:hover {
            background: #e9ecef;
            transform: translateY(-2px);
        }
        
        .status-label {
            font-weight: 600;
            color: #495057;
            min-width: 120px;
        }
        
        .status-value {
            color: #0A4740;
            font-weight: 500;
        }
        
        .info-link {
            color: #0A4740;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        /* ✅ Images Grid Styling */
        .images-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        /* العنصر الحاوي لكل صورة */
        .images-grid .thumb {
            flex: 0 0 calc(50% - 6px); /* صورتين بالعرض على الموبايل */
        }

        /* الصورة نفسها */
        .images-grid .thumb img {
            width: 100%;
            height: auto;            /* تحافظ على النسبة */
            display: block;
            border-radius: 8px;
        }

        .lightbox-thumb {
            display: block;
            text-decoration: none;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .lightbox-thumb:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.2);
        }

        .lightbox-thumb .show_order_img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .lightbox-thumb:hover .show_order_img {
            transform: scale(1.05);
        }

        /* ✅ Lightbox Modal Styling */
        .lightbox-modal .modal-content {
            background: #f8f9fa;
            border-radius: 16px;
            border: 1px solid #e9ecef;
            box-shadow: 0 8px 32px rgba(0,0,0,0.15);
            overflow: hidden;
        }

        .lightbox-modal .modal-header {
            background: linear-gradient(135deg, #0A4740, #509F96);
            color: white;
            border-bottom: none;
            padding: 1.5rem 2rem;
            position: relative;
        }

        .lightbox-modal .modal-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 60px;
            height: 60px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            transform: translate(20px, -20px);
        }

        .lightbox-modal .modal-title {
            font-weight: 700;
            font-size: 1.4rem;
            position: relative;
            z-index: 1;
        }

        .lightbox-modal .btn-close {
            filter: invert(1);
            opacity: 0.8;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .lightbox-modal .btn-close:hover {
            opacity: 1;
            transform: scale(1.1);
        }

        .lightbox-modal .modal-body {
            padding: 0;
            background: white;
        }

        .lightbox-modal .carousel {
            border-radius: 0;
        }

        .lightbox-modal .carousel-item {
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 60vh;
            transition: none !important;
        }

        .lightbox-modal .carousel-item img {
            max-height: 70vh;
            max-width: 100%;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            transition: none !important;
            transform: none !important;
        }

        .lightbox-modal .carousel-inner {
            transition: none !important;
        }

        .lightbox-modal .carousel {
            transition: none !important;
        }

        .lightbox-modal .carousel-control-prev,
        .lightbox-modal .carousel-control-next {
            width: 50px;
            height: 50px;
            background: rgba(10, 71, 64, 0.8);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            margin: 0 20px;
            transition: all 0.3s ease;
        }

        .lightbox-modal .carousel-control-prev:hover,
        .lightbox-modal .carousel-control-next:hover {
            background: rgba(10, 71, 64, 1);
            transform: translateY(-50%) scale(1.1);
        }

        .lightbox-modal .carousel-control-prev-icon,
        .lightbox-modal .carousel-control-next-icon {
            width: 20px;
            height: 20px;
        }

        /* Image counter */
        .lightbox-modal .image-counter {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background: rgba(10, 71, 64, 0.9);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            z-index: 10;
        }

        /* ✅ PDF Icon Styling */
        .pdf-button .pdf-icon {
            color: #0A4740;
            transition: color 0.3s ease;
        }

        .pdf-button:hover .pdf-icon {
            color: #FFFFFF;
        }
        
        
        .info-link:hover {
            color: #509F96;
            transform: scale(1.1);
        }

        .timeline {
            border-left: none; /* remove full border */
            margin-left: 0;
            padding-left: 0;
            position: relative;
        }

        .timeline-item {
            position: relative;
            padding-left: 40px;
            margin-bottom: 25px;
            transition: all 0.3s ease;
        }
        /* Single per-step segment; defaults to gray (incomplete) */
        .timeline-item::after {
            content: '';
            position: absolute;
            left: 8.5px; /* align with thumb center */
            top: 40px; /* from center of thumb */
            width: 3px;
            height: 40px; /* fixed height to connect to next thumb */
            background: #D3D3D3; /* incomplete */
            z-index: 0;
        }
        /* Do not draw a segment after the last item */
        .timeline-item:last-child::after { display: none; }
        /* Completed or active segments turn green */
        .timeline-item.completed::after,
        .timeline-item.active::after { background: #0A4740; }
        
        .timeline-content:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border: 1px solid #0A4740;
        }

        .timeline-marker {
            position: absolute;
            left: 0; /* align thumb with text start */
            top: 50%;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #D3D3D3; /* default not complete */
            border: 3px solid white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            z-index: 1;
        }
        .timeline-item.completed .timeline-marker,
        .timeline-item.active .timeline-marker {
            background: #0A4740;
        }

        /* remove current-dot visuals entirely */
        .current-dot { display: none; }

        .timeline-content {
            padding: 15px 20px;
            background: white;
            border-radius: 10px;
            border: 1px solid #e9ecef;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        
        .timeline-content:hover {
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        .current {
            font-weight: bold;
            color: #0A4740;
        }
        
        .current .timeline-content {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-color: #0A4740;
        }



        .rating-container {
            margin: 20px 0;
        }

        .star-rating {
            direction: rtl;
            display: inline-flex;
            unicode-bidi: bidi-override;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            cursor: pointer;
            color: #ddd;
            transition: color 0.2s;
            margin: 0 2px;
        }

        .star-rating label .fa-star {
            font-size: 2.5em;
        }

        .star-rating label:hover,
        .star-rating label:hover ~ label,
        .star-rating input:checked ~ label {
            color: #ffd700;
        }

        .star-rating input:checked + label {
            color: #ffd700;
        }
        .accordion-body {
            background-color: #f8f9fa;
            border-radius: 0 0 12px 12px;
            padding: 2rem;
        }
        
        .accordion-item {
            border: 1px solid #e9ecef;
            border-radius: 12px;
            margin-bottom: 1rem;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        
        .accordion-button {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            color: #0A4740;
            font-size: 1.1rem;
            font-weight: 600;
            border: none;
            padding: 1.5rem 2rem;
            transition: all 0.3s ease;
        }
        
        .accordion-button:hover {
            background: linear-gradient(135deg, #e9ecef, #dee2e6);
            color: #0A4740;
        }
        
        .accordion-button:not(.collapsed) {
            background: linear-gradient(135deg, #0A4740, #509F96);
            color: white !important;
            box-shadow: none;
        }
        
        .accordion-button:not(.collapsed)::after {
            filter: brightness(0) invert(1);
        }
        
        /* Order details text color when accordion is open */
        .accordion-button:not(.collapsed) + .accordion-collapse .accordion-body {
            color: #495057;
        }
        
        /* Remove arrow from back button
        .order-header .back-link i {
            display: none;
        } */
        
        .accordion-button:focus {
            border-color: #0A4740;
            box-shadow: 0 0 0 0.2rem rgba(10, 71, 64, 0.25);
        }
        @if (app()->getLocale() == 'ar')
        .accordion-button::after {
            margin-left: 0;
            margin-right: auto;
            transform: rotate(90deg);
            background-image: var(--bs-accordion-btn-icon) !important;
        }
        @else
        .accordion-button::after {
            margin-right: 0;
            transform: rotate(272deg);
            background-image: var(--bs-accordion-btn-icon) !important;
        }
        @endif
        .accordion-button:not(.collapsed) {
             color: black;
             background-color: white;
            box-shadow: inset 0 calc(var(--bs-accordion-border-width)* -1) 0 var(--bs-accordion-border-color);
        }
        .accordion-button:focus {
            border-color: red;
            box-shadow: none;
        }
        .accordion-button{

            color: #000;
            font-size: 35px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }
        .show_order_img{
            width: 328px;
            height: 230px;
            border-radius: 12px;
            margin: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            object-fit: cover;
        }
        
        .show_order_img:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .show_order_font1{

            font-family:"tajawal";
            font-size: 16px;
            font-style: normal;

            line-height: normal;
        }
        .show_order_border_button{
            border-radius: 8px;
            border: 2px solid #0A4740 !important;
            padding: 12px 24px;
            color: #0A4740 !important;
            background: white;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .show_order_border_button:hover {
            background: #0A4740 !important;
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(10, 71, 64, 0.3);
        }
        
        .show_order_border_button_red{
            border-radius: 8px;
            border: 2px solid #dc3545 !important;
            padding: 12px 24px;
            color: #dc3545 !important;
            background: white;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .show_order_border_button_red:hover {
            background: #dc3545 !important;
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
        }
        .more_button{
            color: var(--Gray-Text-Color, #444);

            font-size: 14px;
            margin-inline: 15px;
            font-weight: 400;
            line-height: normal;
            text-decoration-line: underline;
            text-decoration-style: solid;
            text-decoration-skip-ink: auto;
            text-decoration-thickness: auto;
            text-underline-offset: 25%; /* 4px */
            text-underline-position: from-font;

        }


        @media (max-width: 767.98px) {
            .show_order_img {
                width: -webkit-fill-available;
                height: 200px;
                border-radius: 6.58px;
                margin-block: 10px;
                margin-inline: 0px;

            }
            .mobile-botton-font-1{
                font-size: 11px;
            }
            .show_order_font1{
                font-size: 13px;
                padding:2px;
            }
            .accordion-button {
                font-size: 20px;
            }

        }






    </style>
@endsection

@section('content')



    <div class="order-details-container">
        <!-- Header Section -->
        <div class="order-header">
            <div class="d-flex justify-content-between align-items-center">
                <h1 style="color: #FFF;">@lang('order.details_title')</h1>
                <a href="{{ url('/my-orders') }}" class="back-link">
                @lang('order.back') <i class="fas fa-arrow-left me-2"></i> 
                </a>
            </div>
        </div>

        <!-- Order Status Section -->
        <div class="order-status-section">
            <div class="status-item">
                <div class="status-label">@lang('order.order_status'):</div>
                <div class="status-value">{{ __('order.order_statuses.' . $order->order_status) }}</div>
            </div>
            
            <div class="status-item">
                <div class="status-label">@lang('order.status_details'):</div>
                <div class="status-value">
                    <span>{{ __('order.processing_stages.' . $order->processing_stage) }}</span>
                    <a type="button" class="info-link ms-2" data-bs-toggle="modal" data-bs-target="#stageModal" title="@lang('order.more')">
                        <i class="fas fa-info-circle"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- الأكورديون الرئيسي -->
        <div class="accordion" id="orderAccordion">
            <!-- تفاصيل الطلب -->
            <div class="accordion-item">
                <h2 class="accordion-header my-accordion-title-border-b" id="headingOne">
                    <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        @lang('order.order_info')
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#orderAccordion">
                    <div class="accordion-body">
                        <div class="order-info">
                            <div class="row ">
                                <div class="col-6 col-md-2 fw-bold mt-2 show_order_font1">@lang('order.order_number'):</div>
                                <div class="col-6 col-md-2 mt-2 show_order_font1">{{ $order->id }}</div>

                                <div class="col-6 col-md-2 fw-bold mt-2 show_order_font1">@lang('order.kitchen_area'):</div>
                                <div class="col-6 col-md-2 mt-2 show_order_font1">{{ $order->kitchen_area }} @lang('order.square_meter')</div>

                                <div class="col-6 col-md-2 fw-bold mt-2 show_order_font1">@lang('order.kitchen_shape'):</div>
                                <div class="col-6 col-md-2 mt-2 show_order_font1"> {{ __('order.kitchen_shapes.' . $order->kitchen_shape) }}</div>


                                <div class="col-6 col-md-2 fw-bold mt-2 show_order_font1">@lang('order.kitchen_style'):</div>
                                <div class="col-6 col-md-2 mt-2 show_order_font1"> {{ __('order.kitchen_styles.' . $order->kitchen_style) }}</div>

                                <div class="col-6 col-md-2 mt-2 fw-bold show_order_font1">@lang('order.expected_cost'):</div>
                                <div class="col-6 col-md-2 mt-2 show_order_font1">{{ $order->expected_cost }} @lang('order.saudi_riyals')</div>

                                <div class="col-6 col-md-2 mt-2 fw-bold show_order_font1"> @lang('order.time_range'):</div>
                                <div class="col-6 col-md-2 mt-2 show_order_font1">
                                    {{ __('order.time_ranges.' . $order->time_range) }}
                                </div>

                                <div class="col-6 col-md-2 fw-bold mt-2 show_order_font1">@lang('order.order_status'):</div>
                                <div class="col-6 col-md-2 mt-2 show_order_font1">{{ __('order.order_statuses.' . $order->order_status) }}</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- تفاصيل العميل -->
            @if ($orderDraft->isNotEmpty())
            <div class="accordion-item">
                <h2 class="accordion-header my-accordion-title-border-b" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                       @lang('order.design')
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#orderAccordion">
                    <div class="accordion-body">
                        <div class="user-info">
                            @foreach ($orderDraft as $draft)
                                @php
                                    $images = $draft->images ? json_decode($draft->images, true) : [];
                                @endphp

                                @if(!empty($images))
                                    <div class="images-grid">
                                        @foreach($images as $idx => $image)
                                            <a href="#"
                                               class="thumb lightbox-thumb"
                                               data-bs-toggle="modal"
                                               data-bs-target="#lightbox-{{ $draft->id }}"
                                               data-index="{{ $idx }}">
                                                <img class="show_order_img"
                                                     src="{{ asset('storage/' . $image) }}"
                                                     alt="Draft Image {{ $idx + 1 }}">
                                            </a>
                                        @endforeach
                                    </div>
                                @else
                                    @lang('order.No images')
                                @endif

                                    <div class="row mt-5  my-orders-title-border-b">
                                        <div class="col-sm-12 col-md-3 col-lg-3" style="display: inline-flex;">
                                            <p class="fw-bold show_order_font1">@lang('order.price') :</p>
                                            <label class="px-3 show_order_font1"> {{$draft->price}}</label>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6" style="display: inline-flex;">

                                            <a class="btn show_order_border_button pdf-button" href="{{ asset('storage/' . $draft->pdf) }}" target="_blank">
                                                <i class="fas fa-file-pdf pdf-icon" style="margin-left: 5px;"></i>
                                                @lang('order.view_pdf')</a>
                                        </div>
                                    </div>
                                    @if ($order->processing_stage != 'تم الموافقة على التصميم الأولي')
                                        @if($draft->state === 'finalized')
                                            <form action="#" method="POST" style="display:inline;">
                                                @csrf

                                            </form>
                                        @else

                                            <div class="row mt-2">
                                                <div class="col-sm-12 col-md-8 col-lg-8" style="display: inline-flex;">
                                                    <p class="fw-bold show_order_font1">@lang('order.actions') :</p>
                                                    <button type="button" class="btn btn-success button_Dark_Green mx-3" data-bs-toggle="modal" data-bs-target="#acceptModal-{{ $draft->id }}">
                                                        <img src="{{asset('Frontend/assets/images/icons/Vector203.png')}}" alt="Icon" width="20" height="20" style="margin-left: 5px;">
                                                        @lang('order.accept_design')
                                                    </button>
                                                </div>
                                                <div class="col-sm-12 col-md-4 col-lg-4 mt-2 mt-md-0" style="display: inline-flex;">
                                                    <button type="button" class="btn show_order_border_button mobile-botton-font-1" data-bs-toggle="modal" data-bs-target="#redesignModal-{{ $draft->id }}">
                                                        <img src="{{asset('Frontend/assets/images/icons/Vector204.png')}}" alt="Icon" width="10" height="10" style="margin-left: 5px;">
                                                        @lang('order.redesign')
                                                    </button>
                                                    <button type="button" class="btn show_order_border_button_red mobile-botton-font-1 mx-3" data-bs-toggle="modal" data-bs-target="#changeDesignerModal-{{ $draft->id }}">
                                                        <img src="{{asset('Frontend/assets/images/icons/Vector205.png')}}" alt="Icon" width="10" height="10" style="margin-left: 5px;">
                                                        @lang('order.change_designer')
                                                    </button>
                                                </div>
                                            </div>
                                            @endif
                                        @endif

                                    <div class="modal fade" id="acceptModal-{{ $draft->id }}" tabindex="-1" aria-labelledby="acceptModalLabel-{{ $draft->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="acceptModalLabel-{{ $draft->id }}">@lang('order.accept_design')</h5>

                                                </div>
                                                <div class="modal-body">
                                                    @lang('order.accept_design_confirm')
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"style="border-radius: 4px;">@lang('order.Cancel')</button>
                                                    <form action="{{ route('order.acceptDraft', ['order' => $order->id, 'draft' => $draft->id]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success button_Dark_Green mx-3" data-bs-toggle="modal" data-bs-target="#acceptModal-{{ $draft->id }}">
                                                            <img src="{{asset('Frontend/assets/images/icons/Vector203.png')}}" alt="Icon" width="20" height="20" style="margin-left: 5px;">
                                                            @lang('order.accept_design')
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ✅ مودال إعادة التصميم -->
                                    <div class="modal fade" id="redesignModal-{{ $draft->id }}" tabindex="-1" aria-labelledby="redesignModalLabel-{{ $draft->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="redesignModalLabel-{{ $draft->id }}">@lang('order.redesign')</h5>

                                                </div>
                                                <div class="modal-body">
                                                   @lang('order.redesign_request_confirmation')
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"style="border-radius: 4px;"> @lang('order.Cancel')</button>
                                                    <form action="{{ route('order.redesignDraft', ['order' => $order->id, 'draft' => $draft->id]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn show_order_border_button mobile-botton-font-1" data-bs-toggle="modal" data-bs-target="#redesignModal-{{ $draft->id }}">
                                                            <img src="{{asset('Frontend/assets/images/icons/Vector204.png')}}" alt="Icon" width="10" height="10" style="margin-left: 5px;">
                                                            @lang('order.redesign')
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ✅ مودال تغيير المصمم -->
                                    <div class="modal fade" id="changeDesignerModal-{{ $draft->id }}" tabindex="-1" aria-labelledby="changeDesignerModalLabel-{{ $draft->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="changeDesignerModalLabel-{{ $draft->id }}">@lang('order.change_designer')</h5>

                                                </div>
                                                <div class="modal-body">
                                                    @lang('order.change_designer_confirmation')
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 4px">@lang('order.Cancel')</button>
                                                    <form action="{{ route('order.changeDesigner', $order->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn show_order_border_button_red mobile-botton-font-1 mx-3" data-bs-toggle="modal" data-bs-target="#changeDesignerModal-{{ $draft->id }}">
                                                            <img src="{{asset('Frontend/assets/images/icons/Vector205.png')}}" alt="Icon" width="10" height="10" style="margin-left: 5px;">
                                                            @lang('order.change_designer')
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ✅ Lightbox Modal for Draft Images -->
                                    <div class="modal fade lightbox-modal" id="lightbox-{{ $draft->id }}" tabindex="-1" aria-labelledby="lightboxLabel-{{ $draft->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="lightboxLabel-{{ $draft->id }}">@lang('order.design')</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div id="carousel-{{ $draft->id }}" class="carousel slide" data-bs-ride="false">
                                                        <div class="carousel-inner">
                                                            @foreach($images as $idx => $image)
                                                                <div class="carousel-item {{ $idx === 0 ? 'active' : '' }}">
                                                                    <img src="{{ asset('storage/' . $image) }}" 
                                                                         class="d-block w-100" 
                                                                         alt="Draft Image {{ $idx + 1 }}">
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        @if(count($images) > 1)
                                                            <button class="carousel-control-prev" type="button">
                                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                <span class="visually-hidden">Previous</span>
                                                            </button>
                                                            <button class="carousel-control-next" type="button">
                                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                <span class="visually-hidden">Next</span>
                                                            </button>
                                                        @endif
                                                        @if(count($images) > 1)
                                                            <div class="image-counter">
                                                                <span class="current-image">1</span> / <span class="total-images">{{ count($images) }}</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif


            @if ($order->sale)
                <div class="accordion-item">
                    <h2 class="accordion-header my-accordion-title-border-b" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            {{ __('order.sales_details') }}
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#orderAccordion">
                        <div class="accordion-body">
                            <div >
                                <div class="row">
                                    <div class="col-6 col-md-2 fw-bold mt-2 show_order_font1">{{ __('order.total_cost') }}:</div>
                                    <div class="col-6 col-md-2 mt-2 show_order_font1">{{ $order->sale->total_cost }} {{ __('order.saudi_riyals') }}</div>

                                    <div class="col-6 col-md-2 fw-bold mt-2 show_order_font1">{{ __('order.discounted_price') }}:</div>
                                    <div class="col-6 col-md-2 mt-2 show_order_font1">{{ $order->sale->price_after_discount }} {{ __('order.saudi_riyals') }}</div>

                                    <div class="col-6 col-md-2 fw-bold mt-2 show_order_font1">{{ __('order.discount') }}:</div>
                                    <div class="col-6 col-md-2 mt-2 show_order_font1">{{ $order->sale->discount_percentage }}%</div>

                                    <div class="col-6 col-md-2 fw-bold mt-2 show_order_font1">{{ __('order.amount_paid') }}:</div>
                                    <div class="col-6 col-md-2 mt-2 show_order_font1">{{ $order->sale->amount_paid }} {{ __('order.saudi_riyals') }}</div>

                                    <div class="col-6 col-md-2 fw-bold mt-2 show_order_font1">{{ __('order.status') }}:</div>
                                    <div class="col-6 col-md-2 mt-2 show_order_font1 {{ $order->sale->status === 'completed' ? 'text-success fw-bold' : '' }}">
                                        {{ __('order.statuses.' . $order->sale->status) }}
                                        @if($order->sale->status === 'completed')
                                            <i class="fas fa-check-circle ms-2" style="color: #0A4740;"></i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif



            @if (optional($order->sale)->installments && $order->sale->installments->isNotEmpty())
                <div class="accordion-item">
                    <h2 class="accordion-header my-accordion-title-border-b" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            {{ __('order.installments_details') }}
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#orderAccordion">
                        <div class="accordion-body">
                            <div class="survey-questions">
                                <div class="table-responsive my-3">
                                    <table class="table table-striped table-hover table-bordered">
                                        <thead class="table-light">
                                        <tr>
                                            <th class="text-nowrap">{{ __('order.amount') }}</th>
                                            <th class="text-nowrap">{{ __('order.percentage') }}</th>
                                            <th class="text-nowrap">{{ __('order.due_date') }}</th>
                                            <th class="text-nowrap">{{ __('order.status') }}</th>
                                            <th class="text-nowrap">{{ __('order.actions_column') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($order->sale->installments as $installment)
                                            <tr>
                                                <td data-label="{{ __('order.amount') }}">{{ $installment->installment_amount }} {{ __('order.saudi_riyals') }}</td>
                                                <td data-label="{{ __('order.percentage') }}">{{ $installment->percentage }}%</td>
                                                <td data-label="{{ __('order.due_date') }}">{{ $installment->due_date }}</td>
                                                <td data-label="{{ __('order.status') }}">
                                        <span class="badge
                                            @if($installment->status === 'pending') bg-warning text-dark
                                            @elseif($installment->status === 'awaiting_customer_payment') bg-warning text-dark
                                            @else bg-success
                                            @endif">
                                            {{ $installment->status == 'awaiting_customer_payment' ? __('order.statuses.pending') : __('order.installment_statuses.' . $installment->status) }}
                                        </span>
                                                </td>
                                                <td data-label="{{ __('order.actions_column') }}">
                                                    @if ($installment->status === 'pending')
                                                        <button
                                                            type="button"
                                                            class="btn button_Dark_Green btn-sm w-100 mb-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#termsModal"
                                                            data-installment-id="{{ $installment->id }}"
                                                            data-installment-amount="{{ $installment->installment_amount }}"
                                                            data-installment-due-date="{{ $installment->due_date }}">
                                                            <i class="bi bi-credit-card"></i> {{ __('order.buy') }}
                                                        </button>
                                                    @elseif ($installment->status === 'awaiting_customer_payment')
                                                        <div class="bank-details small">
                                                            <div class="d-md-none">
                                                                <ul class="list-unstyled">
                                                                    <li><strong>{{ __('order.bank_name') }}:</strong> مصرف الراجحي</li>
                                                                    <li><strong>{{ __('order.account_number') }}:</strong> 123456789012345</li>
                                                                    <li><strong>{{ __('order.iban') }}:</strong> SA1234567890123456789012</li>
                                                                    <li><strong>{{ __('order.address') }}:</strong> الرياض</li>
                                                                </ul>
                                                            </div>
                                                            <div class="d-none d-md-block">
                                                                <p class="mb-1"><strong>{{ __('order.bank_name') }}:</strong> @lang('order.Al Rajhi Bank')</p>
                                                                <p class="mb-1"><strong>{{ __('order.account_number') }}:</strong> 123456789012345</p>
                                                                <p class="mb-1"><strong>{{ __('order.iban') }}:</strong> SA1234567890123456789012</p>
                                                                <p class="mb-1"><strong>{{ __('order.address') }}:</strong> @lang('order.Riyadh, Kingdom of Saudi Arabia')</p>
                                                            </div>
                                                            <button class="btn button_Dark_Green mt-1"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#uploadPaymentReceiptModal-{{ $installment->id }}">
                                                                <i class="bi bi-upload"></i> {{ __('order.upload_receipt') }}
                                                            </button>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


        <!-- مسودات الطلب -->

            @if($order->processing_stage=="اكتمل الطلب")
                <div class="accordion-item">
                    <h2 class="accordion-header my-accordion-title-border-b" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            @lang('order.designer_rating')

                            @php
                                $existingRating = \App\Models\DesignerRating::where('user_id', auth()->id())
                                    ->where('designer_id', $order->approved_designer_id)
                                    ->where('order_id', $order->id)
                                    ->first();
                            @endphp
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#orderAccordion">
                        <div class="accordion-body">
                        @if ($existingRating)
                            <!-- Existing Rating -->
                                <div class="rating-display mb-3">
                                    <p class="h6">
                                        <strong>@lang('order.your_rating')</strong>
                                        @for($i = 0; $i < $existingRating->rating; $i++)
                                            <i class="fa fa-star text-warning"></i>
                                        @endfor
                                    </p>
                                    <p class="h6"> <strong>@lang('order.your_review')</strong> {{ $existingRating->review }}</p>
                                </div>

                                <!-- Edit Button -->
                                <button type="button" class="btn button_Dark_Green" data-bs-toggle="modal" data-bs-target="#editRatingModal">
                                    @lang('order.edit_rating')
                                </button>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editRatingModal" tabindex="-1" aria-labelledby="editRatingModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editRatingModalLabel">@lang('order.edit_rating')</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('update.designer.rating', $existingRating->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="rating-container">
                                                        <label>@lang('order.rating'):</label>
                                                        <div class="star-rating">
                                                            @for ($i = 5; $i >= 1; $i--)
                                                                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required>
                                                                <label for="star{{ $i }}" class="star"><i class="fa fa-star"></i></label>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <label for="review">@lang('order.review'):</label>
                                                    <textarea name="review" class="form-control mt-2" id="review" required></textarea>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 4px">@lang('order.Cancel')</button>
                                                        <button type="submit" class="btn button_Dark_Green">@lang('order.save_changes')</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @else
                            <!-- New Rating Form -->
                                <form action="{{ route('rate.designer') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="designer_id" value="{{ $order->approved_designer_id }}">
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">

                                    <div class="rating-container">
                                        <label>@lang('order.rating'):</label>
                                        <div class="star-rating">
                                            @for ($i = 5; $i >= 1; $i--)
                                                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required>
                                                <label for="star{{ $i }}" class="star"><i class="fa fa-star"></i></label>
                                            @endfor
                                        </div>
                                    </div>

                                    <label for="review">@lang('order.review'):</label>
                                    <textarea name="review" class="form-control mt-2" id="review" required></textarea>

                                    <button type="submit" class="btn button_Dark_Green mt-2">@lang('order.send_rating')</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

            @endif
        </div>


        <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="termsModalLabel">{{ __('order.terms_and_conditions') }}</h5>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('order.terms_notice') }}</p>
                        <a href="" target="_blank">{{ __('order.view_terms') }}</a>
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" id="agreeCheckbox">
                            <label class="form-check-label" for="agreeCheckbox">
                                {{ __('order.agree_terms') }}
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 4px;">
                            {{ __('order.Cancel') }}
                        </button>
                        <button type="button" class="btn button_Dark_Green" id="confirmTermsButton" disabled>
                            {{ __('order.confirm_purchase') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paymentModalLabel">{{ __('order.payment_details') }}</h5>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('order.payment_notice') }}</p>
                        <ul>
                            <li><strong>{{ __('order.bank_name') }}:</strong>@lang('order.Al Rajhi Bank')</li>
                            <li><strong>{{ __('order.account_number') }}:</strong> 123456789012345</li>
                            <li><strong>{{ __('order.iban') }}:</strong> SA1234567890123456789012</li>
                            <li><strong>{{ __('order.address') }}:</strong>@lang('order.Riyadh, Kingdom of Saudi Arabia')</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-payment-modal" data-bs-dismiss="modal" style="border-radius: 4px;">
                            {{ __('order.Cancel') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>


    @if($order->sale && $order->sale->installments)
        @foreach ($order->sale->installments as $installment)
            <!-- Modal for Upload Payment Receipt -->
                <div class="modal fade" id="uploadPaymentReceiptModal-{{ $installment->id }}" tabindex="-1" aria-labelledby="uploadPaymentReceiptModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="uploadPaymentReceiptModalLabel">@lang('order.upload_receipt_title') {{ $installment->installment_number }}</h5>

                            </div>
                            <div class="modal-body">
                                <form action="{{ route('installments.uploadReceipt', $installment->id) }}" method="POST" enctype="multipart/form-data">

                                    @csrf
                                    <div class="mb-3">
                                        <label for="payment_receipt" class="form-label">@lang('order.choose_receipt_file')</label>
                                        <input type="file" class="form-control" id="payment_receipt" name="payment_receipt" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 4px">@lang('order.Cancel')</button>
                                        <button type="submit" class="btn  button_Dark_Green">@lang('order.upload_receipt')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        <div class="modal fade" id="stageModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('order.processing_stages_title', ['id' => $order->id])</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        @php
                            $currentIndex = array_search($order->processing_stage, $all_stages, true);
                            if ($currentIndex === false) { $currentIndex = 0; }
                        @endphp
                        <div class="timeline">
                            @foreach($all_stages as $idx => $stage)
                                @php
                                    $rowState = $idx < $currentIndex ? 'completed' : ($idx === $currentIndex ? 'active' : '');
                                @endphp
                                <div class="timeline-item {{ $rowState }} {{ $stage === $order->processing_stage ? 'current' : '' }}">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        {{ __('order.processing_stages.' . $stage) }}
                                        @if($stage === $order->processing_stage)
                                            <span class="badge" style="background-color: #0A4740">@lang('order.current_status_label')</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @endsection



        @section('script')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // تهيئة الأكورديون
                    const mainAccordion = new bootstrap.Collapse(document.querySelector('#orderInfo'), {
                        toggle: true
                    });

                    // معالجة أحداث الدفع
                    document.querySelectorAll('[data-bs-target="#paymentModal"]').forEach(btn => {
                        btn.addEventListener('click', function() {
                            const installmentId = this.dataset.installmentId;
                            // إضافة منطق الدفع هنا
                        });
                    });

                    // معالجة نجوم التقييم
                    document.querySelectorAll('.rating-stars input').forEach(star => {
                        star.addEventListener('change', function() {
                            const container = this.closest('.rating-stars');
                            container.querySelectorAll('.fa-star').forEach(icon => {
                                icon.classList.remove('text-warning');
                            });
                            this.closest('.form-check').querySelectorAll('.fa-star').forEach(icon => {
                                icon.classList.add('text-warning');
                            });
                        });
                    });
                });
            </script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var termsModal = document.getElementById('termsModal');
                    var paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));

                    // تفعيل زر تأكيد الشراء بعد الموافقة على الشروط
                    document.getElementById("agreeCheckbox").addEventListener("change", function() {
                        document.getElementById("confirmTermsButton").disabled = !this.checked;
                    });

                    // عند الضغط على "تأكيد الشراء"، يتم إغلاق المودال الأول وفتح مودال الدفع
                    document.getElementById("confirmTermsButton").addEventListener("click", function() {
                        var modalInstance = bootstrap.Modal.getInstance(termsModal);
                        modalInstance.hide();
                        setTimeout(function() {
                            paymentModal.show();
                        }, 500); // تأخير بسيط لضمان الإغلاق قبل الفتح
                    });
                });
            </script>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var termsModal = new bootstrap.Modal(document.getElementById('termsModal'));
                    var paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));

                    // تفعيل زر "تأكيد الشراء" فقط بعد تحديد الموافقة على الشروط
                    document.getElementById("agreeCheckbox").addEventListener("change", function() {
                        document.getElementById("confirmTermsButton").disabled = !this.checked;
                    });

                    // عند الضغط على "تأكيد الشراء"، يتم إرسال طلب AJAX لتحديث حالة القسط
                    document.getElementById("confirmTermsButton").addEventListener("click", function(event) {
                        event.preventDefault(); // منع إعادة تحميل الصفحة

                        var installmentButton = document.querySelector("button[data-bs-target='#termsModal']");
                        var installmentId = installmentButton.getAttribute("data-installment-id");

                        // إرسال طلب AJAX إلى الخادم لتحديث حالة القسط
                        fetch("{{ route('installment.updateStatus') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}" // حماية CSRF
                            },
                            body: JSON.stringify({
                                installment_id: installmentId
                            })
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    console.log("تم تحديث حالة القسط بنجاح");

                                    // إغلاق المودال الأول قبل فتح المودال الثاني
                                    termsModal.hide();
                                    setTimeout(function() {
                                        paymentModal.show();
                                    }, 500); // تأخير بسيط لضمان الإغلاق قبل الفتح

                                } else {
                                    console.error("خطأ في تحديث القسط:", data.error);
                                }
                            })
                            .catch(error => console.error("حدث خطأ أثناء تحديث القسط:", error));
                    });

                    // التأكد من إغلاق المودال الثاني عند الضغط على زر الإغلاق بدون إعادة تحميل الصفحة
                    document.querySelector("#paymentModal .btn-secondary").addEventListener("click", function(event) {
                        event.preventDefault(); // منع إعادة تحميل الصفحة
                        paymentModal.hide();
                    });
                });
            </script>


            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var paymentModalElement = document.getElementById('paymentModal');
                    var paymentModal = new bootstrap.Modal(paymentModalElement);

                    // تأكد من إغلاق المودال بدون تعليق عند الضغط على زر الإغلاق
                    document.querySelectorAll(".close-payment-modal").forEach(button => {
                        button.addEventListener("click", function(event) {
                            event.preventDefault(); // منع إعادة تحميل الصفحة بشكل غير مقصود
                            paymentModal.hide();
                        });
                    });

                    // عند إغلاق المودال الثاني، يتم إعادة تحميل الصفحة تلقائيًا
                    paymentModalElement.addEventListener("hidden.bs.modal", function() {
                        console.log("المودال مغلق! سيتم إعادة تحميل الصفحة...");
                        location.reload(); // إعادة تحميل الصفحة
                    });
                });
            </script>

            <!-- ✅ Lightbox JavaScript -->
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Initialize all lightbox modals
                    document.querySelectorAll('.lightbox-modal').forEach(function(modal) {
                        var carouselEl = modal.querySelector('.carousel');
                        if (carouselEl) {
                            // Create carousel instance with auto-slide disabled and no transitions
                            var carousel = new bootstrap.Carousel(carouselEl, {
                                interval: false,
                                ride: false,
                                wrap: true
                            });
                            
                            // Disable CSS transitions on carousel elements
                            carouselEl.style.transition = 'none';
                            var carouselInner = carouselEl.querySelector('.carousel-inner');
                            if (carouselInner) {
                                carouselInner.style.transition = 'none';
                            }
                        }
                    });

                    // Handle thumbnail clicks
                    document.querySelectorAll('.lightbox-thumb').forEach(function (thumb) {
                        thumb.addEventListener('click', function () {
                            var modalId = this.getAttribute('data-bs-target');
                            var index = parseInt(this.getAttribute('data-index'), 10) || 0;
                            var modalEl = document.querySelector(modalId);
                            var carouselEl = modalEl.querySelector('.carousel');

                            // Get or create carousel instance
                            var carousel = bootstrap.Carousel.getInstance(carouselEl);
                            if (!carousel) {
                                carousel = new bootstrap.Carousel(carouselEl, {
                                    interval: false,
                                    ride: false,
                                    wrap: true
                                });
                            }

                            // Navigate to clicked image when modal opens
                            var onShown = function () {
                                setTimeout(function() {
                                    carousel.to(index);
                                    updateImageCounter(modalEl, index + 1);
                                }, 100);
                                modalEl.removeEventListener('shown.bs.modal', onShown);
                            };
                            modalEl.addEventListener('shown.bs.modal', onShown);
                        });
                    });

                    // Update image counter when carousel slides
                    document.querySelectorAll('.lightbox-modal .carousel').forEach(function(carousel) {
                        carousel.addEventListener('slid.bs.carousel', function(event) {
                            var modal = this.closest('.lightbox-modal');
                            var currentIndex = event.to + 1;
                            updateImageCounter(modal, currentIndex);
                        });
                    });

                    // Handle navigation button clicks manually
                    document.querySelectorAll('.lightbox-modal .carousel-control-prev, .lightbox-modal .carousel-control-next').forEach(function(button) {
                        button.addEventListener('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            var carouselEl = this.closest('.carousel');
                            var carousel = bootstrap.Carousel.getInstance(carouselEl);
                            if (carousel) {
                                if (this.classList.contains('carousel-control-prev')) {
                                    carousel.prev();
                                } else {
                                    carousel.next();
                                }
                            }
                        });
                    });

                    function updateImageCounter(modal, currentIndex) {
                        var counter = modal.querySelector('.image-counter');
                        if (counter) {
                            var currentSpan = counter.querySelector('.current-image');
                            if (currentSpan) {
                                currentSpan.textContent = currentIndex;
                            }
                        }
                    }
                });
            </script>





@endsection
