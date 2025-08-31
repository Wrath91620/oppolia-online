@extends('layouts.designer.mainlayout')

@section('title', 'الطلبات المعتمدة')

@section('css')
    <style>
        .table {
            width: 100%;
            margin-top: 20px;
        }
        .table th, .table td {
            padding: 10px;
            text-align: center;
        }

    </style>
@endsection

@section('content')
    <div class="pagetitle" dir="rtl" >
        <h1 style="color: #0A4740 !important;">الطلبات المعتمدة</h1>
        <nav>
            <ol class="breadcrumb justify-content-end" dir="ltr">
                <li class="breadcrumb-item active">الطلبات المعتمدة</li>
                <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>

            </ol>
        </nav>
    </div><!-- نهاية عنوان الصفحة -->

    <!-- عرض رسائل النجاح أو الفشل -->
    @if(session('success'))
        <div class="alert alert-success" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
            {{ session('error') }}
        </div>
    @endif

    <section class="section dashboard " dir="rtl" >
        <div class="row">

            <!-- عرض الطلبات التي وافق عليها المصمم -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">الطلبات التي قمت بالموافقة عليها</h5>

                        @if($approvedOrders->count() > 0)
                            <div style="overflow-x: auto; width: 100%;">
                            <table class="table table-striped table table-bordered datatable" style="min-width: 800px;">
                                <thead>
                                <tr>
                                    <th>رقم الطلب</th>
                                    <th>اسم المستخدم</th>
                                    <th>رقم الهاتف</th>
                                    <th>مرحلة المعالجة</th>
                                    <th>تاريخ الطلب</th>
                                    <th>الإجراءات</th> <!-- إضافة عمود للإجراءات -->
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($approvedOrders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td dir="ltr">{{ $order->user->phone }}</td> <!-- تأكد من وجود حقل phone_number في جدول المستخدم -->
                                        <td>{{ $order->processing_stage }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>
                                            <!-- زر عرض الطلب -->
                                            <a href="{{ route('designer.order.show_without_notification', ['order' => $order->id]) }}">
                                                <img src="{{ asset('Dashboard\assets\images\view.png') }}"></a>
                                            <!-- زر المعالجة -->
                                            @if($order->processing_stage == 'اكتمل الطلب')
                                                <span>
                                                <img src="{{ asset('Dashboard\assets\images\completedFull.png') }}">
                                                </span>
                                            @else
                                                <a href="{{ route('designer.order.processing', ['order' => $order->id]) }}">
                                                    <img src="{{ asset('Dashboard\assets\images\Union.png') }}"></a>
                                                </a>
                                            @endif




                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>لا توجد طلبات معتمدة.</p>
                        @endif
                            </div>
                    </div>
                </div>
            </div><!-- نهاية قسم الطلبات المعتمدة -->

        </div>
    </section>
@endsection
