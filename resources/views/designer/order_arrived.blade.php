@extends('layouts.designer.mainlayout')

@section('title', 'تأكيد وصول الطلب')

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

    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>تأكيد وصول الطلب</h4>
            </div>
            <div class="card-body">
                <p class="alert alert-info" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                    <strong>📦 تم شحن المطبخ وهو الآن في المملكة العربية السعودية!</strong>
                    يمكنك تأكيد استلام الطلب لإكمال باقي الإجراءات.
                </p>

                <form id="arrivalForm" action="{{ route('manufacture.arrived', ['order' => $order->id]) }}" method="POST">
                @csrf

                <!-- عرض رقم الطلب كـ Label فقط -->
                    <div class="form-group mb-3">
                        <label>رقم الطلب: <strong>{{ $order->id }}</strong></label>
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                    </div>

                    <!-- سؤال هل وصل الطلب؟ -->
                    <div class="col-12">
                        <!-- هل تم وصول الطلب؟ -->
                        <div class="mb-4">
                            <label class="form-label fw-bold mb-3">هل تم وصول الطلب؟</label>
                            <div class="row g-3">
                                <div class="col-6 col-md-3">
                                    <div class="card p-2 border">
                                        <div class="form-check d-flex align-items-center gap-2 m-0 p-2">
                                            <input type="checkbox" class="form-check-input m-0" id="order_arrived" name="order_arrived" value="yes">
                                            <label class="form-check-label fw-medium m-0" for="order_arrived">نعم، تم الوصول</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn button_Green " data-bs-toggle="modal" data-bs-target="#confirmationModal">
                        تأكيد وصول الطلب
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- مودال التأكيد -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">تأكيد وصول الطلب</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <p>أنت على وشك تأكيد وصول الطلب، هل أنت متأكد من ذلك؟</p>
                    <p class="text-info"><strong>🚚 المطبخ الآن داخل المملكة العربية السعودية.</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn button_Green " id="confirmArrivalSubmit">تأكيد الوصول</button>
                </div>
            </div>
        </div>
    </div>

    <!-- إضافة Bootstrap JS لتحكم بالمودال -->
    <script>
        document.getElementById('confirmArrivalSubmit').addEventListener('click', function () {
            document.getElementById('arrivalForm').submit();
        });
    </script>

@endsection
