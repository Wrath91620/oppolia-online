@extends('layouts.designer.mainlayout')

@section('title', 'إنهاء التصنيع')

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
                <h4>إنهاء التصنيع</h4>
            </div>
            <div class="card-body">
                <form id="finishManufactureForm" action="{{ route('manufacture.finish', ['order' => $order->id]) }}" method="POST">
                @csrf

                <!-- عرض رقم الطلب كـ Label فقط -->
                    <div class="form-group mb-3">
                        <label>رقم الطلب: <strong>{{ $order->id }}</strong></label>
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                    </div>

                    <!-- سؤال هل تم إنهاء التصنيع؟ -->
                    <div class="col-12">
                        <!-- هل تم إنهاء التصنيع؟ -->
                        <div class="mb-4">
                            <label class="form-label fw-bold mb-3">هل تم إنهاء التصنيع؟</label>
                            <div class="row g-3">
                                <div class="col-6 col-md-3">
                                    <div class="card p-2 border">
                                        <div class="form-check d-flex align-items-center gap-2 m-0 p-2">
                                            <input type="checkbox" class="form-check-input m-0" id="manufacturing_finished" name="manufacturing_finished" value="yes">
                                            <label class="form-check-label fw-medium m-0" for="manufacturing_finished">نعم، تم</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn button_Green " data-bs-toggle="modal" data-bs-target="#confirmationModal">
                        إنهاء التصنيع
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
                    <h5 class="modal-title" id="confirmationModalLabel">تأكيد إنهاء التصنيع</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <p>أنت على وشك إنهاء عملية التصنيع، هل أنت متأكد من ذلك؟</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn button_Green " id="confirmFinishSubmit">إنهاء التصنيع</button>
                </div>
            </div>
        </div>
    </div>

    <!-- إضافة Bootstrap JS لتحكم بالمودال -->
    <script>
        document.getElementById('confirmFinishSubmit').addEventListener('click', function () {
            document.getElementById('finishManufactureForm').submit();
        });
    </script>

@endsection
