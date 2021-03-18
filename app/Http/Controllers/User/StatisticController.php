<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\File;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index()
    {
        /* Getting user file chart */
        $chartFileData = get_chart_data(File::class, function ($q) {
            return $q->where('user_id', auth()->user()->id);
        });

        return view('user.statistic')->with([
            'file_chart_data' => $chartFileData,
        ]);
    }
}
