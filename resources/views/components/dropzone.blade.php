<div class="fpool-dropzone-wrapper">
    <div id="fpool_dropzone" class="fpool-dropzone"
         data-note="{{trans(get_setting('dropzone_rule'),['size' => get_storage_limit()])}}"
         data-drop="{{get_setting('dropzone_text')}}"
         data-browse="{{get_setting('browse_text')}}"
         data-mimes="{{get_accepted_mimes_dropzone()}}"
         data-max-size="{{get_setting('max_file_size').'000000'}}"
         data-max-file="{{get_setting('one_time_uploads')}}">
    </div>

    <div class="fpool-dropzone-terms">
        <div>
            @php
                $privacy = get_privacy_page();
                $terms = get_terms_page();
            @endphp
            {{__('page.website.home.dropzone.rule_text')}}
            <a href="{{route('page',['slug' => !empty($terms->slug) ? $terms->slug : '#'])}}" class="selected-page-item"
               target="_blank">{{!empty($terms->title) ? $terms->title : ''}}</a>
            {{__('page.website.home.dropzone.and')}}
            <a href="{{route('page',['slug' => !empty($privacy->slug) ? $privacy->slug : '#'])}}" class="selected-page-item"
               target="_blank">{{!empty($privacy->title) ? $privacy->title : ''}}</a>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        window.filepool_dropzone = {
            expires: {
                one: '{{__('page.admin.js.dropzone.1')}}',
                seven: '{{__('page.admin.js.dropzone.7')}}',
                fifteen: '{{__('page.admin.js.dropzone.15')}}',
                thirteen: '{{__('page.admin.js.dropzone.30')}}',
                never: '{{__('page.admin.js.dropzone.never')}}',
            },
            info: '{{__('page.admin.js.dropzone.info')}}',
            confirm_button_text: '{{__('page.admin.js.dropzone.confirm_button_text')}}',
            recaptcha_error: '{{__('page.admin.js.dropzone.recaptcha_error')}}',
            close: '{{__('page.admin.js.dropzone.close')}}',
            password: '{{__('page.admin.js.dropzone.password')}}',
        };
    </script>
@append

@if(config()->get('captcha.secret') && config()->get('captcha.sitekey'))
@section('scripts')
    {!! NoCaptcha::renderJs() !!}
@append
@endif
