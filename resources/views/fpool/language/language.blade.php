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
                        <ul class="nav nav-tabs">
                            @forelse($files as $file)
                                <li class="nav-item">
                                    <a class="nav-link {{$loop->first ? 'active' : ''}}" data-toggle="tab"
                                       href="#{{basename($file->getFilename(),'.php')}}">{{basename($file->getFilename(),'.php')}}</a>
                                </li>
                            @empty
                            @endforelse
                        </ul>
                        <div class="tab-content">
                            @forelse($files as $file)
                                <div id="{{basename($file->getFilename(),'.php')}}" class="tab-pane {{$loop->first ? 'active' : 'fade'}}"><br>
                                    <div class="col-12 mt-3">
                                        <div class="form-group">
                                            <textarea class="form-control" name="{{basename($file->getFilename(),'.php')}}"
                                                      id="editor_{{basename($file->getFilename(),'.php')}}">{!! clear_file_content(\Illuminate\Support\Facades\File::get($file->getPathname())) !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>

                        <button type="button"
                                class="btn btn-primary btn-lg float-right" id="save_editor">{{__('page.admin.language.edit.editor_button')}}</button>
                        <div class="clearfix"></div>

                        <div class="alert alert-success alert-dismissible fade mt-3" role="alert" id="language_success">
                            <strong>Dil Güncellendi</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="alert alert-danger alert-dismissible fade" role="alert" id="language_error">
                            <strong>Hata bir sorun oluştu</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endisset
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
@isset($language)

@section('scripts')
    <script src="{{asset('fpool/assets/plugins/trumbowyg/trumbowyg.js')}}"></script>
    <script>
            @forelse($files as $file)
        var text = $('#editor_{{basename($file->getFilename(),'.php')}}').text();
        var cleanedText = text.replace(/<[^>]*>/g, "").trim();
        $('#editor_{{basename($file->getFilename(),'.php')}}').html('<pre><pre\n' +
            'style="background-color:#212121;color:#eeffff;font-family:\'DejaVu Sans Mono\';font-size:12.0pt;">' +
            cleanedText +
            '</pre></pre>');


        $('#editor_{{basename($file->getFilename(),'.php')}}').trumbowyg({
            btns: [],
        });
        @empty
        @endforelse

        $('#save_editor').on('click', function () {
            let data = {};
                @forelse($files as $file)

            var text = $('#editor_{{basename($file->getFilename(),'.php')}}').trumbowyg('html')
                    .replace(/&gt;/g, '')
                    .replace(/<[^>]*>/g, "").trim();

            data = {
                ...data,
                '{{basename($file->getFilename(),'.php')}}': text
            };
            @empty
            @endforelse


            axios.post(window.routes.language_update_file, {files: data, shortcode: '{{$language->shortcode}}'}).then(response => {
                if (response.data.status) {
                    $('#language_success').addClass('show');
                } else {
                    $('#language_error').addClass('show');
                }
            }).catch(error => {
                $('#language_error').addClass('show');
            });
        });
    </script>
@append

@section('styles')
    <link rel="stylesheet" href="{{asset('fpool/assets/plugins/trumbowyg/ui/trumbowyg.css')}}">
    <style>
        .trumbowyg-box,
        .trumbowyg-editor {
            min-height: 650px;
        }
    </style>
@append

@endisset



