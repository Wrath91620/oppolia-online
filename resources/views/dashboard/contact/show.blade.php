@extends('layouts.Dashboard.mainlayout')

@section('title', 'تفاصيل رسالة اتصل بنا')

@section('content')
    <div class="container mt-5" dir="rtl">
        <h2 class="mb-4">تفاصيل رسالة اتصل بنا</h2>

        <div class="card p-4">
            <div class="mb-3">
                <strong>الاسم الكامل:</strong>
                <p>{{ $contact->name }}</p>
            </div>

            <div class="mb-3">
                <strong>البريد الإلكتروني:</strong>
                <p>{{ $contact->email }}</p>
            </div>

            <div class="mb-3">
                <strong>رقم الهاتف:</strong>
                <p>{{ $contact->phone ?? '-' }}</p>
            </div>

            <div class="mb-3">
                <strong>المدينة:</strong>
                <p>{{ $contact->subRegion->name_ar ?? '-' }}</p>
            </div>

            <div class="mb-3">
                <strong>نص الرسالة:</strong>
                <div class="alert alert-light border" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                    {{ $contact->message }}
                </div>
            </div>

            <div class="mb-3">
                <strong>تاريخ الإرسال:</strong>
                <p>{{ $contact->created_at->format('Y-m-d H:i') }}</p>
            </div>

            <div class="mt-4 text-end">
                <a href="{{ route('dashboard.contact_us.index') }}" class="btn btn-secondary">رجوع</a>

                <form action="{{ route('dashboard.contact_us.delete', $contact->id) }}" method="POST" class="d-inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذه الرسالة؟')">حذف</button>
                </form>
            </div>
        </div>
    </div>
@endsection
