<div class="fpool-user-container col-xl-10 col-lg-10 col-md-12 col-sm-12">
    <div class="fpool-user">
        <h2 class="fpool-sidebar-title">Statistics</h2>
        <hr>
        <div class="fpool-user-content">
            <div class="col-12 fpool-stats">
                <h5>Monthly Uploads</h5>
                <div id="file_chart"></div>
            </div>
        </div>
    </div>
</div>

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/apexcharts/apexcharts.css') }}">
@append

@section('scripts')
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        window.file_chart = @json($file_chart_data);
    </script>
@append
