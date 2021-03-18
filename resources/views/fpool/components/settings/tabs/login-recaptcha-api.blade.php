<div class="row">
    <form class="col-12" action="{{route('admin.setting.store')}}" method="POST">
        <input type="hidden" name="login_recaptcha_api">
        <h4>Google & Facebook & Recaptcha</h4>
        <hr>
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <h4>Google Login Information</h4>
                <hr>
                <div class="form-group">
                    <label for="google_client_id">Client ID</label>
                    <input type="text" class="form-control col-12" id="google_client_id"
                           name="google_client_id" value="{{isset($setting) ? $setting->google_client_id : ''}}">
                </div>
                <div class="form-group">
                    <label for="google_secret">Secret Key</label>
                    <input type="text" class="form-control col-12" id="google_secret"
                           name="google_secret" value="{{isset($setting) ? $setting->google_secret : ''}}">
                    <div class="small"><strong>Add this to your api callback: </strong>{{route('user.google.login.handle')}}</div>
                </div>
            </div>
            <div class="col-lg-6">
                <h4>Facebook Login Information</h4>
                <hr>
                <div class="form-group">
                    <label for="facebook_client_id">Client ID</label>
                    <input type="text" class="form-control col-12" id="facebook_client_id"
                           name="facebook_client_id" value="{{isset($setting) ? $setting->facebook_client_id : ''}}">
                </div>
                <div class="form-group">
                    <label for="facebook_secret">Secret Key</label>
                    <input type="text" class="form-control col-12" id="facebook_secret"
                           name="facebook_secret" value="{{isset($setting) ? $setting->facebook_secret : ''}}">
                    <div class="small"><strong>Add this to your api callback: </strong>{{route('user.facebook.login.handle')}}</div>
                </div>
            </div>

        </div>

        <h4>Recaptcha Information</h4>
        <hr>
        <div class="alert alert-warning">
            Please use V2 recaptcha
        </div>
        <hr>
        <div class="form-group">
            <label for="recaptcha_site_key">Site Key</label>
            <input type="text" class="form-control col-12" id="recaptcha_site_key"
                   name="recaptcha_site_key" value="{{isset($setting) ? $setting->recaptcha_site_key : ''}}">
        </div>
        <div class="form-group">
            <label for="recaptcha_secret_key">Secret Key</label>
            <input type="text" class="form-control col-12" id="recaptcha_secret_key"
                   name="recaptcha_secret_key" value="{{isset($setting) ? $setting->recaptcha_secret_key : ''}}">
        </div>
        <button type="submit" class="btn btn-primary btn-lg float-right">Save Settings</button>
    </form>
</div>
