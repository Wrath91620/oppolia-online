@extends('layouts.Dashboard.mainlayout')

@section('title', 'تعديل الفئة')

@section('content')
   <div dir="rtl">
    <h1>تعديل الفئة</h1>

            @if($errors->any())
            <div class="alert alert-danger" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">العنوان (بالإنجليزية)</label>
            <input type="text" class="form-control" id="title" name="title" required value="{{ old('title', $category->title) }}">
        </div>
        <div class="form-group">
            <label for="title_ar">العنوان (بالعربية)</label>
            <input type="text" class="form-control" id="title_ar" name="title_ar" required value="{{ old('title_ar', $category->title_ar) }}">
        </div>
        <div class="form-group">
            <label for="image">الصورة</label>
            <input type="file" class="form-control" id="image" name="image">
            @if($category->image)
                <img src="{{ asset('storage/'.$category->image) }}" alt="الصورة الحالية للفئة" width="100px" height="100px">
            @endif
        </div>
        <div class="form-group">
            <label for="status">الحالة</label>
            <select class="form-control" id="status" name="status">
                <option value="active" @if($category->status == 'active') selected @endif>نشط</option>
                <option value="inactive" @if($category->status == 'inactive') selected @endif>غير نشط</option>
            </select>
        </div>
        <div class="form-group">
            <label for="parent_id">الفئة الأساسية (اختياري)</label>
            <select class="form-control" id="parent_id" name="parent_id">
                <option value="">لا يوجد</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $category->parent_id == $cat->id ? 'selected' : '' }}>{{ $cat->title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn button_Green mt-3">تحديث</button>
    </form>
   </div>
@endsection
