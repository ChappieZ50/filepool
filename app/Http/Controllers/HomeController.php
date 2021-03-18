<?php

namespace App\Http\Controllers;

use App\Models\Page;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->first();
        return $page ? view('page')->with('page', $page) : abort(404);
    }
}
