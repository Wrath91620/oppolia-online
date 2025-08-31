<!-- create_product.blade.php -->

@extends('layouts.Dashboard.mainlayout')

@section('title', 'إدارة المنتج')

@section('css')
    <!-- تضمين CSS الخاص بـ DataTables -->
@endsection

<style>
    .back-button {
        color:black;
        text-decoration: underline;
    }

    .back-button:hover {
        color: rgba(80, 159, 150, 1);
        text-decoration: underline;
    }

    .description-button {
        background: rgba(232, 232, 232, 1) !important;
        font-weight: normal;
    }

    .description-button:hover {
        font-weight: 600;
        transition: font-weight 0.3s ease;
    }

</style>

@section('content')

    <div class="container mt-4" dir="rtl">

        <div class="container mt-4" dir="rtl">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h2 class="fw-bold">إضافة منتج جديد</h2>

                <a href="{{ route('admin.products.index') }}" class="back-button">الرجوع إلى المنتجات</a>
            </div>
        </div>
        @if($errors->any())
            <div class="alert alert-danger" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

    <!-- عرض رسالة النجاح إذا وجدت -->
        @if(session('success'))
            <div class="alert alert-success" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                {{ session('success') }}
            </div>
        @endif
        <div class="card p-4 shadow-sm" >
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- اختيار الفئة -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="category_id" class="form-label"><strong>اختر الفئة المناسبة</strong></label>
                        <select name="category_ids[]" id="category_ids" class="form-control" multiple required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="g-3 row">
                    <div class="col-md-6">
                        <input type="text" name="name_ar" id="name_ar" class="form-control" placeholder="أدخل اسم المنتج بالعربية" required >
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="name" id="name" class="form-control" placeholder="أدخل اسم المنتج بالإنكليزية" required >
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <input type="text" name="sku" id="sku" class="form-control" placeholder="أدخل رمز المنتج (SKU)" required >
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="image" class="form-label">رفع صورة المنتج</label>
                        <input type="file" name="image" id="image" class="form-control" >
                    </div>
                </div>

                <div class="mt-4">
                    <h5 class="fw-bold">الوصف</h5>
                    <div id="descriptions-wrapper">
                        <div class="description-item">
                            <div class="g-3 row">
                                <div class="col-md-6">
                                    <textarea name="descriptions[0][description]" class="form-control" placeholder="الوصف بالإنكليزية" required ></textarea>
                                </div>
                                <div class="col-md-6">
                                    <textarea name="descriptions[0][description_ar]" class="form-control" placeholder="الوصف بالعربية" required ></textarea>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label for="description_images" class="form-label" >رفع صورة</label>
                                    <input type="file" name="descriptions[0][images][]" class="form-control" multiple>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="add-description-btn" class="btn description-button mt-3">+ أضف الأوصاف الأخرى للمنتج</button>
                </div>

                <div class="row justify-content-center mt-4">
                    <div class="col-md-4">
                        <button type="submit" class="btn w-100 button_Green" >أضف المنتج</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let descriptionCount = 1;
        document.getElementById('add-description-btn').addEventListener('click', function() {
            const wrapper = document.getElementById('descriptions-wrapper');
            const newDescription = `
            <div class="description-item">
                <div class="row mt-3" >
                    <div class="col-6">

                        <textarea name="descriptions[${descriptionCount}][description]" class="form-control" required placeholder="الوصف بالإنكليزية"></textarea>
                    </div>


                    <div class="col-6">

                        <textarea name="descriptions[${descriptionCount}][description_ar]" class="form-control" required placeholder="الوصف بالعربية"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="description_images">صور الوصف (يمكن اختيار عدة صور) :</label>
                        <input type="file" name="descriptions[${descriptionCount}][images][]" class="form-control" multiple>
                    </div>
                </div>
            </div>
        `;
            wrapper.insertAdjacentHTML('beforeend', newDescription);
            descriptionCount++;
        });
    </script>
@endsection
