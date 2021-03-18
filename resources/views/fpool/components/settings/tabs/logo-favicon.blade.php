<div class="row">
    <form class="col-12" action="{{route('admin.setting.store')}}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="logo_favicon">
        <h4>Website Logo & Favicon</h4>
        <hr>
        @csrf
        <div class="row">
            <div class="col-lg-6 text-center mt-3">
                <img src="{{isset($setting) && $setting->logo ? website_file_url($setting->logo) : website_file_url('404.svg','assets/images/')}}" alt="logo" style="max-width: 120px;"
                     id="logo_preview">
                <div class="form-group">
                    <hr>
                    <div class="mt-3 choose-file">
                        <label for="logo" class="form-control form-control-file text-center d-inline">Choose Logo</label>
                        <div class="small">Recommended: 135x45</div>
                    </div>
                    <input type="file" class="d-none" id="logo" name="logo">
                </div>
            </div>
            <div class="col-lg-6 text-center mt-3">
                <img src="{{isset($setting) && $setting->favicon ? website_file_url($setting->favicon) : website_file_url('404.svg','assets/images/')}}" alt="favicon" style="max-width: 120px;" id="favicon_preview">
                <div class="form-group">
                    <hr>
                    <div class="mt-3 choose-file">
                        <label for="favicon" class="form-control form-control-file text-center d-inline">Choose Icon</label>
                        <div class="small">Recommended: 60x60</div>
                    </div>
                    <input type="file" class="d-none" id="favicon" name="favicon">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-lg float-right">Save Settings</button>
    </form>
</div>
