@extends('layouts.app')

@section('site_title',' — '.$page->title)

@section('content')
    <div class="page-container container">
        @if($page->type === 'contact')
            @component('components.page.contact')
                @slot('page',$page)
            @endcomponent
        @else
            {!! $page->content !!}
        @endif
    </div>
@endsection
