@if(!empty($file_chart_data))
    @php($status = false)
    @foreach($file_chart_data as $item)
        @php($status = $item != 0 ? true : false)
        @if($status)
            @break
        @endif
    @endforeach
@endif
<div class="fpool-user-container col-xl-10 col-lg-10 col-md-12 col-sm-12">
    <div class="fpool-user">
        <h2 class="fpool-sidebar-title">{{__('page.website.user.statistics.title')}}</h2>
        <hr>
        <div class="fpool-user-content">
            <div class="col-12 fpool-stats">
                @if($status)
                    <h4 class="text-center">{{__('page.website.user.statistics.uploaded_files')}}</h4>
                    <div id="file_chart"></div>
                    <h4 class="text-center">{{__('page.website.user.statistics.storage_usage')}}</h4>
                    <div id="file_storage_chart"></div>
                @else
                    <div class="empty-statistics">
                        <img src="{{ asset('assets/images/empty-statistics.svg') }}" alt="empty statistics" class="img-fluid">
                        <h5>
                            {{__('page.website.user.statistics.empty')}}
                        </h5>
                        <p>
                            {!! __('page.website.user.files.upload',['here' => '<a href="'.route("home").'">'.__("page.here").'</a>']) !!}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        window.file_chart = @json($file_chart_data);
        window.file_storage_chart_data = @json($file_storage_chart_data);
    </script>
@append
