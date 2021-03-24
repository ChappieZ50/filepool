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
        /* Getting user files size */
        $fileStorageItems = get_chart_data(File::class, function ($q) {
            return $q->where('user_id', auth()->user()->id);
        }, 'file_size', true);

        $fileStorageChartData = [];
        if (!empty($fileStorageItems)) {
            foreach ($fileStorageItems as $key => $value) {
                $fileStorageChartData[$key] = [
                    'value' => readable_size($value),
                    'unit'  => readable_size($value, 1, true),
                ];
            }
        }
        return view('user.statistic')->with([
            'file_chart_data'         => $chartFileData,
            'file_storage_chart_data' => $fileStorageChartData,
        ]);
    }
}
