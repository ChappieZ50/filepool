<form class="w-100" action="{{ route('admin.setting.store') }}" method="POST">
    <input type="hidden" name="website">
    @csrf
    <div class="row col-12">
        <div class="col-lg-6 col-md-12">
            <h4>Website Settings</h4>
            <hr>
            <div class="row">
                <div class="form-group col-lg-6">
                    <label for="website_name">Website Name</label>
                    <input type="text" class="form-control col-12" id="website_name" name="website_name"
                        value="{{ isset($setting) ? $setting->website_name : old('website_name') }}">
                </div>
                <div class="form-group col-lg-6">
                    <label for="google_analytics">Google Analytics ID</label>
                    <input type="text" class="form-control col-12" id="google_analytics" name="google_analytics"
                        value="{{ isset($setting) ? $setting->google_analytics : old('google_analytics') }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-6">
                    <label for="max_file_size">Max File Size (MB)</label>
                    <input type="number" class="form-control col-12" id="max_file_size" name="max_file_size"
                        value="{{ isset($setting) ? $setting->max_file_size : old('max_file_size') }}">
                    <div class="small font-italic">Default: 5MB</div>
                </div>
                <div class="form-group col-lg-6">
                    <label for="one_time_uploads">One Time Uploads</label>
                    <input type="number" class="form-control col-12" id="one_time_uploads" name="one_time_uploads"
                        value="{{ isset($setting) ? $setting->one_time_uploads : old('one_time_uploads') }}">
                    <div class="small font-italic">Default: 5</div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-6">
                    <label for="menu_title">Menu Title</label>
                    <input type="text" class="form-control col-12" id="menu_title" name="menu_title"
                        value="{{ isset($setting) ? $setting->menu_title : old('menu_title') }}">
                </div>
                <div class="form-group col-lg-6">
                    <label for="uploads_storage">Uploads Storage</label>
                    <select name="uploads_storage" id="uploads_storage" class="form-control">
                        <option {{ isset($setting) && $setting->uploads_storage == 'local' ? 'selected' : '' }}
                            value="local">Local Storage</option>
                        <option {{ isset($setting) && $setting->uploads_storage == 'aws' ? 'selected' : '' }}
                            value="aws">AWS Storage</option>
                    </select>
                    <div class="small font-italic">Default: Local Storage</div>
                </div>
            </div>
            <div class="form-group">
                <label for="theme_color">Theme Color</label>
                <input type="text" class="form-control col-12" id="theme_color" name="theme_color"
                    value="{{ isset($setting) ? $setting->theme_color : old('theme_color') }}">
                    <div class="small text-muted">Default: #2c7ce0</div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <h4>Dropzone Settings</h4>
            <hr>
            <div class="form-group">
                <label for="dropzone_text">Dropzone Text</label>
                <input type="text" class="form-control col-12" id="dropzone_text" name="dropzone_text"
                    value="{{ isset($setting) ? $setting->dropzone_text : old('dropzone_text') }}">
                <div class="small">add this attribute in your text:
                    <strong>%{browse}</strong>
                </div>
                <div class="small">Ex: Drop files here, paste or, %{browse}</div>
            </div>
            <div class="form-group">
                <label for="browse_text">Browse Attribute Text</label>
                <input type="text" class="form-control col-12" id="browse_text" name="browse_text"
                    value="{{ isset($setting) ? $setting->browse_text : old('browse_text') }}">
            </div>
            <div class="form-group">
                <label for="dropzone_rule">Dropzone Rule Text</label>
                <input type="text" class="form-control col-12" id="dropzone_rule" name="dropzone_rule"
                    value="{{ isset($setting) ? $setting->dropzone_rule : old('dropzone_rule') }}">
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-lg float-right">Save Settings</button>
</form>
