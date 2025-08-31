@extends('layouts.Frontend.mainlayoutfrontend')
@section('title', __('edit_profile.title'))
@section('css')
    <style>
        .edit-profile-container {
            background: #f8f9fa;
            border-radius: 16px;
            padding: 2.5rem;
            margin: 2rem 0;
            border: 1px solid #e9ecef;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        
        .edit-profile-title {
            color: #0A4740;
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            animation: titleSlideIn 0.8s ease-out;
        }
        
        @keyframes titleSlideIn {
            0% {
                opacity: 0;
                transform: translateY(-30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .edit-profile-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 120px;
            height: 3px;
            background: linear-gradient(90deg, #0A4740, #509F96);
            border-radius: 2px;
            animation: underlineExpand 1s ease-out 0.3s both;
        }
        
        @keyframes underlineExpand {
            0% {
                width: 0;
                opacity: 0;
            }
            100% {
                width: 120px;
                opacity: 1;
            }
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            color: #495057;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.75rem;
            display: block;
        }
        
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 14px 18px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: white;
        }
        
        .form-control:focus {
            border-color: #0A4740;
            box-shadow: 0 0 0 0.2rem rgba(10, 71, 64, 0.15);
            outline: none;
        }
        
        .input-group {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            overflow: hidden;
        }
        
        .input-group-text {
            background: #0A4740;
            color: white;
            border: none;
            border-radius: 0;
            font-weight: 600;
            padding: 14px 16px;
        }
        
        .input-group .form-control {
            border: none;
            border-radius: 0;
            background: white;
        }
        
        .input-group .form-control:focus {
            border: none;
            box-shadow: none;
        }
        
        .input-group:focus-within {
            border-color: #0A4740;
            box-shadow: 0 0 0 0.2rem rgba(10, 71, 64, 0.15);
        }
        
        .btn-update {
            background: linear-gradient(135deg, #0A4740, #509F96);
            color: white;
            border: none;
            padding: 14px 32px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(10, 71, 64, 0.2);
        }
        
        .btn-update:hover {
            background: linear-gradient(135deg, #083a35, #0A4740);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(10, 71, 64, 0.3);
        }
        
        .alert {
            border-radius: 10px;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            font-weight: 500;
        }
        
        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
            border-left: 4px solid #28a745;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
            border-left: 4px solid #dc3545;
        }
        
        .alert ul {
            margin: 0.5rem 0 0 0;
            padding-left: 1.5rem;
        }
        
        .alert li {
            margin-bottom: 0.25rem;
        }
        
        @media (max-width: 768px) {
            .edit-profile-container {
                padding: 1.5rem;
                margin: 1rem 0;
            }
            
            .edit-profile-title {
                font-size: 1.5rem;
            }
            
            .form-control {
                padding: 12px 16px;
            }
            
            .btn-update {
                width: 100%;
                padding: 12px 24px;
            }
        }
        
        /* Remove button border */
        button.Dark_Green {
            border: none !important;
            background: none !important;
            padding: 0 !important;
        }
    </style>
@endsection
@section('content')

    @if(session('success'))
        <div class="alert alert-success" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">{{ __('edit_profile.success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
            <ul class="mb-0">
                <strong>{{ __('edit_profile.errors_header') }}</strong>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="edit-profile-container">
                    <h1 class="edit-profile-title">{{ __('edit_profile.update_personal_info') }}</h1>
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label class="form-label">{{ __('edit_profile.name') }}</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" placeholder="{{ app()->getLocale() == 'ar' ? 'أدخل اسمك الكامل' : 'Enter your full name' }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{ __('edit_profile.email') }}</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" placeholder="{{ app()->getLocale() == 'ar' ? 'أدخل بريدك الإلكتروني' : 'Enter your email address' }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{ __('edit_profile.phone') }}</label>
                            <div class="input-group" dir="ltr">
                                <span class="input-group-text">{{ __('edit_profile.phone_prefix') }}</span>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="phone_display"
                                    value="{{ old('phone', ltrim($user->phone, '+966')) }}"
                                    required
                                    title="{{ __('edit_profile.phone_title') }}"
                                    placeholder="{{ app()->getLocale() == 'ar' ? 'أدخل رقم الجوال' : 'Enter phone number' }}"
                                >
                            </div>
                        </div>
                        <input type="hidden" name="phone" id="phone_hidden">

                        <div class="text-end">
                            <button type="submit" class="Dark_Green chevron-hover d-flex align-items-center gap-2"><i class="bi bi-chevron-right"></i>{{ __('edit_profile.update_button') }} </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const displayInput = document.getElementById("phone_display");
            const hiddenInput = document.getElementById("phone_hidden");

            const form = displayInput.closest("form");

            form.addEventListener("submit", function () {
                const phoneNumber = displayInput.value.trim();
                hiddenInput.value = '+966' + phoneNumber;
            });
        });
    </script>
@endsection
