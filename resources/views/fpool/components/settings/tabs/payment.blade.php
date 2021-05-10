<div class="row">
    <form class="col-12" action="{{route('admin.setting.store')}}" method="POST">
        <input type="hidden" name="payment">
        <h4>{{__('page.admin.settings.cards.payment.title')}}</h4>
        <hr>
        @csrf
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="iyzico_api_key">{{__('page.admin.settings.cards.payment.iyzico_api_key')}}</label>
                <input type="text" class="form-control col-12" id="iyzico_api_key"
                       name="iyzico_api_key" value="{{isset($setting) ? $setting->iyzico_api_key : ''}}">
            </div>

            <div class="form-group col-lg-6">
                <label for="iyzico_secret_key">{{__('page.admin.settings.cards.payment.iyzico_secret_key')}}</label>
                <input type="text" class="form-control col-12" id="iyzico_secret_key"
                       name="iyzico_secret_key" value="{{isset($setting) ? $setting->iyzico_secret_key : ''}}">
            </div>
        </div>
        <div class="form-group col-lg-6 col-sm-12">
            <label for="iyzico_sandbox">{{__('page.admin.settings.cards.payment.iyzico_sandbox')}}</label>
            <select name="iyzico_sandbox" id="iyzico_sandbox" class="form-control">
                <option {{ isset($setting) && $setting->iyzico_sandbox ==  false ? 'selected' : '' }}
                        value="0">{{__('page.admin.settings.cards.payment.iyzico_sandbox_passive')}}
                </option>
                <option {{ isset($setting) && $setting->iyzico_sandbox ==  true ? 'selected' : '' }}
                        value="1">{{__('page.admin.settings.cards.payment.iyzico_sandbox_active')}}
                </option>
            </select>
            <div class="small font-italic">{{__('page.admin.settings.cards.payment.iyzico_sandbox_text')}}</div>
        </div>
        <button type="submit" class="btn btn-primary btn-lg float-right">{{__('page.admin.settings.save_button')}}</button>
    </form>
</div>
