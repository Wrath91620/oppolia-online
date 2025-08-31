@extends('layouts.Frontend.mainlayoutfrontend')
@section('title', __('order.title'))
@section('content')

    <style>
        .custom-table th,
        .custom-table td {
            font-size: 18px;
        }

        .btn-details {
            font-size: 16px;
            padding: 8px 16px;
        }

        @media (max-width: 767.98px) {
            .responsive-table thead {
                display: none;
            }

            .responsive-table tbody tr {
                display: block;
                margin-bottom: 1rem;
                border-radius: 0.25rem;
                background: white;
            }

            .responsive-table tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.75rem;
                color: #676767 !important;
                border-bottom: 0px solid #dee2e6;
                font-size: 14px !important;
            }

            .responsive-table tbody td:before {
                content: attr(data-label);
                font-weight: 600;
                margin-right: 1rem;
                color: #333;
                flex-basis: 40%;
                font-size: 14px;
            }

            .btn-details {
                font-size: 14px !important;
                padding: 6px 12px;
            }

            .custom-rounded {
                background-color: #f2f2f2;
            }
        }
    </style>

    <div class="">
                        @if (session('success'))
                    <div class="alert alert-success" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">{{ session('error') }}</div>
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

        <div class="card m-md-5 p-4">
            <h1 class="my-orders-title-border-b">{{ __('order.title') }}</h1>

            @if($orders->isEmpty())
                <p class="mt-4">{{ __('order.no_orders') }}</p>
            @else
                <div class="mt-5 table-responsive">
                    <table class="table table-striped custom-rounded responsive-table custom-table">
                        <thead class="d-md-table-header-group">
                        <tr>
                            <th>{{ __('order.order_number') }}</th>
                            <th>{{ __('order.order_status') }}</th>
                            <th>{{ __('order.time_range') }}</th>
                            <th>{{ __('order.expected_cost') }}</th>
                            <th>{{ __('order.date') }}</th>
                            <th>{{ __('order.view_order') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td data-label="{{ __('order.order_number') }}">{{ $order->id }}</td>
                                <td data-label="{{ __('order.order_status') }}">
                                    {{ __('order.processing_stages.' . $order->processing_stage, [], app()->getLocale()) }}
                                </td>
                                <td data-label="{{ __('order.time_range') }}">
                                    {{ __('order.time_ranges.' . $order->time_range, [], app()->getLocale()) }}
                                </td>
                                <td data-label="{{ __('order.expected_cost') }}">{{ $order->expected_cost }}</td>
                                <td data-label="{{ __('order.date') }}">{{ $order->created_at->format('Y-m-d') }}</td>
                                <td data-label="{{ __('order.view_order') }}">
                                    <a href="{{ route('order.show', $order->id) }}" class="btn button_Dark_Green">
                                        {{ __('order.details') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
