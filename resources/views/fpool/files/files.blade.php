@extends('fpool.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            @component('fpool.components.card')
                @slot('title', 'Images')
                @slot('searchRoute', route('admin.file.index'))
                @slot('body')
                    @component('fpool.components.files')
                        @slot('username',true)
                        @slot('files',$files)
                    @endcomponent
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
