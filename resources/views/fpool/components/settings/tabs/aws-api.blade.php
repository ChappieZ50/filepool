<div class="row">
    <form class="col-12" action="{{route('admin.setting.store')}}" method="POST">
        <input type="hidden" name="aws_api">
        <h4>Amazon Web Services API</h4>
        <hr>
        <div class="alert alert-light">
            You can get your info from <a href="https://s3.console.aws.amazon.com" target="_blank">AWS console</a>
        </div>
        <hr>
        @csrf
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="aws_access_key">Access Key</label>
                <input type="text" class="form-control col-12" id="aws_access_key"
                       name="aws_access_key" value="{{isset($setting) ? $setting->aws_access_key : ''}}">
            </div>
            <div class="form-group col-lg-6">
                <label for="aws_secret_access_key">Secret Access Key</label>
                <input type="text" class="form-control col-12" id="aws_secret_access_key"
                       name="aws_secret_access_key" value="{{isset($setting) ? $setting->aws_secret_access_key : ''}}">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="aws_region">Region</label>
                <input type="text" class="form-control col-12" id="aws_region"
                       name="aws_region" value="{{isset($setting) ? $setting->aws_region : ''}}">
            </div>
            <div class="form-group col-lg-6">
                <label for="aws_bucket">Bucket</label>
                <input type="text" class="form-control col-12" id="aws_bucket"
                       name="aws_bucket" value="{{isset($setting) ? $setting->aws_bucket : ''}}">
            </div>
        </div>
        <div class="alert alert-warning small">
            Please enter all information
        </div>
        <button type="submit" class="btn btn-primary btn-lg float-right">Save Settings</button>
    </form>
</div>
