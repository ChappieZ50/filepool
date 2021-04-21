<form class="w-100" action="{{ route('admin.setting.store') }}" method="POST">
    <input type="hidden" name="website">
    @csrf
    <div class="row col-12">
        <div class="col-lg-6 col-md-12">
            <h4>{{__('page.admin.settings.cards.website.website.title')}}</h4>
            <hr>
            <div class="row">
                <div class="form-group col-lg-6">
                    <label for="website_name">{{__('page.admin.settings.cards.website.website.name')}}</label>
                    <input type="text" class="form-control col-12" id="website_name" name="website_name"
                           value="{{ isset($setting) ? $setting->website_name : old('website_name') }}">
                </div>
                <div class="form-group col-lg-6">
                    <label for="google_analytics">{{__('page.admin.settings.cards.website.website.google_analytics_id')}}</label>
                    <input type="text" class="form-control col-12" id="google_analytics" name="google_analytics"
                           value="{{ isset($setting) ? $setting->google_analytics : old('google_analytics') }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-6">
                    <label for="max_file_size">{{__('page.admin.settings.cards.website.website.max_file_size')}}</label>
                    <input type="number" class="form-control col-12" id="max_file_size" name="max_file_size"
                           value="{{ isset($setting) ? $setting->max_file_size : old('max_file_size') }}">
                    <div class="small text-muted">{{__('page.admin.settings.cards.website.website.max_file_size_default')}}</div>
                </div>
                <div class="form-group col-lg-6">
                    <label for="one_time_uploads">{{__('page.admin.settings.cards.website.website.one_time_uploads')}}</label>
                    <input type="number" class="form-control col-12" id="one_time_uploads" name="one_time_uploads"
                           value="{{ isset($setting) ? $setting->one_time_uploads : old('one_time_uploads') }}">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-lg-6">
                    <label for="menu_title">{{__('page.admin.settings.cards.website.website.menu_title')}}</label>
                    <input type="text" class="form-control col-12" id="menu_title" name="menu_title"
                           value="{{ isset($setting) ? $setting->menu_title : old('menu_title') }}">
                </div>
                <div class="form-group col-lg-6">
                    <label for="uploads_storage">{{__('page.admin.settings.cards.website.website.uploads_storage')}}</label>
                    <select name="uploads_storage" id="uploads_storage" class="form-control">
                        <option {{ isset($setting) && $setting->uploads_storage == 'local' ? 'selected' : '' }}
                                value="local">{{__('page.admin.settings.cards.website.website.local_storage')}}
                        </option>
                        <option {{ isset($setting) && $setting->uploads_storage == 'aws' ? 'selected' : '' }}
                                value="aws">{{__('page.admin.settings.cards.website.website.aws_storage')}}
                        </option>
                    </select>
                    <div class="small font-italic">{{__('page.admin.settings.cards.website.website.uploads_storage_default')}}</div>
                </div>
            </div>
            <div class="form-group">
                <label for="theme_color">{{__('page.admin.settings.cards.website.website.theme_color')}}</label>
                <input type="text" class="form-control col-12" id="theme_color" name="theme_color"
                       value="{{ isset($setting) ? $setting->theme_color : old('theme_color') }}">
                <div class="small text-muted">{{__('page.admin.settings.cards.website.website.theme_color_default')}}</div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <h4>{{__('page.admin.settings.cards.website.dropzone.title')}}</h4>
            <hr>
            <div class="form-group">
                <label for="dropzone_text">{{__('page.admin.settings.cards.website.dropzone.text')}}</label>
                <input type="text" class="form-control col-12" id="dropzone_text" name="dropzone_text"
                       value="{{ isset($setting) ? $setting->dropzone_text : old('dropzone_text') }}">
                <div class="small">{{__('page.admin.settings.cards.website.dropzone.text_default')}}
                    <strong>%{browse}</strong>
                </div>
                <div class="small">{{__('page.admin.settings.cards.website.dropzone.text_default_2')}}</div>
            </div>
            <div class="form-group">
                <label for="browse_text">{{__('page.admin.settings.cards.website.dropzone.browse_attribute_text')}}</label>
                <input type="text" class="form-control col-12" id="browse_text" name="browse_text"
                       value="{{ isset($setting) ? $setting->browse_text : old('browse_text') }}">
            </div>
            <div class="form-group">
                <label for="dropzone_rule">{{__('page.admin.settings.cards.website.dropzone.rule_text')}}</label>
                <input type="text" class="form-control col-12" id="dropzone_rule" name="dropzone_rule"
                       value="{{ isset($setting) ? $setting->dropzone_rule : old('dropzone_rule') }}">
                <div class="small text-muted">{{__('page.admin.settings.cards.website.dropzone.rule_text_default')}}</div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-lg float-right">{{__('page.admin.settings.save_button')}}</button>
</form>
