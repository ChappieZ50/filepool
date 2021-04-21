<div class="row">
    <form class="col-12" action="{{route('admin.setting.store')}}" method="POST">
        <input type="hidden" name="seo">
        <h4>{{__('page.admin.settings.cards.seo.title')}}</h4>
        <hr>
        @csrf
        <div class="form-group">
            <label for="site_title">{{__('page.admin.settings.cards.seo.site_title')}}</label>
            <input type="text" class="form-control col-12" id="site_title"
                   name="site_title" value="{{isset($setting) ? $setting->site_title : ''}}">
        </div>

        <div class="row">
            <div class="form-group col-lg-6">
                <label for="site_description">{{__('page.admin.settings.cards.seo.site_description')}}</label>
                <textarea class="form-control col-12" id="site_description" name="site_description">{{isset($setting) ? $setting->site_description : ''}}</textarea>
            </div>
            <div class="form-group col-lg-6">
                <label for="site_keywords">{{__('page.admin.settings.cards.seo.site_keywords')}}</label>
                <textarea class="form-control col-12" id="site_keywords" name="site_keywords">{{isset($setting) ? $setting->site_keywords : ''}}</textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-lg float-right">{{__('page.admin.settings.save_button')}}</button>
    </form>
</div>
