@extends('layouts.Dashboard.mainlayout')

@section('title', 'إدارة الفئات')

@section('css')
    <!-- هنا يمكنك تضمين أنماط CSS الخاصة بـ DataTables إذا كان لديك -->
    <link href="{{ asset('path/to/datatables.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div  dir="rtl">
        <h1>الفئات</h1>
        @if(session('success'))
            <div class="alert alert-success" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <a href="{{ route('admin.categories.create') }}" class="btn button_Green" >إضافة فئة جديدة</a>

        <div class="container mt-3">
            <div style="overflow-x: auto; width: 100%;">
            <table class="table table datatable" style="min-width: 800px;">
                <thead>
                <tr>
                    <th>المعرف</th>
                    <th>العنوان</th>
                    <th>العنوان بالعربية</th>
                    <th>الفئة الأساسية</th> <!-- عمود جديد للفئة الأساسية -->
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->title_ar }}</td>
                        <td>{{ $category->parent ? $category->parent->title : 'لايوجد' }}</td> <!-- عرض الفئة الأساسية -->
                        <td>{{ $category->status }}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-info border-0 bg-transparent">
                                <button type="submit" class="border-0 bg-transparent text-danger">
                                    <img src="{{ asset('Dashboard/assets/images/edit.png') }}">
                                </button>
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger bg-transparent border-0" onclick="return confirm('هل أنت متأكد؟')">
                                    <img src="{{ asset('Dashboard/assets/images/delete.png') }}">
                                </button>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        </div>

    </div>
@endsection

