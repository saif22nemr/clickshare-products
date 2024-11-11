@extends('admin.layout.app')
@section('title', trans('app.dashboard'))
@push('styles')
    
@endpush
@section('content')
    <div class="container-fluid dashboard">
        <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap">
                    <h2 class="title-1">{{ trans('app.overview') }}</h2>

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
                                <h2>{{ $data['managers_count'] }}</h2>
                                <span>{{ trans('app.managers_count') }}</span>
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
                                <h2>{{ $data['employees_count'] }}</h2>
                                <span>{{ trans('app.employees_count') }}</span>
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
                                <h2>{{ $data['tasks_count'] }}</h2>
                                <span>{{ trans('app.tasks_count') }}</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="overview-item overview-item--c4">
                    <div class="overview__inner">
                        <div class="overview-box clearfix">
                            <div class="icon">
                                <i class="zmdi zmdi-money"></i>
                            </div>
                            <div class="text">
                                <h2>${{ number_format($data['salary'] ?? 0) }}</h2>
                                <span>{{ trans('app.salary') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="overview-item overview-item--c1">
                    <div class="overview__inner">
                        <div class="overview-box clearfix">
                            <div class="icon">
                                <i class="zmdi zmdi-folder-person"></i>
                            </div>
                            <div class="text">
                                <h2>{{ $data['tasks_in_progress_count'] }}</h2>
                                <span>{{ trans('app.tasks_in_progress_count') }}</span>
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
                                <i class="zmdi zmdi-folder-person"></i>
                            </div>
                            <div class="text">
                                <h2>{{ $data['tasks_complete_count'] }}</h2>
                                <span>{{ trans('app.tasks_complete_count') }}</span>
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
                                <i class="zmdi zmdi-folder-person"></i>
                            </div>
                            <div class="text">
                                <h2>{{ $data['tasks_canceled_count'] }}</h2>
                                <span>{{ trans('app.tasks_canceled_count') }}</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
