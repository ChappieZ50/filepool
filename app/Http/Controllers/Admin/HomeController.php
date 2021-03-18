<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Message;
use App\Models\Page;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        /* Getting records count for dashboard top */
        $filesCount = File::count();
        $usersCount = User::count();
        $messagesCount = Message::count();
        $pagesCount = Page::count();


        /* Take last 5 records from files */
        $files = File::orderByDesc('id')->take(5)->get();
        /* Take last 5 records from users */
        $users = User::orderByDesc('id')->take(5)->get();

        $labels = explode(',', get_accepted_mimes());

        return view('fpool.home')->with([
            'filesCount'                  => $filesCount,
            'usersCount'                  => $usersCount,
            'messagesCount'               => $messagesCount,
            'pagesCount'                  => $pagesCount,
            'files'                       => $files,
            'users'                       => $users,

            /* Charts data */
            'chart_file_data'             => get_chart_data(File::class),
            'chart_user_data'             => get_chart_data(User::class),
            'chart_user_status_data'      => $this->getUserStatusChart(),
            'chart_file_extension_data'   => $this->getFileExtensionChart(),
            'chart_file_extension_labels' => $labels,
            'chart_user_login_data'       => $this->getUserLoginChart(),
        ]);
    }


    public function getUserStatusChart()
    {
        $users = User::groupBy('status')->select('status', DB::raw('count(*) as count'))->get()->toArray();

        $data = [];

        foreach ($users as $key => $value) {
            $data[$value['status']] = $value['count'];
        }

        return $data;
    }

    public function getFileExtensionChart()
    {
        $files = File::select('file_mime', DB::raw('count(*) as count'))
            ->groupBy('file_mime')
            ->get()->toArray();


        $data = [];

        foreach ($files as $key => $value) {
            $data[$value['file_mime']] = $value['count'];
        }

        return $data;
    }

    public function getUserLoginChart()
    {
        $users = User::select('google', 'facebook', DB::raw('count(*) as count'))
            ->groupBy('google', 'facebook')
            ->get()->toArray();


        $data = [];

        foreach ($users as $value) {
            $count = $value['count'];
            if (!empty($value['google'])) {
                $data['google'] = isset($data['google']) ? $count + $data['google'] : $count;
            } elseif (!empty($value['facebook'])) {
                $data['facebook'] = isset($data['facebook']) ? $count + $data['facebook'] : $count;
            } else {
                $data['normal'] = isset($data['normal']) ? $count + $data['normal'] : $count;
            }
        }

        return $data;
    }
}
