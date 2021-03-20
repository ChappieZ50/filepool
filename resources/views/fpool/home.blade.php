@extends('fpool.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card card-statistics">
                <div class="row">
                    <div class="card-col col-xl-3 col-lg-3 col-md-3 col-6">
                        <div class="card-body p-0">
                            <div class="d-flex align-items-center justify-content-center flex-column flex-sm-row p-4">
                                <i class="mdi mdi-cloud-upload-outline text-primary mr-0 mr-sm-4 icon-lg"></i>
                                <div class="wrapper text-center text-sm-left">
                                    <p class="card-text mb-0">Uploaded Files</p>
                                    <div class="fluid-container">
                                        <h3 class="mb-0 font-weight-medium">{{ $filesCount }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-col col-xl-3 col-lg-3 col-md-3 col-6">
                        <div class="card-body p-0">
                            <div class="d-flex align-items-center justify-content-center flex-column flex-sm-row p-4">
                                <i class="mdi mdi-account-multiple-outline text-primary mr-0 mr-sm-4 icon-lg"></i>
                                <div class="wrapper text-center text-sm-left">
                                    <p class="card-text mb-0">Users</p>
                                    <div class="fluid-container">
                                        <h3 class="mb-0 font-weight-medium">{{ $usersCount }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-col col-xl-3 col-lg-3 col-md-3 col-6">
                        <div class="card-body p-0">
                            <div class="d-flex align-items-center justify-content-center flex-column flex-sm-row p-4">
                                <i class="mdi mdi-message-outline text-primary mr-0 mr-sm-4 icon-lg"></i>
                                <div class="wrapper text-center text-sm-left">
                                    <p class="card-text mb-0">Messages</p>
                                    <div class="fluid-container">
                                        <h3 class="mb-0 font-weight-medium">{{ $messagesCount }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-col col-xl-3 col-lg-3 col-md-3 col-6">
                        <div class="card-body p-0">
                            <div class="d-flex align-items-center justify-content-center flex-column flex-sm-row p-4">
                                <i class="mdi mdi-file-document-outline text-primary mr-0 mr-sm-4 icon-lg"></i>
                                <div class="wrapper text-center text-sm-left">
                                    <p class="card-text mb-0">Pages</p>
                                    <div class="fluid-container">
                                        <h3 class="mb-0 font-weight-medium">{{ $pagesCount }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row col-12">
            @component('fpool.components.charts.file-chart')
                @slot('files', $files)
            @endcomponent
        </div>
        <div class="row col-12">
            @component('fpool.components.charts.user-chart')
                @slot('users', $users)
            @endcomponent
        </div>
        <div class="row col-12">
            @component('fpool.components.charts.user-status-chart')

            @endcomponent

            @component('fpool.components.charts.user-login-chart')

            @endcomponent
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/apexcharts/apexcharts.css') }}">
@append

@section('scripts')
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        window.file_chart = @json($chart_file_data);
        window.user_chart = @json($chart_user_data);
        window.user_status_chart = @json($chart_user_status_data);
        window.file_extension_chart = @json($chart_file_extension_data);
        window.user_login_chart = @json($chart_user_login_data);
    </script>
@append
