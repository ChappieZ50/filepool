<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LanguageRequest;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LanguageController extends Controller
{
    protected $path;

    public function __construct()
    {
        $this->path = resource_path('lang/');
    }

    public function index()
    {
        $languages = Language::orderByDesc('active')->orderByDesc('id')->paginate();
        return view('fpool.language.languages')->with('languages', $languages);
    }

    public function create()
    {
        return view('fpool.language.language');
    }

    public function store(LanguageRequest $request)
    {
        $store = [
            'name'      => $request->get('name'),
            'shortcode' => $request->get('shortcode'),
            'active'    => $request->get('active') ? true : false
        ];

        if ($request->get('active')) {
            Language::where('active', true)->update(['active' => false]);
        }

        $language = Language::create($store);

        $this->checkActive();
        $this->createLang($request->get('shortcode'));

        return redirect()->route('admin.language.edit', $language->id)->with('success', __('page.back.language.create_success'));
    }

    public function edit($id)
    {
        $language = Language::findOrFail($id);
        $files = $this->getFiles($language->shortcode);
        return view('fpool.language.language')->with([
            'language' => $language,
            'files'    => $files,
        ]);
    }

    public function update($id, LanguageRequest $request)
    {
        $language = Language::findOrFail($id);

        $update = [
            'name'      => $request->get('name'),
            'shortcode' => $request->get('shortcode'),
            'active'    => $request->get('active') ? true : false
        ];

        if ($request->get('active')) {
            Language::where('active', true)->update(['active' => false]);
        }

        if ($language->shortcode !== $request->get('shortcode')) {
            $this->deleteLang($language->shortcode);
            $this->createLang($request->get('shortcode'));
        }

        $language->update($update);
        $this->checkActive();
        return back()->with('success', __('page.back.language.update_success'));
    }

    public function destroy($id)
    {
        $language = Language::where('id', $id)->first();
        $this->deleteLang($language->shortcode);
        if ($language && $language->delete()) {
            $this->checkActive();
            return response()->json(['message' => __('page.back.language.delete_success'), 'status' => true]);
        }

        return response_server_error(404);
    }

    private function checkActive()
    {
        if (!Language::where('active', true)->exists()) {
            $language = Language::first();
            if ($language) {
                $language->update(['active' => true]);
            }
            return false;
        }

        return true;
    }

    private function createLang($shortcode)
    {
        if (!File::exists($this->path . $shortcode)) {
            return File::copyDirectory($this->path . 'default', $this->path . $shortcode);
        }

        return false;
    }

    private function deleteLang($shortcode)
    {
        if (File::exists($this->path . $shortcode)) {
            return File::deleteDirectory($this->path . $shortcode);
        }

        return false;
    }

    private function getFiles($shortcode)
    {
        if (File::exists($this->path . $shortcode)) {
            return File::allFiles($this->path . $shortcode);
        }

        return [];
    }

    public function updateFiles(Request $request)
    {
        $files = $request->get('files');
        $shortcode = $request->get('shortcode');

        $dir = resource_path('/lang/' . $shortcode);

        if (!File::exists($dir)) {
            File::makeDirectory($dir);
        }

        foreach ($files as $key => $value) {
            $l = '];';
            $value = str_replace('=', '=>', $value);
            $value = str_replace($l, '', $value);
            File::put($dir . '/' . $key . '.php', '<?php return [' . $value . $l);
        }
        return response()->json(['status' => true]);
    }
}
