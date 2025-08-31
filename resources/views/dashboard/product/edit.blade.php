@extends('layouts.Dashboard.mainlayout')

@section('title', 'تعديل المنتج')

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

    .remove-description-btn {
        background: #dc3545 !important;
        color: white !important;
        margin-top: 10px;
    }
</style>

@section('content')

    <div class="container mt-4" dir="rtl">

        <div class="container mt-4" dir="rtl">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h2 class="fw-bold">تعديل المنتج</h2>

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

        @if(session('success'))
            <div class="alert alert-success" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                {{ session('success') }}
            </div>
        @endif

        <div class="card p-4 shadow-sm">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- اختيار الفئة -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="category_ids" class="form-label"><strong>اختر الفئة المناسبة</strong></label>
                        <select name="category_ids[]" id="category_ids" class="form-control" multiple required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->categories->contains($category->id) ? 'selected' : '' }}>
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="g-3 row">
                    <div class="col-md-6">
                        <input type="text" name="name_ar" id="name_ar" class="form-control" value="{{ $product->name_ar }}" placeholder="أدخل اسم المنتج بالعربية" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" placeholder="أدخل اسم المنتج بالإنكليزية" required>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <input type="text" name="sku" id="sku" class="form-control" value="{{ $product->sku }}" placeholder="أدخل رمز المنتج (SKU)" required>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="image" class="form-label">رفع صورة المنتج</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @if($product->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="100" class="img-thumbnail">
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-4">
                    <h5 class="fw-bold">الوصف</h5>
                    <div id="descriptions-wrapper">
                        @foreach($product->descriptions as $index => $description)
                            <div class="description-item mb-4">
                                <input type="hidden" name="descriptions[{{ $index }}][id]" value="{{ $description->id }}">

                                <div class="g-3 row">
                                    <div class="col-md-6">
                                        <textarea name="descriptions[{{ $index }}][description]" class="form-control" placeholder="الوصف بالإنكليزية" required>{{ $description->description }}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <textarea name="descriptions[{{ $index }}][description_ar]" class="form-control" placeholder="الوصف بالعربية" required>{{ $description->description_ar }}</textarea>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="form-label">الصور الحالية:</label>
                                        @if($description->images)
                                            <div class="d-flex flex-wrap gap-2 mb-2">
                                                @foreach(json_decode($description->images) as $image)
                                                    <img src="{{ asset('storage/' . $image) }}" alt="Description Image" width="80" class="img-thumbnail">
                                                @endforeach
                                            </div>
                                        @endif
                                        <label for="description_images" class="form-label">رفع صور جديدة</label>
                                        <input type="file" name="descriptions[{{ $index }}][images][]" class="form-control" multiple>
                                    </div>
                                </div>

                                <button type="button" class="btn remove-description-btn mt-2">حذف هذا الوصف</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" id="add-description-btn" class="btn description-button mt-3">+ أضف الأوصاف الأخرى للمنتج</button>
                </div>

                <div class="row justify-content-center mt-4">
                    <div class="col-md-4">
                        <button type="submit" class="btn w-100 button_Green">تحديث المنتج</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let descriptionCount = {{ $product->descriptions->count() }};

        document.getElementById('add-description-btn').addEventListener('click', function() {
            const wrapper = document.getElementById('descriptions-wrapper');
            const newDescription = `
                <div class="description-item mb-4">
                    <div class="g-3 row">
                        <div class="col-md-6">
                            <textarea name="descriptions[${descriptionCount}][description]" class="form-control" required placeholder="الوصف بالإنكليزية"></textarea>
                        </div>
                        <div class="col-md-6">
                            <textarea name="descriptions[${descriptionCount}][description_ar]" class="form-control" required placeholder="الوصف بالعربية"></textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="description_images" class="form-label">رفع صورة</label>
                            <input type="file" name="descriptions[${descriptionCount}][images][]" class="form-control" multiple>
                        </div>
                    </div>
                    <button type="button" class="btn remove-description-btn mt-2">حذف هذا الوصف</button>
                </div>
            `;
            wrapper.insertAdjacentHTML('beforeend', newDescription);
            descriptionCount++;
        });

        // حذف الوصف بشكل ديناميكي
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-description-btn')) {
                event.target.closest('.description-item').remove();
            }
        });
    </script>
@endsection
