<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function index()
    {
        $view = view('fpool.settings');

        $setting = Setting::first();

        return $setting ? $view->with('setting', $setting) : $view;
    }

    public function store(SettingRequest $request)
    {
        if (request()->has('website')) {
            return $this->website($request);

        } elseif (request()->has('logo_favicon')) {
            return $this->logoFavicon($request);

        } elseif (request()->has('aws_api')) {
            return $this->awsApi($request);

        } elseif (request()->has('login_recaptcha_api')) {
            return $this->loginRecaptchaApi($request);

        } elseif (request()->has('seo')) {
            return $this->seo($request);

        } else {
            return back()->with('error', 'Something gone wrong.');
        }
    }


    private function updateOrCreate($data)
    {
        $setting = Setting::first();

        return $setting ? $setting->update($data) : Setting::create($data);
    }

    private function website(SettingRequest $request)
    {
        $data = [
            'website_name'     => $request->get('website_name'),
            'google_analytics' => $request->get('google_analytics'),
            'max_file_size'    => $request->get('max_file_size'),
            'one_time_uploads' => $request->get('one_time_uploads'),
            'uploads_storage'  => $request->get('uploads_storage'),
            'dropzone_text'    => $request->get('dropzone_text'),
            'browse_text'      => $request->get('browse_text'),
            'dropzone_rule'    => $request->get('dropzone_rule'),
            'menu_title'       => $request->get('menu_title'),
            'theme_color'      => $request->get('theme_color'),
        ];

        if ($this->updateOrCreate($data)) {
            return back()->with('success', 'Website Settings successfully updated.');
        } else {
            return back()->with('error', 'Something gone wrong.');
        }

    }

    private function logoFavicon(SettingRequest $request)
    {
        $setting = Setting::first();
        $uploadFolder = get_upload_folder();


        if ($request->hasFile('logo')) {
            if (!$this->logoUpload($uploadFolder)) {
                return back()->with('error', 'Something gone wrong.');
            }

            if ($setting && $setting->logo) {
                File::delete($uploadFolder . '/' . $setting->logo);
            }
        }

        if ($request->hasFile('favicon')) {
            if (!$this->faviconUpload($uploadFolder)) {
                return back()->with('error', 'Something gone wrong.');
            }

            if ($setting && $setting->favicon) {
                File::delete($uploadFolder . '/' . $setting->favicon);
            }
        }

        return back()->with('success', 'Logo & favicon successfully updated');
    }

    private function logoUpload($uploadFolder)
    {
        $logo = upload_file(request()->file('logo'), $uploadFolder)->getData();

        if ($logo->status) {
            return $this->updateOrCreate([
                'logo' => $logo->name,
            ]);
        }
        return false;
    }

    private function faviconUpload($uploadFolder)
    {
        $favicon = upload_file(request()->file('favicon'), $uploadFolder)->getData();

        if ($favicon->status) {
            return $this->updateOrCreate([
                'favicon'      => $favicon->name,
                'favicon_mime' => $favicon->extension,
            ]);
        }

        return false;

    }

    private function awsApi(SettingRequest $request)
    {
        $data = [
            'aws_access_key'        => $request->get('aws_access_key'),
            'aws_secret_access_key' => $request->get('aws_secret_access_key'),
            'aws_region'            => $request->get('aws_region'),
            'aws_bucket'            => $request->get('aws_bucket'),
        ];

        if ($this->updateOrCreate($data)) {
            return back()->with('success', 'AWS API successfully updated.');
        } else {
            return back()->with('error', 'Something gone wrong.');
        }
    }

    private function loginRecaptchaApi(SettingRequest $request)
    {
        $data = [
            'google_client_id'     => $request->get('google_client_id'),
            'google_secret'        => $request->get('google_secret'),
            'facebook_client_id'   => $request->get('facebook_client_id'),
            'facebook_secret'      => $request->get('facebook_secret'),
            'recaptcha_site_key'   => $request->get('recaptcha_site_key'),
            'recaptcha_secret_key' => $request->get('recaptcha_secret_key'),
        ];

        if ($this->updateOrCreate($data)) {
            return back()->with('success', 'Login & Recaptcha Api successfully updated.');
        } else {
            return back()->with('error', 'Something gone wrong.');
        }
    }

    private function seo(SettingRequest $request)
    {
        $data = [
            'site_title'       => $request->get('site_title'),
            'site_description' => $request->get('site_description'),
            'site_keywords'    => $request->get('site_keywords'),
        ];

        if ($this->updateOrCreate($data)) {
            return back()->with('success', 'SEO successfully updated.');
        } else {
            return back()->with('error', 'Something gone wrong.');
        }
    }
}
