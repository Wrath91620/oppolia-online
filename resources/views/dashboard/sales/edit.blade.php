@extends('layouts.Dashboard.mainlayout')

@section('title', 'تفاصيل المبيعات والدفعات')

@section('content')

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

    <div class="container mt-4">
        <h2 class="mb-4">📜 تفاصيل المبيعات والدفعات للمبيع رقم {{ $sale->id }}</h2>

        @php
            $canEditPrice = ($sale->installments_count == 1 && $sale->installments->first()->status != 'paid');

            // حساب مجموع الدفعات
            $totalInstallmentsAmount = $sale->installments->sum('installment_amount');
            $disableEdit = ($sale->installments_count == 3 && $totalInstallmentsAmount == $sale->price_after_discount);
        @endphp

        <form action="{{ route('sales.update', $sale->id) }}" method="POST">
        @csrf
        @method('POST')

        <!-- بيانات المبيع -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">تفاصيل المبيع</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="total_cost" class="form-label">التكلفة الإجمالية</label>
                        <input type="number" step="0.01" class="form-control" id="total_cost" name="total_cost"
                               value="{{ $sale->total_cost }}"
                               {{ ($disableEdit || !$canEditPrice) ? 'readonly' : '' }}
                               oninput="calculateDiscount()">
                    </div>

                    <div class="mb-3">
                        <label for="price_after_discount" class="form-label">السعر بعد الخصم</label>
                        <input type="number" step="0.01" class="form-control" id="price_after_discount" name="price_after_discount"
                               value="{{ $sale->price_after_discount }}"
                               {{ ($disableEdit || !$canEditPrice) ? 'readonly' : '' }}
                               oninput="calculateDiscount(); updateInstallmentPercentages();">
                    </div>

                    <div class="mb-3">
                        <label for="discount_percentage" class="form-label">نسبة الخصم</label>
                        <input type="number" step="0.01" class="form-control" id="discount_percentage" name="discount_percentage"
                               value="{{ $sale->discount_percentage }}" readonly>
                    </div>
                </div>
            </div>

            <!-- بيانات الدفعات -->
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">تفاصيل الدفعات</div>
                <div class="card-body" style="overflow-x: auto; width: 100%;">
                    <table class="table table-bordered" style="min-width: 800px;">
                        <thead>
                        <tr>
                            <th>رقم الدفعة</th>
                            <th>المبلغ</th>
                            <th>النسبة (%)</th>
                            <th>تاريخ الاستحقاق</th>
                            <th>الحالة</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($sale->installments as $installment)
                            <tr>
                                <td>{{ $installment->installment_number }}</td>
                                <td>
                                    <input type="number" step="0.01" class="form-control installment-amount"
                                           name="installments[{{ $installment->id }}][installment_amount]"
                                           value="{{ $installment->installment_amount }}"
                                           oninput="updateInstallmentPercentage({{ $installment->id }})"
                                        {{ ($disableEdit || $installment->status == 'paid') ? 'readonly' : '' }}>
                                </td>
                                <td>
                                    <input type="number" step="0.01" class="form-control installment-percentage"
                                           name="installments[{{ $installment->id }}][percentage]"
                                           value="{{ $installment->percentage }}"
                                           id="installment_percentage_{{ $installment->id }}" readonly>
                                </td>
                                <td>
                                    <input type="date" class="form-control"
                                           name="installments[{{ $installment->id }}][due_date]"
                                           value="{{ $installment->due_date ? $installment->due_date: '' }}"
                                        {{ ($disableEdit || $installment->status == 'paid') ? 'readonly' : '' }}>
                                </td>
                                <td>
                                    <select class="form-select" name="installments[{{ $installment->id }}][status]"
                                        {{ ($disableEdit || $installment->status == 'paid') ? 'disabled' : '' }}>
                                        <option value="pending" {{ $installment->status == 'pending' ? 'selected' : '' }}>تم أنشاء الدفعة</option>
                                        <option value="paid" {{ $installment->status == 'paid' ? 'selected' : '' }}>مدفوع</option>
                                        <option value="overdue" {{ $installment->status == 'overdue' ? 'selected' : '' }}>متأخر</option>
                                        <option value="awaiting_customer_payment" {{ $installment->status == 'awaiting_customer_payment' ? 'selected' : '' }}>بانتظار الدفع</option>
                                        <option value="receipt_uploaded" {{ $installment->status == 'receipt_uploaded' ? 'selected' : '' }}>رفع العميل اشعار الدفع</option>
                                    </select>
                                    @if($installment->status == 'paid')
                                        <input type="hidden" name="installments[{{ $installment->id }}][status]" value="paid">
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- زر الحفظ -->
            @if (!$disableEdit)
                <button type="submit" class="btn btn-success">💾 حفظ التعديلات</button>
            @else
                <div class="alert alert-danger text-center" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                    🚫 لا يمكن التعديل لأن مجموع الدفعات يساوي السعر بعد الخصم ويوجد 3 دفعات.
                </div>
            @endif
        </form>
    </div>

    <!-- JavaScript لحساب نسبة الخصم ونسبة الدفعات -->
    <script>
        function calculateDiscount() {
            let totalCost = parseFloat(document.getElementById('total_cost').value) || 0;
            let priceAfterDiscount = parseFloat(document.getElementById('price_after_discount').value) || 0;

            if (totalCost > 0) {
                let discountPercentage = ((totalCost - priceAfterDiscount) / totalCost) * 100;
                document.getElementById('discount_percentage').value = discountPercentage.toFixed(2);
            }
        }

        function updateInstallmentPercentage(installmentId) {
            let installmentAmount = parseFloat(document.querySelector(`[name="installments[${installmentId}][installment_amount]"]`).value) || 0;
            let priceAfterDiscount = parseFloat(document.getElementById('price_after_discount').value) || 1;

            let percentage = (installmentAmount / priceAfterDiscount) * 100;
            document.getElementById(`installment_percentage_${installmentId}`).value = percentage.toFixed(2);
        }

        function updateInstallmentPercentages() {
            document.querySelectorAll('.installment-amount').forEach(input => {
                let installmentId = input.name.match(/\d+/)[0];
                updateInstallmentPercentage(installmentId);
            });
        }
    </script>

@endsection
