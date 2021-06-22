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
                @slot('title',isset($language) ? __('page.admin.language.edit.title') : __('page.admin.language.create.title'))
                @slot('body')
                    <form action="{{isset($language) ? route('admin.language.update',$language->id) : route('admin.language.store')}}" method="POST">
                        @isset($language) @method('PUT') @endisset
                        @csrf
                        <div class="col-xl-6  col-lg-12 mt-5 mx-auto">
                            <div class="form-group">
                                <label for="language_name">{{__('page.admin.language.form.name')}}</label>
                                <input type="text" class="form-control" id="language_name" name="name" value="{{isset($language) ? $language->name : old('name')}}">
                                @error('name')
                                <span class="invalid-feedback d-block mt-1 ml-2" role="alert">
                                   <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="language_shortcode">{{__('page.admin.language.form.shortcode')}}</label>
                                <input type="text" class="form-control" id="language_shortcode" name="shortcode"
                                       value="{{isset($language) ? $language->shortcode : old('shortcode')}}">
                                @error('shortcode')
                                <span class="invalid-feedback d-block mt-1 ml-2" role="alert">
                                   <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="form-check form-check-flat">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="active" id="active" {{isset($language) ? ($language->active ? 'checked' : '') : ''}}>
                                        {{__('page.admin.language.form.active')}}
                                    </label>
                                </div>
                                @error('active')
                                <span class="invalid-feedback d-block mt-1 ml-2" role="alert">
                                   <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <button type="submit"
                                    class="btn btn-primary btn-lg float-right">{{isset($language) ? __('page.admin.language.edit.button') : __('page.admin.language.create.button')}}</button>
                        </div>
                    </form>
                <div class="clearfix"></div>
                    @isset($language)
                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <textarea class="form-control" name="content" id="language_editor"></textarea>
                            </div>
                        </div>
                        <button type="button"
                                class="btn btn-primary btn-lg float-right" id="save_editor">{{__('page.admin.language.edit.editor_button')}}</button>

                    @endisset
                @endslot
            @endcomponent
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('fpool/assets/plugins/trumbowyg/trumbowyg.js')}}"></script>
    <script>
        $('#language_editor').trumbowyg({
            btns: [],
        });
    </script>
@append

@section('styles')
    <link rel="stylesheet" href="{{asset('fpool/assets/plugins/trumbowyg/ui/trumbowyg.css')}}">
    <style>
        .trumbowyg-box,
        .trumbowyg-editor {
            min-height: 800px;
        }
    </style>
@append
