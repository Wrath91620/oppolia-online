<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{asset('Frontend/assets/images/favicon-32x32.png')}}" type="image/png" />
    <!--plugins-->
    <link href="{{asset('Frontend/assets/plugins/OwlCarousel/css/owl.carousel.min.css')}}" rel="stylesheet" />

    <link href="{{asset('Frontend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{asset('Frontend/assets/css/pace.min.css')}}" rel="stylesheet" />
    <script src="{{asset('Frontend/assets/js/pace.min.js')}}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{asset('Frontend/assets/css/bootstrap.min.css')}}" rel="stylesheet">
   <!-- <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"> -->
    <link href="{{ asset('Frontend/assets/css/app.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('Frontend/assets/css/my-css.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('Frontend/assets/css/kapp.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <link href="{{asset('Frontend/assets/css/icons.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/tajawal" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Sans:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
    <title>@yield('title')</title>


    @yield('css')


</head>

 <body>
 <div class="sticky-order-btn">
     @auth
         <a href="{{ route('orders.create') }}" class="btn button_Dark_Green">@lang('home.Order Your Kitchen')</a>
     @endauth

     @guest
         <button class="btn button_Dark_Green" data-bs-toggle="modal" data-bs-target="#phoneModal">@lang('home.Order Your Kitchen')</button>
     @endguest
 </div>

<!--wrapper-->
<!-- مودال إدخال رقم الجوال -->
<!-- مودال إدخال رقم الجوال -->
@include('frontend.includes.modals')
<div class="wrapper">
    <!--start top header wrapper-->
    @include('frontend.includes.header')
    <div  lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    @yield('content')
    </div>
    @include('frontend.includes.footer')




</div>
<!--end wrapper-->

<!-- Bootstrap JS -->
<script src="{{asset('Frontend/assets/js/bootstrap.bundle.min.js')}}"></script>
<!--plugins-->
<script src="{{asset('Frontend/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('Frontend/assets/plugins/OwlCarousel/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('Frontend/assets/plugins/OwlCarousel/js/owl.carousel2.thumbs.min.js')}}"></script>
<script src="{{asset('Frontend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
<!--app JS-->
<script src="{{asset('Frontend/assets/js/app.js')}}"></script>
<script src="{{asset('Frontend/assets/js/index.js')}}"></script>

<script>
    document.getElementById('phoneForm').addEventListener('submit', function (e) {
        e.preventDefault(); // منع إعادة تحميل الصفحة

        const phone = document.getElementById('phone').value; // الحصول على رقم الجوال
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // جلب CSRF Token

        // إرسال الطلب باستخدام Fetch API
        fetch("{{ route('otp.send') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ phone })
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to send OTP');
                }
                return response.json(); // افترض أن الخادم يعيد استجابة JSON
            })
            .then(data => {
                if (data.success) {
                    // إخفاء مودال رقم الجوال
                    const phoneModal = bootstrap.Modal.getInstance(document.getElementById('phoneModal'));
                    phoneModal.hide();

                    // تحديث قيمة رقم الجوال في مودال OTP
                    document.getElementById('otpPhone').value = phone;

                    // إظهار مودال OTP
                    const otpModal = new bootstrap.Modal(document.getElementById('otpModal'));
                    otpModal.show();
                } else {
                    alert(data.message || 'حدث خطأ أثناء إرسال OTP.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('فشل في إرسال الطلب. الرجاء المحاولة لاحقاً.');
            });
    });


</script>
 <script>
     const phoneInput = document.getElementById("phone");
     phoneInput.addEventListener("input", () => {
         if (!phoneInput.value.startsWith("+966")) {
             phoneInput.value = "+966";
         }
     });

 </script>
<script>
    const otpInputs = document.querySelectorAll('.otp-input');
    const otpHiddenInput = document.getElementById('otp');

    otpInputs.forEach((input, index) => {
        input.addEventListener('input', () => {
            // الانتقال للخانة التالية تلقائيًا إذا تم إدخال رقم
            if (input.value && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }

            // جمع القيم في الحقل المخفي
            otpHiddenInput.value = Array.from(otpInputs).map(i => i.value).join('');
        });

        input.addEventListener('keydown', (e) => {
            // الانتقال للخلف عند الضغط على Backspace
            if (e.key === 'Backspace' && !input.value && index > 0) {
                otpInputs[index - 1].focus();
            }
        });
    });
</script>

@yield('script')

 </body>

</html>
