<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-title">
            <h4 class="h4">{!! $title !!}</h4>
        </div>
        {!! isset($header) ? $header : '' !!}
    </div>
    <div class="card-body">
        @isset($searchRoute)
            <div class="card-search float-right mt-3 mb-3">
                <form action="{{ $searchRoute }}" method="GET" class="d-flex position-relative">
                    <input type="text" class="form-control" placeholder="Search" name="s"
                           value="{{ request()->get('s') }}">
                    @if (request()->has('s'))
                        @php
                            $currentLink = $searchRoute;
                            if (request()->has('page')) {
                                $currentLink .= '?page=' . request()->get('page');
                            }
                        @endphp
                        <a href="{{ $currentLink }}" type="button"
                           class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    @endif
                </form>
            </div>
        @endisset
        {!! $body !!}
    </div>
</div>
