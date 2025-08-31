@extends('layouts.designer.mainlayout')

@section('title', 'استبيان الطلب')

@section('content')


    <style>
        .form-check-input:checked {
            background-color: #0A4740;
            border-color: #0A4740;
        }
    </style>

    @if(session('success'))
        <div class="alert alert-success" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
            <strong>خطأ:</strong> {{ session('error') }}
        </div>

    @endif
    <div class="pagetitle" dir="rtl">
        <h1>استبيان الطلب رقم #{{ $order->id }}</h1>
    </div>

    <section class="section dashboard" dir="rtl">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body p-4">

                        <!-- معلومات الطلب -->
                        <p><strong>اسم المستخدم:</strong> {{ $order->user->name }}</p>
                        <p><strong>رقم الهاتف:</strong> {{ $order->user->phone }}</p>
                        <p><strong>شكل المطبخ:</strong> {{ $order->kitchen_shape }}</p>
                        <p><strong>مرحلة المعالجة:</strong> {{ $order->processing_stage }}</p>

                        <!-- نموذج الاستبيان -->
                        <form method="POST" action="{{ route('designer.order.survey.store', ['order' => $order->id]) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <!-- Field 1 -->
                                <div class="mb-3 col-md-6">
                                    <label for="hear_about_oppolia" class="form-label">كيف علمت عن اوبوليا اونلاين؟</label>
                                    <select class="form-select" id="hear_about_oppolia" name="hear_about_oppolia">
                                        <option value="إعلانات">إعلانات</option>
                                        <option value="مراجعات العملاء">مراجعات العملاء</option>
                                        <option value="وسائل التواصل الاجتماعي">وسائل التواصل الاجتماعي</option>
                                        <option value="أصدقاء أو عائلة">أصدقاء أو عائلة</option>
                                        <option value="محركات البحث">محركات البحث</option>
                                        <option value="أخرى">أخرى</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="expected_delivery_time" class="form-label">وقت التسليم المتوقع؟</label>
                                    <input type="date" class="form-control" id="expected_delivery_time" name="expected_delivery_time">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="client_budget" class="form-label">ما هي ميزانية الزبون؟</label>
                                    <input type="number" class="form-control" id="client_budget" name="client_budget">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="kitchen_room_size" class="form-label">ما هي أبعاد المطبخ المطلوب تصميمه؟</label>
                                    <input type="text" class="form-control" id="kitchen_room_size" name="kitchen_room_size">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="kitchen_style_preference" class="form-label">نوع المطبخ</label>
                                    <select class="form-select" id="kitchen_style_preference" name="kitchen_style_preference">
                                        <option value="حديث">حديث</option>
                                        <option value="تقليدي">تقليدي</option>
                                        <option value="ريفي">ريفي</option>
                                        <option value="معدني">معدني</option>
                                        <option value="مفتوح">مفتوح</option>
                                        <option value="آخر">آخر</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="sink_type" class="form-label">نوع المغسلة</label>
                                    <select class="form-select" id="sink_type" name="sink_type">
                                        <option value="مغسلة فردية">مغسلة فردية</option>
                                        <option value="مغسلة مزدوجة">مغسلة مزدوجة</option>
                                        <option value="مغسلة بقاعدة">مغسلة بقاعدة</option>
                                        <option value="مغسلة على سطح الطاولة">على سطح الطاولة</option>
                                        <option value="مغسلة تحت سطح الطاولة">تحت سطح الطاولة</option>
                                        <option value="مغسلة زاوية">زاوية</option>
                                        <option value="آخر">آخر</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="worktop_preference" class="form-label">نوع الكاونتر</label>
                                    <select class="form-select" id="worktop_preference" name="worktop_preference">
                                        <option value="رخام">رخام</option>
                                        <option value="غرانيت">غرانيت</option>
                                        <option value="خشب">خشب</option>
                                        <option value="كوارتز">كوارتز</option>
                                        <option value="فولاذ مقاوم للصدأ">فولاذ مقاوم للصدأ</option>
                                        <option value="زجاج">زجاج</option>
                                        <option value="آخر">آخر</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="deal_closing_likelihood" class="form-label">احتمالية إتمام الصفقة (1-10)</label>
                                    <input type="number" class="form-control" name="deal_closing_likelihood" min="1" max="10">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="reminder_details" class="form-label">تاريخ التذكير</label>
                                    <input type="datetime-local" class="form-control" id="reminder_details" name="reminder_details">
                                </div>

                                <!-- الاستخدام و الأجهزة والتفاصيل النصية تبقى full-width -->
                                <div class="col-12">
                                    <!-- استخدام المطبخ -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold mb-3">استخدام المطبخ</label>
                                        <div class="row g-3">
                                            @foreach(['الطهي', 'الاستضافة', 'التخزين', 'الترفيه'] as $use)
                                                <div class="col-6 col-md-3">
                                                    <div class="card p-2 border">
                                                        <div class="form-check d-flex align-items-center gap-2 m-0 p-2">
                                                            <input type="checkbox" class="form-check-input m-0" id="use_{{ $loop->index }}" name="kitchen_use[]" value="{{ $use }}">
                                                            <label class="form-check-label fw-medium m-0" for="use_{{ $loop->index }}">{{ $use }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- المستلزمات المطلوبة -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold mb-3">المستلزمات المطلوبة</label>
                                        <div class="row g-3">
                                            @foreach(['ميكروويف', 'غسالة صحون', 'ثلاجة', 'غسالة ملابس', 'محمصة خبز', 'خلاط', 'آخر'] as $item)
                                                <div class="col-6 col-md-3">
                                                    <div class="card p-2 border">
                                                        <div class="form-check d-flex align-items-center gap-2 m-0 p-2">
                                                            <input type="checkbox" class="form-check-input m-0" id="appliance_{{ $loop->index }}" name="appliances_needed[]" value="{{ $item }}">
                                                            <label class="form-check-label fw-medium m-0" for="appliance_{{ $loop->index }}">{{ $item }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                    <div class="mb-3">
                                        <label class="form-label">معلومات عامة عن الزبون والموقع</label>
                                        <textarea name="general_info" class="form-control" rows="3"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">استفسارات الزبون</label>
                                        <textarea name="customer_concerns" class="form-control" rows="3"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">الخطوات القادمة</label>
                                        <textarea name="next_steps_strategy" class="form-control" rows="3"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">رفع صور القياسات</label>
                                        <input type="file" class="form-control" name="measurements_images[]" multiple>
                                    </div>
                                </div>
                            </div>

                            <!-- زر الإرسال -->
                            <div class="text-center m-2">
                                <button type="submit" class="btn text-white px-5 py-2 button_Green" >إرسال الاستبيان</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
