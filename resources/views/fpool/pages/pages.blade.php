@extends('fpool.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            @component('fpool.components.card')
                @slot('title',__('page.admin.pages.title'))
                @slot('searchRoute',route('admin.page.index'))
                @slot('header')
                    <div class="card-right">
                        <a href="{{route('admin.page.create')}}" class="btn btn-primary btn-fw btn-lg">
                            <i class="mdi mdi-plus-circle-outline" style="font-size: 16px;"></i>
                            {{__('page.admin.pages.new_page_button')}}
                        </a>
                    </div>
                @endslot
                @slot('body')
                    @unless(count($pages))
                        <h5 class="text-center mt-3">{{__('page.admin.no_record')}}</h5>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>{{__('page.admin.pages.page_title')}}</th>
                                    <th>{{__('page.admin.pages.slug')}}</th>
                                    <th>{{__('page.admin.pages.type')}}</th>
                                    <th>{{__('page.admin.pages.created')}}</th>
                                    <th>{{__('page.admin.pages.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($pages as $page)
                                    <tr>
                                        <td>{{ $page->title }}</td>
                                        <td>{{ $page->slug }}</td>
                                        <td>{{ $page->type }}</td>
                                        <td>{{ $page->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('admin.page.edit', $page->id) }}" class="btn btn-primary social-btn"
                                               style="padding: 6px 10px;" title="{{__('page.admin.pages.edit_page')}}">
                                                <i class="mdi mdi-circle-edit-outline"></i>
                                            </a>
                                            <button class="btn btn-danger social-btn" id="page_delete" style="padding: 6px 10px;"
                                                    title="{{__('page.admin.pages.delete_page')}}" data-id="{{ $page->id }}">
                                                <i class="mdi mdi-delete-outline"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $pages->appends(['s' => request()->get('s')])->links() }}
                        </div>
                    @endunless
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
