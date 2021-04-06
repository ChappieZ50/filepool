<?php

use App\Models\Ad;
use App\Models\Page;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/*
 * Downloading file from any storage.
 * You should give File model instance to $file parameter.
*/
if (!function_exists('download_file')) {
    function download_file($file)
    {
        $name = $file->file_full_id;

        if ($file->uploaded_to === 'aws') {
            return Storage::disk('s3')->download(config('filepool.aws_folder') . '/' . $name);
        } else {
            return Storage::disk('local')->download(config('filepool.local_folder') . '/' . $name);
        }
    }
}

/*
 * Getting file url from any storage your given.
*/
if (!function_exists('file_url')) {
    function file_url($file)
    {
        return route('file.show', $file->file_id);
    }
}

/*
 * This function for admin panel /settings logo favicon tab
*/
if (!function_exists('website_file_url')) {
    function website_file_url($file, $path = '')
    {
        return !$path ? asset(config('filepool.upload_folder') . '/' . $file) : asset($path . $file);
    }
}

/*
 * Get Website logo
*/
if (!function_exists('get_logo')) {
    function get_logo()
    {
        $file = get_setting('logo', 'logo.png');
        if ($file === 'logo.png') {
            return asset($file);
        }

        return asset(config('filepool.upload_folder') . '/' . $file);
    }
}

/*
 * Get Website favicon
*/
if (!function_exists('get_favicon')) {
    function get_favicon()
    {
        $file = get_setting('favicon', 'favicon.ico');
        if ($file === 'favicon.ico') {
            return asset($file);
        }

        return asset(config('filepool.upload_folder') . '/' . $file);
    }
}
/*
 * Get Avatar Size
*/
if (!function_exists('get_avatar_size')) {
    function get_avatar_size()
    {
        return config('filepool.max_avatar_size');
    }
}

/*
 * Get Upload Folder for avatars, logo, favicon etc.
*/
if (!function_exists('upload_folder')) {
    function get_upload_folder()
    {
        return config('filepool.upload_folder');
    }
}
/*
 * Getting avatar url.
 * If $file not exists then will return default avatar
*/
if (!function_exists('avatar_url')) {
    function avatar_url($file = '', $path = '')
    {
        return $file ? asset(config('filepool.user_avatars_folder') . '/' . $file) : ($path ? $path : asset('assets/images/avatar.png'));
    }
}

/*
 * Get analytics script
 * You should add google analytic code from admin panel /settings page
*/
if (!function_exists('get_analytics_script')) {
    function get_analytics_script()
    {
        $setting = Setting::first();

        if ($setting && $setting->google_analytics) {
            return "<!-- Global site tag (gtag.js) - Google Analytics -->
                    <script async src='https://www.googletagmanager.com/gtag/js?id=$setting->google_analytics'></script>
                    <script>
                        window.dataLayer = window.dataLayer || [];

                        function gtag() {
                            dataLayer.push(arguments);
                        }
                        gtag('js', new Date());

                        gtag('config', '$setting->google_analytics');

                    </script>";
        }

        return '';
    }
}

/*
 * Change file sizes to readable size
*/
if (!function_exists('readable_size')) {
    function readable_size($num, $t = 1, $onlyUnit = false)
    {
        $num = $num < 0 ? $num : $num * $t;
        $neg = $num < 0;


        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');

        if ($neg) {
            $num = -$num;
        }

        if ($num < 1) {
            return ($neg ? '-' : '') . $num . ' B';
        }

        $exponent = min(floor(log($num) / log(1000)), count($units) - 1);

        $num = sprintf('%.02F', ($num / pow(1000, $exponent)));

        $unit = $units[$exponent];

        return !$onlyUnit ? ($neg ? ' ' : '') . (int)$num . $unit : $unit;
    }
}
/*
 * Change file sizes to readable size
*/
if (!function_exists('readable_size_clearly')) {
    function readable_size_clearly($size)
    {
        return readable_size($size, 1000000);
    }
}
if (!function_exists('delete_file')) {
    function delete_file($file)
    {
        if ($file->uploaded_to === 'aws') {
            return Storage::disk('s3')->delete(config('filepool.aws_folder') . '/' . $file->file_full_id);
        } else {
            return Storage::delete(config('filepool.local_folder') . '/' . $file->file_full_id);
        }
    }
}
/*
 * This function can upload file to any storage to your given
 * If you pass file name to $delete parameter. Then this file will be deleted.
*/
if (!function_exists('upload_file')) {
    function upload_file($file, $path, $delete = '', $disk = 'local')
    {
        $path = $disk === 'local' ? storage_path($path) : $path;

        $extension = $file->getClientOriginalExtension();
        $fileId = Str::random(12);
        $name = $fileId . '.' . $extension;
        $fileSize = $file->getSize();
        $fileOriginalId = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        if ($disk !== 'local') {
            $put = Storage::disk($disk)->put($path . '/' . $name, file_get_contents($file), 'public');
        } else {
            $put = Storage::disk($disk)->put($path . '/' . $name, file_get_contents($file));
        }

        if ($put) {

            if ($delete) {
                Storage::disk($disk)->delete($path . '/' . $delete);
            }

            return response()->json([
                'status'           => true,
                'extension'        => $extension,
                'name'             => $name,
                'file_id'          => $fileId,
                'file_original_id' => $fileOriginalId,
                'file_size'        => $fileSize,
                'url'              => route('file.show', $fileId),
            ]);
        }

        return response()->json(['status' => false]);
    }
}

/*
 * Check setting is exist
*/
if (!function_exists('has_setting')) {
    function has_setting($name)
    {
        if (Schema::hasTable('settings')) {
            $setting = Setting::first();
            if ($setting && $setting->$name) {
                return true;
            }
        }

        return false;
    }
}

/*
 * Get any setting
 * If you pass value parameter and if setting is empty then will return value
*/
if (!function_exists('get_setting')) {
    function get_setting($name, $value = '')
    {
        if (Schema::hasTable('settings')) {
            $setting = Setting::first();
            if ($setting && $setting->$name) {
                return $setting->$name;
            }
        }

        return !$value ? config('filepool.settings.' . $name) : $value;
    }
}

/*
 * Check any setting is exists or not
 * You can pass multiple settings
 * If any setting is not exists or empty then will return false
*/
if (!function_exists('has_settings')) {
    function has_settings(...$names)
    {
        $status = false;

        if (Schema::hasTable('settings')) {
            $setting = Setting::first();
            if ($setting) {
                $status = true;
                foreach ($names as $name) {
                    if (!isset($setting->$name) || empty($setting->$name)) {
                        $status = false;
                        break;
                    }
                }
            }
        }

        return $status;
    }
}

/*
 * Check ad is exist or not
*/
if (!function_exists('has_ad')) {
    function has_ad($name)
    {
        $ad = Ad::first();
        return $ad && $ad->$name && !empty($ad->$name) ? true : false;
    }
}

/*
 * Get any ad "home_top_ad" "home_bottom_ad" "mobile_ad" "download_left_ad" "download_bottom_ad"
*/
if (!function_exists('get_ad')) {
    function get_ad($name)
    {
        if (auth()->check() && auth()->user()->is_premium) {
            return "";
        }
        $ad = Ad::first();
        return $ad->$name;
    }
}
/*
 * Get all pages
*/
if (!function_exists('get_pages')) {
    function get_pages()
    {
        return Page::get();
    }
}

/*
 * Get terms page
*/
if (!function_exists('get_terms_page')) {
    function get_terms_page()
    {
        return Page::where('type', 'terms')->first();
    }
}

/*
 * Get privacy page
*/
if (!function_exists('get_privacy_page')) {
    function get_privacy_page()
    {
        return Page::where('type', 'privacy')->first();
    }
}


/*
 * Limiting any string
*/
if (!function_exists('str_limit')) {
    function str_limit($value, $limit = 50, $end = '...')
    {
        return Str::limit($value, $limit, $end);
    }
}


/*
 * Getting chart settings for admin panel and front
 * Give a model and get data like this: [0 => 1,5 => 4]
 * 0 and 5 is id column data
 * 1 and 4 is count of grouped and counted data
*/

if (!function_exists('get_chart_data')) {
    function get_chart_data($model, callable $callback = null, $primary = 'id', $col = false)
    {
        $query = $model::select($primary, 'created_at')->where(function ($q) use ($callback) {
            if (is_callable($callback)) {
                return $callback($q);
            }
            return '';
        })->get()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

        $count = [];
        $pool = [];

        foreach ($query as $key => $value) {
            if (!$col) {
                $count[(int)$key] = count($value);
            } else {
                foreach ($value as $item) {
                    if (isset($count[(int)$key])) {
                        $count[(int)$key] += $item->$primary;
                    } else {
                        $count[(int)$key] = $item->$primary;
                    }
                }
            }
        }
        for ($i = 1; $i <= 12; $i++) {
            if (!empty($count[$i])) {
                $pool[$i] = $count[$i];
            } else {
                $pool[$i] = 0;
            }
        }
        return $pool;
    }
}

if (!function_exists('get_accepted_mimes')) {
    function get_accepted_mimes($dropzone = false, $str = true)
    {
        if ($dropzone) {
            $mimes = config('filepool.accepted_mimes');
        } else {
            $mimes = config('filepool.accepted_mimes_request');
        }
        if ($str) {
            return implode(',', $mimes);
        }

        return $mimes;
    }
}


if (!function_exists('get_accepted_mimes_dropzone')) {
    function get_accepted_mimes_dropzone()
    {
        return '.' . str_replace(',', ',.', get_accepted_mimes(true));
    }
}

/*
 * If user logged then return user's file max file size
 * Else return default max file size
 * $p parameter for pretty parse.
 * Ex: If preview true: 10 value will change to "10MB", if not 10 will change to "10000"
 */
if (!function_exists('get_storage_limit')) {
    function get_storage_limit($p = true)
    {
        $size = auth()->check() ? bytes_to_mb(auth()->user()->storage_limit) : get_setting('max_file_size');
        return $p ? readable_size_clearly($size) : $size * 1000;
    }
}

if (!function_exists('mb_to_byte')) {
    function mb_to_bytes($mb)
    {
        return !$mb ? 0 : $mb * 1048576;
    }
}

if (!function_exists('bytes_to_mb')) {
    function bytes_to_mb($bytes)
    {
        return !$bytes ? 0 : $bytes / 1048576;
    }
}

if (!function_exists('check_storage_limit')) {
    function check_storage_limit($storage, $file_limit, $file_size)
    {
        $new_file_size = $storage + $file_size;

        if ($new_file_size > $file_limit) {
            return false;
        }

        return $new_file_size;
    }
}

if (!function_exists('get_storage_usage')) {
    function get_storage_usage($storage, $limit, $get_used = true)
    {
        $percent = round((($limit - $storage) / $limit) * 100, 2);
        return $get_used ? round(100 - $percent, 2) : $percent;
    }
}
