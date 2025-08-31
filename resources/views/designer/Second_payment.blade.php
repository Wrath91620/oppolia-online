@extends('layouts.designer.mainlayout')

@section('title', ' دفعات الطلب')

@section('content')
    @php
        $sale = $order->sale;
        $installments = $sale ? $sale->installments : collect();

        // Calculate 50% of the discounted cost
        $halfPrice = $sale ? ($sale->price_after_discount * 0.50) : 0;

        // Calculate the total amount paid in previous installments
        $totalPaidInstallments = $installments->sum('installment_amount');

        // Calculate the new required amount to reach 50% of the discounted price
        $remainingAmount = $halfPrice - $totalPaidInstallments;
    @endphp
    <div class="container">
        <h2>تفاصيل الطلب رقم: {{ $order->id }}</h2>

        <div class="card">
            <div class="card-body">
                <h4>تفاصيل المبيعات</h4>
                @if($sale)
                    <p><strong>إجمالي التكلفة:</strong> {{ number_format($sale->total_cost, 2) }}</p>
                    <p><strong>إجمالي التكلفة بعد الخصم:</strong> {{ number_format($sale->price_after_discount, 2) }}</p>
                    @if($installments->first()->status == 'paid')
                    <p><strong>المبلغ المدفوع بالدفعات السابقة:</strong> {{ number_format($totalPaidInstallments, 2) }}</p>
                        @endif

                @else
                    <p>لم يتم تسجيل عملية بيع لهذا الطلب بعد.</p>
                @endif
            </div>
        </div>

        @if($installments->isNotEmpty())
            <div class="mt-4">
                <h4>الدفعات</h4>
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


        @if($installments->isNotEmpty() && $installments->first()->status == 'receipt_uploaded')
            <div class="card mt-4">
                <div class="card-body">
                    <h4>مراجعة دفعة الأولى</h4>
                    <p>تم تحميل إيصال الدفع. انظر الإيصال أدناه:</p>
                    <!-- Display the payment receipt if available -->

                @if($installments->first()->payment_receipt)
                    @php
                        $extension = pathinfo($installments->first()->payment_receipt, PATHINFO_EXTENSION);
                    @endphp

                    @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                        <!-- عرض الصورة -->
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $installments->first()->payment_receipt) }}"
                                     alt="إيصال الدفع"
                                     class="img-fluid border rounded"
                                     style="max-width: 100%; max-height: 500px;">
                            </div>
                    @elseif(strtolower($extension) === 'pdf')
                        <!-- عرض PDF باستخدام iframe -->
                            <div class="mb-4 border rounded" style="height: 500px;">
                                <iframe src="{{ asset('storage/' . $installments->first()->payment_receipt) }}#toolbar=0"
                                        width="100%"
                                        height="100%"
                                        style="border: none;">
                                    المتصفح الخاص بك لا يدعم عرض PDF.
                                    <a href="{{ asset('storage/' . $installments->first()->payment_receipt) }}" download>
                                        اضغط هنا لتنزيل الملف
                                    </a>
                                </iframe>
                            </div>
                    @else
                        <!-- عرض رابط التنزيل للملفات الأخرى -->
                            <div class="alert alert-info" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                                <a href="{{ asset('storage/' . $installments->first()->payment_receipt) }}" download class="btn btn-primary">
                                    <i class="fas fa-download"></i> تنزيل الملف
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="alert alert-warning" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">لا يوجد إيصال مرفق</div>
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
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#acceptModal">
                                قبول
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    @if($installments->first()->status == 'paid')

            <div class="mt-4">
                <h4>إضافة دفعة جديدة</h4>
                <form action="{{ route('sales.installments.store', $sale->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="sale_id" value="{{ $sale->id }}">

                    <div class="mb-3">
                        <label for="installment_amount" class="form-label">المبلغ (يتم حسابه تلقائيًا)</label>
                        <input type="number" id="installment_amount" name="installment_amount" class="form-control" value="{{ $remainingAmount }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="percentage" class="form-label">النسبة (يتم حسابها تلقائيًا)</label>
                        <input type="number" id="percentage" name="percentage" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="due_date" class="form-label">تاريخ الاستحقاق</label>
                        <input type="date" name="due_date" class="form-control" required>
                    </div>

                    <button type="submit" class="btn button_Green">إضافة دفعة</button>
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
                    <form action="{{ route('installments.update.status', [$installments->first()->id, 'awaiting_customer_payment']) }}" method="POST" style="display: inline-block;">
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
                    <form action="{{ route('installments.update.status', [$installments->first()->id, 'paid']) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="paid">
                        <button type="submit" class="btn btn-success">تأكيد القبول</button>
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
            let halfCost = totalCostAfterDiscount * 0.50;
            let totalPaidInstallments = {{ $totalPaidInstallments }};

            let remainingAmount = halfCost - totalPaidInstallments;
            installmentAmountInput.value = remainingAmount.toFixed(2);

            // حساب النسبة الجديدة بناءً على المبلغ المطلوب
            let newPercentage = (remainingAmount / totalCostAfterDiscount) * 100;
            percentageInput.value = newPercentage.toFixed(2);
        });
    </script>
@endsection
