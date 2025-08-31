@extends('layouts.designer.mainlayout')

@section('title', 'بدء التركيب')

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
                <h4>بدء التركيب</h4>
            </div>
            <div class="card-body">
                <p class="alert " dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                    <strong>🔨 تم تجهيز المطبخ، ويمكنك الآن بدء عملية التركيب!</strong>
                    قم بتأكيد بدء التركيب حتى يتم تحديث حالة الطلب.
                </p>

                <form id="installationForm" action="{{ route('installation.start', ['order' => $order->id]) }}" method="POST">
                @csrf

                <!-- عرض رقم الطلب كـ Label فقط -->
                    <div class="form-group mb-3">
                        <label>رقم الطلب: <strong>{{ $order->id }}</strong></label>
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                    </div>

                    <!-- سؤال هل تم بدء التركيب؟ -->
                    <div class="col-12">
                        <!-- هل تم بدء التركيب؟ -->
                        <div class="mb-4">
                            <label class="form-label fw-bold mb-3">هل تم بدء التركيب؟</label>
                            <div class="row g-3">
                                <div class="col-6 col-md-3">
                                    <div class="card p-2 border">
                                        <div class="form-check d-flex align-items-center gap-2 m-0 p-2">
                                            <input type="checkbox" class="form-check-input m-0" id="installation_started" name="installation_started" value="yes">
                                            <label class="form-check-label fw-medium m-0" for="installation_started">نعم، تم البدء</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn button_Green  text-white" data-bs-toggle="modal" data-bs-target="#confirmationModal">
                        تأكيد بدء التركيب
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
                    <h5 class="modal-title" id="confirmationModalLabel">تأكيد بدء التركيب</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <p>أنت على وشك تأكيد بدء التركيب، هل أنت متأكد من ذلك؟</p>
                    <p class="text-info"><strong>⚒️ تأكد من أن جميع الأدوات والمواد جاهزة للتركيب.</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn button_Green  text-white" id="confirmInstallationSubmit">تأكيد بدء التركيب</button>
                </div>
            </div>
        </div>
    </div>

    <!-- إضافة Bootstrap JS لتحكم بالمودال -->
    <script>
        document.getElementById('confirmInstallationSubmit').addEventListener('click', function () {
            document.getElementById('installationForm').submit();
        });
    </script>

@endsection
