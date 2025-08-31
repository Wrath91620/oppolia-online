@extends('layouts.designer.mainlayout')
@section('title', 'المسودات المعتمدة للطلب')
@section('content')

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
    <div class="container" dir="rtl">
        <h2>المسودات المعتمدة للطلب #{{ $order->id }}</h2>
        @if($approvedDrafts->isEmpty())
            <p>لا توجد مسودات معتمدة لهذا الطلب.</p>
        @else
            <div style="overflow-x: auto; width: 100%;">
            <table class="table">
                <thead>
                <tr>
                    <th>السعر</th>
                    <th>الصور</th>
                    <th>PDF</th>
                </tr>
                </thead>
                <tbody>
                @foreach($approvedDrafts as $draft)
                    <tr>
                        <td>{{ $draft->price }}</td>
                        <td>
                            @foreach(json_decode($draft->images) as $image)
                                <img src="{{ asset('storage/'.$image) }}" alt="صورة" style="width: 100px;">
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ asset('storage/' . $draft->pdf) }}"
                               target="_blank"
                               class="btn button_Green ">
                                <i class="fas fa-file-pdf"></i> عرض PDF
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        @endif
    </div>
    <div class="container" dir="rtl">
        <h2>إنشاء مسودة طلب نهائية</h2>
        <form action="{{ route('designer.order_draft_finalized.store', $order->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- السعر -->
                <div class="col-lg-6 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="price">السعر</label>
                        <input type="number" name="price" id="price" class="form-control" required>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="price_after_discount">السعر بعد الخصم</label>
                        <input type="number" name="price_after_discount" id="price_after_discount" class="form-control" required>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 mb-3">
                    <div class="form-group">
                        <label for="discount_percentage">النسبة المئوية للخصم</label>
                        <input type="text" id="discount_percentage" class="form-control" >
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="installment_amount">مبلغ الدفعة الاولى</label>
                        <input type="text" name="installment_amount" id="installment_amount" class="form-control" >
                    </div>
                </div>


                <div class="col-lg-6 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="percentage">النسبة المئوية للدفعة الاولى</label>
                        <input type="text" id="percentage" class="form-control" >
                    </div>
                </div>

                <!-- رفع الصور -->
                <div class="col-lg-6 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="images">رفع الصور</label>
                        <input type="file" name="images[]" id="images" class="form-control" multiple required>
                    </div>
                </div>

                <!-- رفع PDF -->
                <div class="col-lg-6 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="pdf">رفع PDF</label>
                        <input type="file" name="pdf" id="pdf" class="form-control" required>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="due_date">تاريخ الاستحقاق</label>
                        <input type="date" name="due_date" id="due_date" class="form-control" required>
                    </div>
                </div>

                <!-- الحالة -->
                <div class="col-lg-6 col-md-6 mb-3">
                    <div class="form-group">
                        <label for="state">الحالة</label>
                        <select name="state" id="state" class="form-control" required>
                            <option value="finalized">نهائي</option>
                        </select>
                    </div>
                </div>



            </div>

            <!-- زر الإرسال -->
            <div class="row">
                <div class="col-12 text-center">
                    <button type="submit" class="btn button_Green">إرسال</button>
                </div>
            </div>
        </form>
    </div>



@endsection
@section('script')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const priceInput = document.getElementById('price');
            const priceAfterDiscountInput = document.getElementById('price_after_discount');
            const discountPercentageInput = document.getElementById('discount_percentage');

            const installmentAmountInput = document.getElementById('installment_amount');
            const percentageInput = document.getElementById('percentage');

            // حساب نسبة الخصم تلقائياً بناء على السعر والسعر بعد الخصم
            function calculateDiscountPercentage() {
                const price = parseFloat(priceInput.value) || 0;
                const priceAfterDiscount = parseFloat(priceAfterDiscountInput.value) || 0;

                if (price > 0 && priceAfterDiscount >= 0) {
                    const discountPercentage = ((price - priceAfterDiscount) / price) * 100;
                    discountPercentageInput.value = discountPercentage.toFixed(2) + ' %';
                } else {
                    discountPercentageInput.value = '0 %';
                }
            }

            // إذا غيّر المستخدم نسبة الخصم يدويًا، نحدث السعر بعد الخصم
            function updatePriceAfterDiscount() {
                const price = parseFloat(priceInput.value) || 0;
                const discountText = discountPercentageInput.value.replace('%', '').trim();
                const discount = parseFloat(discountText) || 0;

                if (price > 0 && discount >= 0) {
                    const discountedPrice = price - (price * discount / 100);
                    priceAfterDiscountInput.value = discountedPrice.toFixed(2);
                    calculateInstallment(); // تحديث القسط بناءً على السعر الجديد
                }
            }

            // حساب الدفعة الأولى بناءً على السعر بعد الخصم
            function calculateInstallment() {
                const priceAfterDiscount = parseFloat(priceAfterDiscountInput.value) || 0;

                if (priceAfterDiscount > 0) {
                    const defaultInstallment = (priceAfterDiscount * 30) / 100;
                    installmentAmountInput.value = defaultInstallment.toFixed(2);
                    calculateInstallmentPercentage();
                } else {
                    installmentAmountInput.value = '';
                    percentageInput.value = '0 %';
                }
            }

            // حساب النسبة المئوية للقسط
            function calculateInstallmentPercentage() {
                const priceAfterDiscount = parseFloat(priceAfterDiscountInput.value) || 0;
                const installmentAmount = parseFloat(installmentAmountInput.value) || 0;

                if (priceAfterDiscount > 0 && installmentAmount > 0) {
                    const percentage = (installmentAmount / priceAfterDiscount) * 100;
                    if (percentage > 50) {
                        alert('مبلغ القسط لا يمكن أن يتجاوز 50% من السعر بعد الخصم.');
                        installmentAmountInput.value = '';
                        percentageInput.value = '';
                    } else {
                        percentageInput.value = percentage.toFixed(2) + ' %';
                    }
                } else {
                    percentageInput.value = '0 %';
                }
            }

            // إذا عدل المستخدم "نسبة القسط"، نحسب مبلغ القسط تلقائياً
            function updateInstallmentAmount() {
                const priceAfterDiscount = parseFloat(priceAfterDiscountInput.value) || 0;
                const percentText = percentageInput.value.replace('%', '').trim();
                const percent = parseFloat(percentText) || 0;

                if (priceAfterDiscount > 0 && percent >= 0) {
                    const amount = (priceAfterDiscount * percent) / 100;
                    if (percent > 50) {
                        alert('النسبة لا يمكن أن تتجاوز 50% من السعر بعد الخصم.');
                        percentageInput.value = '';
                        installmentAmountInput.value = '';
                    } else {
                        installmentAmountInput.value = amount.toFixed(2);
                    }
                }
            }

            // الأحداث
            priceInput.addEventListener('input', calculateDiscountPercentage);
            priceAfterDiscountInput.addEventListener('input', () => {
                calculateDiscountPercentage();
                calculateInstallment(); // لما يتغير السعر بعد الخصم، نحدث القسط
            });

            discountPercentageInput.addEventListener('input', updatePriceAfterDiscount);

            installmentAmountInput.addEventListener('input', calculateInstallmentPercentage);
            percentageInput.addEventListener('input', updateInstallmentAmount);
        });
    </script>

@endsection
