@extends('layouts.Dashboard.mainlayout')

@section('title', 'إدارة المستخدمين')

@section('css')
    <!-- تضمين CSS الخاص بـ DataTables -->
@endsection

@section('content')
            @if (session('success'))
            <div class="alert alert-success" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">{{ session('success') }}</div>
        @endif

    @if (session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif
    <div class="container" dir="rtl">
        <h1>تعديل المصمم</h1>
        <form action="{{ route('designer.storeOrUpdate', $designer->user_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <!-- حقل صورة الملف الشخصي مع عرض الصورة -->
            <div class="row mb-3 align-items-center">
                <div class="col-md-4">
                    <label for="profile_image">صورة الملف الشخصي:</label>
                    <input type="file" name="profile_image" accept="image/*" class="form-control">
                </div>
                <div class="col-md-2">
                    @if ($designer->profile_image)
                        <img src="{{ asset('storage/' . $designer->profile_image) }}" alt="Profile Image" style="width: 100px; height: auto;">
                    @else
                        <p>لا توجد صورة ملف شخصي متاحة</p>
                    @endif
                </div>
            </div>

            <!-- حقل سنوات الخبرة -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="experience_years">سنوات الخبرة:</label>
                    <input type="number" name="experience_years" value="{{ old('experience_years', $designer->experience_years) }}" required class="form-control">
                </div>
            </div>

            <!-- حقل الوصف -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="description">الوصف:</label>
                    <textarea name="description" class="form-control">{{ old('description', $designer->description) }}</textarea>
                </div>
            </div>

            <!-- حقل الوصف بالعربية -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="description_ar">الوصف (بالعربية):</label>
                    <textarea name="description_ar" class="form-control">{{ old('description_ar', $designer->description_ar) }}</textarea>
                </div>
            </div>

            <!-- حقل صور البورتفوليو مع عرض الصور -->
            <div class="row mb-3 align-items-center">
                <div class="col-md-4">
                    <label for="portfolio_images">صور البورتفوليو:</label>
                    <input type="file" name="portfolio_images[]" accept="image/*" multiple class="form-control">
                </div>
                <div class="col-md-8 d-flex flex-wrap">
                    @if ($designer->portfolio_images)
                        @foreach (json_decode($designer->portfolio_images, true) as $image)
                            <div class="p-2">
                                <img src="{{ asset('storage/' . $image) }}" alt="Portfolio Image" style="width: 100px; height: auto;">
                            </div>
                        @endforeach
                    @else
                        <p>لا توجد صور بورتفوليو متاحة</p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                </div>
            </div>
        </form>
    </div>
@endsection
