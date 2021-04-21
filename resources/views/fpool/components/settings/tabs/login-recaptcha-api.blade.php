<div class="row">
    <form class="col-12" action="{{route('admin.setting.store')}}" method="POST">
        <input type="hidden" name="login_recaptcha_api">
        <h4>{{__('page.admin.settings.cards.login_recaptcha.title')}}</h4>
        <hr>
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <h4>{{__('page.admin.settings.cards.login_recaptcha.google.title')}}</h4>
                <hr>
                <div class="form-group">
                    <label for="google_client_id">{{__('page.admin.settings.cards.login_recaptcha.google.client_id')}}</label>
                    <input type="text" class="form-control col-12" id="google_client_id"
                           name="google_client_id" value="{{isset($setting) ? $setting->google_client_id : ''}}">
                </div>
                <div class="form-group">
                    <label for="google_secret">{{__('page.admin.settings.cards.login_recaptcha.google.secret_key')}}</label>
                    <input type="text" class="form-control col-12" id="google_secret"
                           name="google_secret" value="{{isset($setting) ? $setting->google_secret : ''}}">
                    <div class="small">
                        {!! __('page.admin.settings.cards.login_recaptcha.google.callback',['callback' => "<strong>".route('user.google.login.handle')."</strong>"]) !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h4>{{__('page.admin.settings.cards.login_recaptcha.facebook.title')}}</h4>
                <hr>
                <div class="form-group">
                    <label for="facebook_client_id">{{__('page.admin.settings.cards.login_recaptcha.facebook.client_id')}}</label>
                    <input type="text" class="form-control col-12" id="facebook_client_id"
                           name="facebook_client_id" value="{{isset($setting) ? $setting->facebook_client_id : ''}}">
                </div>
                <div class="form-group">
                    <label for="facebook_secret">{{__('page.admin.settings.cards.login_recaptcha.facebook.secret_key')}}</label>
                    <input type="text" class="form-control col-12" id="facebook_secret"
                           name="facebook_secret" value="{{isset($setting) ? $setting->facebook_secret : ''}}">
                    <div class="small">
                        {!! __('page.admin.settings.cards.login_recaptcha.facebook.callback',['callback' => "<strong>".route('user.facebook.login.handle')."</strong>"]) !!}
                    </div>
                </div>
            </div>

        </div>

        <h4>{{__('page.admin.settings.cards.login_recaptcha.recaptcha.title')}}</h4>
        <hr>
        <div class="alert alert-warning">
            {{__('page.admin.settings.cards.login_recaptcha.recaptcha.warning')}}
        </div>
        <hr>
        <div class="form-group">
            <label for="recaptcha_site_key">{{__('page.admin.settings.cards.login_recaptcha.recaptcha.site_key')}}</label>
            <input type="text" class="form-control col-12" id="recaptcha_site_key"
                   name="recaptcha_site_key" value="{{isset($setting) ? $setting->recaptcha_site_key : ''}}">
        </div>
        <div class="form-group">
            <label for="recaptcha_secret_key">{{__('page.admin.settings.cards.login_recaptcha.recaptcha.secret_key')}}</label>
            <input type="text" class="form-control col-12" id="recaptcha_secret_key"
                   name="recaptcha_secret_key" value="{{isset($setting) ? $setting->recaptcha_secret_key : ''}}">
        </div>
        <button type="submit" class="btn btn-primary btn-lg float-right">{{__('page.admin.settings.save_button')}}</button>
    </form>
</div>
