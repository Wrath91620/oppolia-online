@extends('layouts.designer.mainlayout')

@section('title', 'صفحة الاشغارات')

@section('css')
    <!-- هنا يمكنك تضمين أنماط CSS الخاصة بـ DataTables إذا كان لديك -->

    <style>
        .bg-light-blue {
            background-color: #e7f3ff; /* لون أزرق فاتح */
        }
        .bg-light-gray {
            background-color: #f3f3f3; /* لون رمادي فاتح */
        }
        .hidden {
            display: none !important;
        }

    </style>
@endsection

@section('content')


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

    <section class="section dashboard">
        <h2 class="mb-4">الاشعارات</h2>
        <div class="row">
            <div class="col-9">
                <button id="hideBlueButton" class="btn designer-notifications-read  mb-3">مقروء</button>
                <button id="hideGrayButton" class="btn designer-notifications-unread  mb-3">غير مقروء</button>
                <button id="showAllButton" class="btn designer-notifications-all mb-3">عرض الكل</button>
            </div>
            <div class="col-3">
                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    حذف كل الإشعارات المقروءة
                </button>
            </div>

        </div>

            <div class="row">

                <!-- إشعارات المصمم -->
                <div class="col-lg-12">

                    <div class="card-body">


                        @if($notifications1->count() > 0)
                            <ul class="list-group">
                                @foreach($notifications1 as $notification)
                                    <li class="list-group-item d-flex justify-content-between align-items-center @if(is_null($notification->read_at)) bg-light-blue @else bg-light-gray @endif">
                                        <div>
                                            <strong>{{ $notification->data['message'] }}</strong> - {{ $notification->created_at->diffForHumans() }}
                                            <a href="{{ route('designer.order.show', ['order' => $notification->data['order_id'], 'notificationId' => $notification->id]) }}">
                                                <i class="bi bi-exclamation-circle text-warning"></i>
                                                <div>
                                                    <p>Order ID: {{ $notification->data['order_id'] }}</p>
                                                </div>
                                            </a>
                                        </div>
                                        <div>
                                            @if(is_null($notification->read_at))
                                                <span class="badge bg-primary rounded-pill">جديد</span>
                                            @else
                                                <button class="btn btn-danger btn-sm delete-notification" data-id="{{ $notification->id }}">حذف</button>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No notifications available.</p>
                        @endif
                    </div>
                </div>
            </div><!-- End Notifications Section -->

        </div>
    </section>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف جميع الإشعارات المقروءة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    هل تريد حذف جميع الإشعارات المقروءة؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                    <form action="{{ route('delete.allReadnotification') }}" method="POST">
                        @csrf
                        @method('post')
                        <button type="submit" class="btn btn-danger">نعم، حذف الكل</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const hideBlueButton = document.getElementById('hideBlueButton');
            const hideGrayButton = document.getElementById('hideGrayButton');
            const showAllButton = document.getElementById('showAllButton');

            // إخفاء العناصر ذات الكلاس bg-light-blue وإظهار bg-light-gray
            if (hideBlueButton) {
                hideBlueButton.addEventListener('click', function () {
                    const blueElements = document.getElementsByClassName('bg-light-blue');
                    const grayElements = document.getElementsByClassName('bg-light-gray');

                    // إخفاء العناصر الزرقاء
                    Array.from(blueElements).forEach(function (element) {
                        element.classList.add('hidden');
                    });

                    // إظهار العناصر الرمادية
                    Array.from(grayElements).forEach(function (element) {
                        element.classList.remove('hidden');
                    });
                });
            }

            // إخفاء العناصر ذات الكلاس bg-light-gray وإظهار bg-light-blue
            if (hideGrayButton) {
                hideGrayButton.addEventListener('click', function () {
                    const grayElements = document.getElementsByClassName('bg-light-gray');
                    const blueElements = document.getElementsByClassName('bg-light-blue');

                    // إخفاء العناصر الرمادية
                    Array.from(grayElements).forEach(function (element) {
                        element.classList.add('hidden');
                    });

                    // إظهار العناصر الزرقاء
                    Array.from(blueElements).forEach(function (element) {
                        element.classList.remove('hidden');
                    });
                });
            }

            // عرض جميع العناصر
            if (showAllButton) {
                showAllButton.addEventListener('click', function () {
                    const allElements = document.querySelectorAll('.list-group-item');
                    Array.from(allElements).forEach(function (element) {
                        element.classList.remove('hidden'); // إزالة كلاس الإخفاء
                    });
                });
            } });
    </script>


    <script>
        const deleteButtons = document.querySelectorAll('.delete-notification');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const notificationId = this.getAttribute('data-id');
                fetch(`/notifications/${notificationId}`, {
                    method: 'delete',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                })
                    .then(response => {
                        if (response.ok) {
                            this.closest('li').remove();
                        } else {
                            alert('Failed to delete notification. Please try again.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });



    </script>
@endsection
