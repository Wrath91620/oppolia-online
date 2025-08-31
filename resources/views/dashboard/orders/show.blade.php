@extends('layouts.Dashboard.mainlayout')

@section('title', 'إدارة الطلبات')

@section('css')
    <link href="{{ asset('path/to/datatables.css') }}" rel="stylesheet">
    <style>
        /* تنسيق الخريطة */
        #map {
            height: 400px;
            width: 100%;
        }
        .accordion-button::after {
            margin-left: 0;          /* إزالة الهامش الأيسر */
            margin-right: auto;      /* دفع السهم إلى اليمين */
            content: url('/Dashboard/assets/images/Add.svg');
            background-image: none !important; /* Remove Bootstrap arrow */
        }
        .accordion-item {
            margin-bottom: 10px;
        }
        .accordion-button {
            background-color: rgba(0, 0, 0, 0.13);
            color: rgba(28, 28, 28, 1);
        }
        .accordion-button:not(.collapsed) {
            background-color:  #f8f9fa;
            color: black;
        }
        .accordion-button[aria-expanded="true"]::after {
            content: url('/Dashboard/assets/images/Minus.svg'); /* - icon */
        }
        .accordion-body {
            background-color: #f8f9fa;
        }
        .order-info, .user-info, .designer-info, .survey-questions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .order-info p, .user-info p, .designer-info p, .survey-questions p {
            flex: 1 1 30%;
            padding: 10px;
            border-radius: 21.33px;
            background: var(--Primary-Color, #509F96);
            justify-items: center;
            color: white;
        }
        .order-info p strong, .user-info p strong, .designer-info p strong, .survey-questions p strong {
            display: block;
            margin-bottom: 5px;
        }
        .badge.bg-purple {
            background-color: #6f42c1 !important;
            color: white !important;
        }

        .img-thumbnail {
            transition: transform 0.2s;
        }

        .img-thumbnail:hover {
            transform: scale(1.05);
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(80, 159, 150, 0.1);
        }


    </style>
@endsection

@section('content')

    @if(session('success'))
        <div class="alert alert-success" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
            {{ session('error') }}
        </div>
    @endif

    @if($order->approved_designer_id == null && $order->orderDraft && $order->processing_stage =='change_designer')
        <p><strong>ملاحظة:</strong> العميل طلب تغيير المصمم.</p>

        <form action="{{ route('dashboard.orders.changeDesigner', $order->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="designer_id"><strong>اختر المصمم:</strong></label>
                <select name="designer_id" id="designer_id" class="form-control" required>
                    <option value="" disabled selected>اختر المصمم</option>
                    @foreach($designers as $designer)
                        @if($designer->user)
                            <option value="{{ $designer->id }}">{{ $designer->user->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">تغيير المصمم</button>
        </form>
    @endif

    <div class="container" dir="rtl">
        <h1>تفاصيل الطلب</h1>

        <div class="accordion" id="orderAccordion">
            <!-- تفاصيل الطلب -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        تفاصيل الطلب
                    </button>
                </h2>
                <div id="collapseOne" class="collapse accordion-collapse show" aria-labelledby="headingOne" data-bs-parent="#orderAccordion">
                    <div class="accordion-body">
                        <div class="order-info">
                            <p><strong>رقم الطلب:</strong> {{ $order->id }}</p>
                            <p><strong>مساحة المطبخ:</strong> {{ $order->kitchen_area }} متر مربع</p>
                            <p><strong>شكل المطبخ:</strong> {{ $order->kitchen_shape }}</p>
                            <p><strong>التكلفة المتوقعة:</strong> {{ $order->expected_cost }} SAR</p>
                            <p><strong>حالة الطلب:</strong>
                                @switch($order->order_status)
                                    @case('accepted')
                                    مقبول
                                    @break
                                    @case('rejected')
                                    مرفوض
                                    @break
                                    @case('closed')
                                    مغلق
                                    @break
                                    @case('pending')
                                    قيد الانتظار
                                    @break
                                    @default
                                    غير معروف
                                @endswitch
                            </p>
                            <p><strong>منطقة الطلب :</strong> {{ $order->region->name_ar}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- تفاصيل العميل -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="collapsed accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        تفاصيل العميل
                    </button>
                </h2>
                <div id="collapseTwo" class="collapse accordion-collapse" aria-labelledby="headingTwo" data-bs-parent="#orderAccordion">
                    <div class="accordion-body">
                        <div class="user-info">
                            <p><strong>الاسم:</strong> {{ $order->user->name }}</p>
                            <p><strong>البريد الإلكتروني:</strong> {{ $order->user->email }}</p>
                            <p><strong>رقم الهاتف:</strong> {{ $order->user->phone }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- تفاصيل زيارة المصمم -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="collapsed accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        تفاصيل زيارة المصمم
                    </button>
                </h2>
                <div id="collapseThree" class="collapse accordion-collapse" aria-labelledby="headingThree" data-bs-parent="#orderAccordion">
                    <div class="accordion-body">
                        <div class="designer-info">
                            @isset($order->approved_designer_id)
                                <p><strong>اسم المصمم:</strong> {{ $order->designer->user->name }}</p>

                                @if ($order->designerMeeting)
                                    <p><strong>تاريخ الزيارة:</strong> {{ $order->designerMeeting->meeting_time }}</p>
                                @else
                                    <p>لم يتم تحديد موعد زيارة المصمم بعد.</p>
                                @endif
                            @endisset
                        </div>
                    </div>
                </div>
            </div>

            <!-- أسئلة الاستبيان -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="collapsed accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        أسئلة الاستبيان
                    </button>
                </h2>
                <div id="collapseFour" class="collapse accordion-collapse" aria-labelledby="headingFour" data-bs-parent="#orderAccordion">
                    <div class="accordion-body">
                        <div class="survey-questions">
                            @if ($order->surveyQuestion)
                                <p><strong>كيف علمت عن اوبوليا اونلاين؟ </strong> {{ $order->surveyQuestion->hear_about_oppolia }}</p>
                                <p><strong>متى التاريخ المتوقع للتوصيل؟ </strong> {{ $order->surveyQuestion->expected_delivery_time }}</p>
                                <p><strong>ما هي ميزانية الزبون؟ </strong>SAR{{ $order->surveyQuestion->client_budget }}</p>
                                <p><strong>ما هي أبعاد المطبخ المطلوب تصميمه؟ </strong> {{ $order->surveyQuestion->kitchen_room_size }} متر مربع</p>
                                <p><strong>ما هو مغزى المطبخ؟</strong> {{ $order->surveyQuestion->kitchen_use }}</p>
                                <p><strong>ما هو نوع المطبخ الذي طلبه الزبون؟ </strong> {{ $order->surveyQuestion->kitchen_style_preference }}</p>
                                <p><strong>ما هي المستلزمات اللازمة للزبون؟ </strong> {{ $order->surveyQuestion->appliances_needed }}</p>
                                <p><strong>ما هو نوع المغسلة التي طلبها الزبون؟</strong> {{ $order->surveyQuestion->sink_type }}</p>
                                <p><strong>ما نوع الكاونتر التي طلبها الزبون؟ </strong> {{ $order->surveyQuestion->worktop_preference }}</p>
                                <p><strong>معلومات عامة عن مكان العمل, المنزل, الزبون, الأمور المالية, الأمور العائلية؟ </strong> {{ $order->surveyQuestion->general_info }}</p>
                                <p><strong>أي سؤال أو استفسار تم توجيهه من الزبون؟ </strong> {{ $order->surveyQuestion->customer_concerns }}</p>
                                <p><strong>الخطوات القادمة و مخططاتك؟ </strong> {{ $order->surveyQuestion->next_steps_strategy }}</p>
                                <p><strong>تفاصيل التذكير:</strong> {{ $order->surveyQuestion->reminder_details }}</p>
                                <p><strong>احتمالية إغلاق الصفقة:</strong> {{ $order->surveyQuestion->deal_closing_likelihood }}</p>

                                @if(!empty($order->surveyQuestion->measurements_images))
                                    <ul>
                                        @foreach (json_decode($order->surveyQuestion->measurements_images, true) as $imagePath)
                                            <li>
                                                <img src="{{ asset('storage/' . $imagePath) }}" alt="صورة القياس" style="max-width: 100px;">
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>لا توجد صور تم تحميلها لهذا الطلب.</p>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- مسودات الطلب -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                    <button class="collapsed accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        مسودات الطلب
                    </button>
                </h2>
                <div id="collapseFive" class="collapse accordion-collapse" aria-labelledby="headingFive" data-bs-parent="#orderAccordion">
                    <div class="accordion-body">
                        @if ($order->orderDraft->count() > 0)
                            <div style="overflow-x: auto; width: 100%;">
                            <table class="table table-bordered table-hover"  style="min-width: 800px;">
                                <thead class="thead-light">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="15%">السعر</th>
                                    <th width="30%">الصور</th>
                                    <th width="20%">PDF</th>
                                    <th width="15%">الحالة</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($order->orderDraft as $draft)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ number_format($draft->price, 2) }} ر.س</td>
                                        <td>
                                            @if (!empty($draft->images))
                                                <div class="d-flex flex-wrap gap-2">
                                                    @foreach (json_decode($draft->images, true) as $image)
                                                        <a href="{{ asset('storage/' . $image) }}" target="_blank">
                                                            <img src="{{ asset('storage/' . $image) }}"
                                                                 alt="صورة المسودة"
                                                                 class="img-thumbnail"
                                                                 style="width: 80px; height: 80px; object-fit: cover;">
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="text-muted">لا توجد صور</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($draft->pdf)
                                                <a href="{{ asset('storage/' . $draft->pdf) }}"
                                                   target="_blank"
                                                   class="btn button_Green ">
                                                    <i class="fas fa-file-pdf"></i> عرض PDF
                                                </a>
                                            @else
                                                <span class="text-muted">لا يوجد ملف</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @php
                                                $stateClasses = [
                                                    'draft' => 'badge bg-secondary',
                                                    'finalized' => 'badge bg-success',
                                                    'approved' => 'badge bg-primary',
                                                    'rejected' => 'badge bg-danger',
                                                    'designer_changed' => 'badge bg-warning text-dark',
                                                    'redesign' => 'badge bg-info',
                                                    'modified' => 'badge bg-purple'
                                                ];
                                            @endphp

                                            <span class="{{ $stateClasses[$draft->state] ?? 'badge bg-light text-dark' }}">
                        @switch($draft->state)
                                                    @case('draft') مسودة @break
                                                    @case('finalized') نهائي @break
                                                    @case('approved') معتمد @break
                                                    @case('rejected') مرفوض @break
                                                    @case('designer_changed') تعديل المصمم @break
                                                    @case('redesign') إعادة تصميم @break
                                                    @case('modified') معدل @break
                                                    @default غير معروف
                                                @endswitch
                    </span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        @else
                            <p>لا توجد مسودات لهذا الطلب.</p>
                        @endif
                    </div>
                </div>
            </div>

            @php
                $installments = $order->sale?->installments ?? collect();
            @endphp




            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSix">
                    <button class="collapsed accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        المبيعات
                    </button>
                </h2>

                    <div id="collapseSix" class="collapse accordion-collapse" aria-labelledby="headingSix" data-bs-parent="#orderAccordion">
                        <div class="accordion-body">
                            @if($installments->isNotEmpty())
                                <div class="mt-4">
                                    <h4>الدفعات  السابقة</h4>
                                    <div style="overflow-x: auto; width: 100%;">
                                        <table class="table table-bordered" style="min-width: 800px;">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>المبلغ</th>
                                                <th>النسبة</th>
                                                <th>تاريخ الاستحقاق</th>
                                                <th>الحالة</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($installments as $installment)
                                                <tr>
                                                    <td>{{ $installment->installment_number }}</td>
                                                    <td>{{ number_format($installment->installment_amount, 2) }}</td>
                                                    <td>{{ $installment->percentage }}%</td>
                                                    <td>{{ $installment->due_date }}</td>
                                                    <td>{{ $installment->status }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <p>لا توجد دفعات  حتى الآن.</p>
                            @endif
                        </div>
                    </div>

            </div>



        </div>

        <!-- عرض الخريطة -->
        <div id="map"></div>
    </div>
@endsection

@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&callback=initMap" async defer></script>
    <script>
        function initMap() {
            var lengthStep = {{ $order->length_step ?? 24.7136 }};
            var widthStep = {{ $order->width_step ?? 46.6753 }};
            var orderLocation = {lat: lengthStep, lng: widthStep};

            var map = new google.maps.Map(document.getElementById('map'), {
                center: orderLocation,
                zoom: 14
            });

            var marker = new google.maps.Marker({
                position: orderLocation,
                map: map
            });
        }
    </script>
@endsection
