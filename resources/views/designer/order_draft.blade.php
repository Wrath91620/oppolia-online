@extends('layouts.designer.mainlayout')

@section('title', 'استبيان الطلب')

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
        <h2>إنشاء مسودة الطلب</h2>
        <form action="{{ route('designer.order_draft.store', $order->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="price">السعر</label>
                <input type="number" name="price" id="price" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="images">تحميل الصور</label>
                <input type="file" name="images[]" id="images" class="form-control" multiple required>
            </div>

            <div class="form-group">
                <label for="pdf">تحميل ملف PDF</label>
                <input type="file" name="pdf" id="pdf" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="state">الحالة</label>
                <select name="state" id="state" class="form-control" required>
                    <option value="draft">مسودة</option>

                </select>
            </div>

            <button type="submit" class="btn button_Green m-2">إرسال</button>
        </form>
    </div>
@endsection
