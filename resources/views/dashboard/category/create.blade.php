@extends('layouts.Dashboard.mainlayout')

@section('title', 'إضافة فئة جديدة')

@section('css')
    <!-- تضمين CSS الخاص بـ DataTables -->
@endsection

@section('content')

   <div dir="rtl">
    <h1>إضافة فئة جديدة</h1>

            @if($errors->any())
            <div class="alert alert-danger" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">العنوان (بالإنجليزية)</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="title_ar">العنوان (بالعربية)</label>
            <input type="text" class="form-control" id="title_ar" name="title_ar" required>
        </div>
        <div class="form-group">
            <label for="image">الصورة</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="form-group">
            <label for="status">الحالة</label>
            <select class="form-control" id="status" name="status">
                <option value="active">نشط</option>
                <option value="inactive">غير نشط</option>
            </select>
        </div>
        <div class="form-group">
            <label for="parent_id">الفئة الأساسية (اختياري)</label>
            <select class="form-control" id="parent_id" name="parent_id">
                <option value="">لا يوجد</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn button_Green mt-3">إرسال</button>
    </form>
   </div>
@endsection
