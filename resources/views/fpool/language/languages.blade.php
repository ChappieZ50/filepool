@extends('fpool.layouts.app')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{session()->get('success')}}
        </div>
    @elseif(session()->has('error'))
        <div class="alert alert-danger">
            {{session()->get('error')}}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            @component('fpool.components.card')
                @slot('title',__('page.admin.language.title'))
                @slot('header')
                    <div class="card-right">
                        <a href="{{route('admin.language.create')}}" class="btn btn-primary btn-fw btn-lg">
                            <i class="mdi mdi-plus-circle-outline" style="font-size: 16px;"></i>
                            {{__('page.admin.language.new_language')}}
                        </a>
                    </div>
                @endslot
                @slot('body')
                    @unless(count($languages))
                        <h5 class="text-center mt-3">{{__('page.admin.no_record')}}</h5>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>{{__('page.admin.language.table.name')}}</th>
                                    <th>{{__('page.admin.language.table.shortcode')}}</th>
                                    <th>{{__('page.admin.language.table.active')}}</th>
                                    <th>{{__('page.admin.language.table.created')}}</th>
                                    <th>{{__('page.admin.language.table.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($languages as $language)
                                    <tr>
                                        <td>{{ $language->name }}</td>
                                        <td>{{ $language->shortcode }}</td>
                                        <td>{{ $language->active ? __('page.admin.language.table.active_text') : __('page.admin.language.table.passive_text') }}</td>
                                        <td>{{ $language->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{route('admin.language.edit',$language->id)}}" class="btn btn-primary social-btn" style="padding: 6px 10px;"
                                               title="{{__('page.admin.language.language_edit')}}">
                                                <i class="mdi mdi-circle-edit-outline"></i>
                                            </a>
                                            <button class="btn btn-danger social-btn" id="language_delete" style="padding: 6px 10px;"
                                                    title="{{__('page.admin.language.language_delete')}}" data-id="{{ $language->id }}">
                                                <i class="mdi mdi-delete-outline"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $languages->appends(['s' => request()->get('s')])->links() }}
                        </div>
                    @endunless
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
