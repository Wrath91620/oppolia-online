@extends('layouts.Dashboard.mainlayout')

@section('title', 'إدارة المصممين')

@section('css')
    <!-- هنا يمكنك تضمين أنماط CSS الخاصة بـ DataTables إذا كان لديك -->
    <link href="{{ asset('path/to/datatables.css') }}" rel="stylesheet">
@endsection

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
    <div style="overflow-x: auto; width: 100%;">

    <table class="table datatable" dir="rtl" style="min-width: 800px;">
        <thead>
        <tr>
            <th>الاسم</th>
            <th>البريد الإلكتروني</th>
            <th>الهاتف</th>
            <th>الدور</th>
            <th>الخبرة</th>
            <th>المنطقة</th>
            <th>الإجراء</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($user as $designer)
            <tr>
                <td>{{ $designer->name }}</td>
                <td>{{ $designer->email }}</td>
                <td>{{ $designer->phone ?? 'غير متوفر' }}</td>
                <td>{{ $designer->role }}</td>
                <td>{{ optional($designer->designer)->experience_years }} سنوات</td> <!-- استخدام optional لتجنب أخطاء إذا كان $designer->designer null -->
                <td>{{$designer->region->name_ar}}</td>
                <td>
                    <!-- زر التعديل -->
                    <a href="{{ route('designer.showEditForm', $designer->id) }}" class="btn btn-primary border-0 bg-transparent">
                        <button type="submit" class="border-0 bg-transparent text-danger">
                            <img src="{{ asset('Dashboard/assets/images/edit.png') }}">
                        </button></a>
                    <a href="{{ route('designer.show', $designer->id) }}" class="btn btn-primary  bg-transparent border-0">

                        <button type="submit" class="btn btn-danger bg-transparent border-0">
                            <img src="{{ asset('Dashboard/assets/images/view.png') }}">
                        </button>
                    </a>
                    <!-- زر الحذف -->
                <!--       <form action="{{ route('admin.designers.destroy', $designer->id) }}" method="POST" style="display:inline;">
                        @csrf
                @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من أنك تريد حذف هذا المستخدم؟')">حذف</button>
-->
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
@endsection

