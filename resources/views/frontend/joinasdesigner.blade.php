@extends('layouts.Frontend.mainlayoutfrontend')
@section('title') @lang('joinasdesigner.title') @endsection
@section('content')

    <style>
        .designer-form-wrapper {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }
        .form-label {
            font-weight: bold;
            color: #0A4740;
        }
        .form-control {
            border-radius: 6px;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #ffffff;
        }
        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg viewBox='0 0 140 140' xmlns='http://www.w3.org/2000/svg'%3E%3Cpolygon points='0,0 140,0 70,80' fill='%23509f96'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: left 10px center;
            background-size: 12px;
            padding-left: 30px;
            cursor: pointer;
        }
        .btn-primary {
            background-color: #509f96;
            border: none;
            padding: 12px 30px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0A4740;
        }
        .alert {
            margin-top: 15px;
            text-align: center;
        }
    </style>

    <div class="container-fluid about-section position-relative">
        <div class="row">
            <div class="col-12 p-0">
                <img src="{{ asset('Frontend/assets/images/banners/About-Banner.png') }}" alt="About Us Banner" class="img-fluid about-image">
            </div>
        </div>
        <div class="about-text-overlay">
            <h1 class="about-text">@lang('joinasdesigner.title')</h1>
        </div>
    </div>

    <div class="container p-4" >
        @if(session('success'))
            <div class="alert alert-success" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">@lang('joinasdesigner.success')</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">@lang('joinasdesigner.error')</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="designer-form-wrapper mb-4 ">
            <form action="{{ route('joinasdesigner.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">@lang('joinasdesigner.name')</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">@lang('joinasdesigner.country')</label>
                        <input type="text" name="country" class="form-control" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">@lang('joinasdesigner.email_address')</label>
                        <input type="email" name="email_address" class="form-control" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">@lang('joinasdesigner.phone_number')</label>
                        <input type="text" name="phone_number" class="form-control" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">@lang('joinasdesigner.age')</label>
                        <input type="number" name="age" class="form-control" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">@lang('joinasdesigner.nationality')</label>
                        <input type="text" name="nationality" class="form-control" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">@lang('joinasdesigner.gender')</label>
                        <select name="gender" class="form-control" required>
                            <option value="male">@lang('joinasdesigner.male')</option>
                            <option value="female">@lang('joinasdesigner.female')</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">@lang('joinasdesigner.marital_status')</label>
                        <select name="marital_status" class="form-control" required>
                            <option value="single">@lang('joinasdesigner.single')</option>
                            <option value="married">@lang('joinasdesigner.married')</option>
                            <option value="other">@lang('joinasdesigner.other')</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">@lang('joinasdesigner.region')</label>
                        <select name="region_id" class="form-control" required>
                            <option value="" disabled selected>@lang('joinasdesigner.choose_region')</option>
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}">{{ app()->getLocale() === 'ar' ? $region->name_ar : $region->name_en }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">@lang('joinasdesigner.major_in_education')</label>
                        <input type="text" name="major_in_education" class="form-control" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">@lang('joinasdesigner.years_of_experience')</label>
                        <input type="number" name="years_of_experience" class="form-control" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">@lang('joinasdesigner.experience_in_sales')</label>
                        <select name="experience_in_sales" class="form-control" required>
                            <option value="1">@lang('joinasdesigner.yes')</option>
                            <option value="0">@lang('joinasdesigner.no')</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">@lang('joinasdesigner.current_occupation')</label>
                        <input type="text" name="current_occupation" class="form-control" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">@lang('joinasdesigner.willing_to_work_as_freelancer')</label>
                        <select name="willing_to_work_as_freelancer" class="form-control" required>
                            <option value="1">@lang('joinasdesigner.yes')</option>
                            <option value="0">@lang('joinasdesigner.no')</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">@lang('joinasdesigner.own_car')</label>
                        <select name="own_car" class="form-control" required>
                            <option value="1">@lang('joinasdesigner.yes')</option>
                            <option value="0">@lang('joinasdesigner.no')</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">@lang('joinasdesigner.experience_in_kitchen_furniture_business')</label>
                        <select name="experience_in_kitchen_furniture_business" class="form-control" required>
                            <option value="1">@lang('joinasdesigner.yes')</option>
                            <option value="0">@lang('joinasdesigner.no')</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">@lang('joinasdesigner.kitchen_furniture_experience_description')</label>
                        <textarea name="kitchen_furniture_experience_description" class="form-control"></textarea>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">@lang('joinasdesigner.cv_pdf')</label>
                        <input type="file" name="cv_pdf" class="form-control" required>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">@lang('joinasdesigner.submit')</button>
                </div>
            </form>
        </div>
    </div>

@endsection
