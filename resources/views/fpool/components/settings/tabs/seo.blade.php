<div class="row">
    <form class="col-12" action="{{route('admin.setting.store')}}" method="POST">
        <input type="hidden" name="seo">
        <h4>SEO</h4>
        <hr>
        @csrf
        <div class="form-group">
            <label for="site_title">Site Title</label>
            <input type="text" class="form-control col-12" id="site_title"
                   name="site_title" value="{{isset($setting) ? $setting->site_title : ''}}">
        </div>

        <div class="row">
            <div class="form-group col-lg-6">
                <label for="site_description">Site Description</label>
                <textarea class="form-control col-12" id="site_description" name="site_description">{{isset($setting) ? $setting->site_description : ''}}</textarea>
            </div>
            <div class="form-group col-lg-6">
                <label for="site_keywords">Site Keywords</label>
                <textarea class="form-control col-12" id="site_keywords" name="site_keywords">{{isset($setting) ? $setting->site_keywords : ''}}</textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-lg float-right">Save Settings</button>
    </form>
</div>
