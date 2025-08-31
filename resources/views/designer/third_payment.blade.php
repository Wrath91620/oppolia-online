@extends('layouts.designer.mainlayout')

@section('title', 'دفعة الطلب الثالثة')

@section('content')
    @php
        $sale = $order->sale;
        $installments = $sale ? $sale->installments : collect();
        $installment2=$installments->firstWhere('installment_number', 2) ;
        // حساب مجموع الدفعات الأولى والثانية فقط
        $totalFirstAndSecondPayments = $installments->where('installment_number', '<=', 2)->sum('installment_amount');

        // حساب مبلغ الدفعة الثالثة
        $thirdPaymentAmount = $sale ? ($sale->price_after_discount - $totalFirstAndSecondPayments) : 0;
    @endphp
    <div class="container">
        <h2>تفاصيل الطلب رقم: {{ $order->id }}</h2>

        <div class="card">
            <div class="card-body">
                <h4>تفاصيل المبيعات</h4>
                @if($sale)
                    <p><strong>إجمالي التكلفة:</strong> {{ number_format($sale->total_cost, 2) }}</p>
                    <p><strong>إجمالي التكلفة بعد الخصم:</strong> {{ number_format($sale->price_after_discount, 2) }}</p>

                    <p><strong>إجمالي الدفعات الأولى والثانية:</strong> {{ number_format($totalFirstAndSecondPayments, 2) }}</p>
                @else
                    <p>لم يتم تسجيل عملية بيع لهذا الطلب بعد.</p>
                @endif
            </div>
        </div>

        @if($installments->isNotEmpty())
            <div class="mt-4">
                <h4>الدفعات السابقة</h4>
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
            <p>لا توجد أقساط مسجلة حتى الآن.</p>
        @endif


        @if($installments->isNotEmpty() && $installments->firstWhere('installment_number', 2) && $installments->firstWhere('installment_number', 2)->status == 'receipt_uploaded')
            <div class="card mt-4">
                <div class="card-body">
                    <h4>مراجعة دفعة الثانية</h4>
                    <p>تم تحميل إيصال الدفع. انظر الإيصال أدناه:</p>
                    <!-- Display the payment receipt if available -->
                    @php
                        $installmentTwo = $installments->firstWhere('installment_number', 2);
                    @endphp
                    @if ($installmentTwo && $installmentTwo->payment_receipt)
                        @php
                            $filePath = 'storage/' . $installmentTwo->payment_receipt;
                            $fullPath = public_path($filePath);
                            $extension = pathinfo($installmentTwo->payment_receipt, PATHINFO_EXTENSION);
                            $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                            $isPDF = strtolower($extension) === 'pdf';
                        @endphp

                        <div class="document-preview mb-4">
                        @if($isImage)
                            <!-- عرض الصورة مع إمكانية التكبير -->
                                <div class="text-center">
                                    <img src="{{ asset($filePath) }}"
                                         alt="إيصال الدفع"
                                         class="img-fluid border rounded cursor-zoom"
                                         style="max-width: 100%; max-height: 500px;"
                                         onclick="window.open(this.src, '_blank')">
                                    <p class="mt-2 text-muted">انقر على الصورة للتكبير</p>
                                </div>
                        @elseif($isPDF)
                            <!-- عرض PDF مع خيارات متعددة -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="card-title">مستند PDF</h5>
                                            <a href="{{ asset($filePath) }}"
                                               download
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-download"></i> تنزيل
                                            </a>
                                        </div>
                                        <div class="pdf-container border rounded" style="height: 500px;">
                                            <iframe src="{{ asset($filePath) }}#toolbar=0&view=fitH"
                                                    width="100%"
                                                    height="100%"
                                                    style="border: none;">
                                                المتصفح الخاص بك لا يدعم معاينة PDF.
                                            </iframe>
                                        </div>
                                    </div>
                                </div>
                        @else
                            <!-- عرض ملفات أخرى غير معروفة -->
                                <div class="alert alert-info" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>ملف مرفق ({{ $extension }})</span>
                                        <a href="{{ asset($filePath) }}"
                                           download
                                           class="btn btn-sm btn-success">
                                            <i class="fas fa-download"></i> تنزيل الملف
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                    <div class="row m-2">
                        <div class="col-md-6">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
                                رفض
                            </button>
                        </div>
                        <div class="col-md-6">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn button_Green" data-bs-toggle="modal" data-bs-target="#acceptModal">
                                قبول
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if($installments->isNotEmpty() && $installments->firstWhere('installment_number', 2) && $installments->firstWhere('installment_number', 2)->status == 'paid')

        <div class="mt-4">
            <h4>إضافة الدفعة الثالثة</h4>
            <form action="{{ route('sales.installments.storeThird', $sale->id) }}" method="POST">
                @csrf
                <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                <input type="hidden" name="installment_number" value="3"> {{-- تحديد القسط الثالث --}}

                <div class="mb-3">
                    <label for="installment_amount" class="form-label">المبلغ المطلوب للدفعة الثالثة (يتم حسابه تلقائيًا)</label>
                    <input type="number" id="installment_amount" name="installment_amount" class="form-control" value="{{ $thirdPaymentAmount }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="percentage" class="form-label">النسبة (يتم حسابها تلقائيًا)</label>
                    <input type="number" id="percentage" name="percentage" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label for="due_date" class="form-label">تاريخ الاستحقاق</label>
                    <input type="date" name="due_date" class="form-control" required>
                </div>

                <button type="submit" class="btn button_Green">إضافة الدفعة الثالثة</button>
            </form>
        </div>
            @endif
    </div>





    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">تأكيد الرفض</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    هل أنت متأكد أنك تريد رفض هذه الدفعة؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <form action="{{ route('installments.update.status', [$installment2->id, 'awaiting_customer_payment']) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="awaiting_customer_payment">
                        <button type="submit" class="btn btn-outline-danger">تأكيد الرفض</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Accept Modal -->
    <div class="modal fade" id="acceptModal" tabindex="-1" aria-labelledby="acceptModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="acceptModalLabel">تأكيد القبول</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    هل أنت متأكد أنك تريد قبول هذه الدفعة؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <form action="{{ route('installments.update.status', [ $installment2->id, 'paid']) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="paid">
                        <button type="submit" class="btn button_Green">تأكيد القبول</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let installmentAmountInput = document.getElementById("installment_amount");
            let percentageInput = document.getElementById("percentage");

            let totalCostAfterDiscount = {{ $sale->price_after_discount }};
            let totalFirstAndSecondPayments = {{ $totalFirstAndSecondPayments }};

            let thirdPaymentAmount = totalCostAfterDiscount - totalFirstAndSecondPayments;
            installmentAmountInput.value = thirdPaymentAmount.toFixed(2);

            // حساب النسبة الجديدة بناءً على المبلغ المطلوب
            let newPercentage = (thirdPaymentAmount / totalCostAfterDiscount) * 100;
            percentageInput.value = newPercentage.toFixed(2);
        });
    </script>
@endsection
