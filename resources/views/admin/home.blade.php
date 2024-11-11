@extends('admin.layout.app')
@section('title', trans('app.dashboard'))
@push('styles')

@endpush
@section('content')
    <div class="container-fluid dashboard">
        <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap">
                    <h2 class="title-1">{{ trans('app.overview') }} , Hi {{auth('web')->user()->first_name}}</h2>

                </div>
            </div>
        </div>
        <div class="row m-t-25">
            <div class="col-sm-6 col-lg-3">
                <div class="overview-item overview-item--c1">
                    <div class="overview__inner">
                        <div class="overview-box clearfix">
                            <div class="icon">
                                <i class="zmdi zmdi-account-o"></i>
                            </div>
                            <div class="text">
                                <h2>{{ $data['admins_count'] }}</h2>
                                <span>{{ trans('app.admins_count') }}</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="overview-item overview-item--c2">
                    <div class="overview__inner">
                        <div class="overview-box clearfix">
                            <div class="icon">
                                <i class="zmdi zmdi-account-o"></i>
                            </div>
                            <div class="text">
                                <h2>{{ $data['products_count'] }}</h2>
                                <span>{{ trans('app.products_count') }}</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="overview-item overview-item--c3">
                    <div class="overview__inner">
                        <div class="overview-box clearfix">
                            <div class="icon">
                                <i class="zmdi zmdi-account-o"></i>
                            </div>
                            <div class="text">
                                <h2>{{ $data['products_quantity'] }}</h2>
                                <span>{{ trans('app.products_quantity') }}</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
