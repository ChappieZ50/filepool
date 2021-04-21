<div class="row">
    <form class="col-12" action="{{route('admin.setting.store')}}" method="POST">
        <input type="hidden" name="payment">
        <h4>{{__('page.admin.settings.cards.payment.title')}}</h4>
        <hr>
        @csrf
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="stripe_key">{{__('page.admin.settings.cards.payment.stripe_key')}}</label>
                <input type="text" class="form-control col-12" id="stripe_key"
                       name="stripe_key" value="{{isset($setting) ? $setting->stripe_key : ''}}">
            </div>

            <div class="form-group col-lg-6">
                <label for="stripe_secret">{{__('page.admin.settings.cards.payment.stripe_secret')}}</label>
                <input type="text" class="form-control col-12" id="stripe_secret"
                       name="stripe_secret" value="{{isset($setting) ? $setting->stripe_secret : ''}}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-lg float-right">{{__('page.admin.settings.save_button')}}</button>
    </form>
</div>
