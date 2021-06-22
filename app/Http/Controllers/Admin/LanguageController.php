<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LanguageRequest;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
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

        Language::create($store);

        $this->checkActive();
        return back()->with('success', __('page.back.language.create_success'));
    }

    public function edit($id)
    {
        $language = Language::findOrFail($id);
        return view('fpool.language.language')->with('language', $language);
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

        $language->update($update);
        $this->checkActive();
        return back()->with('success', __('page.back.language.update_success'));
    }

    public function destroy($id)
    {
        $language = Language::where('id', $id)->first();
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
}
