<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    public function store(MessageRequest $request)
    {
        $create = [
            'name'    => $request->get('name'),
            'email'   => $request->get('email'),
            'subject' => $request->get('subject'),
            'message' => $request->get('message'),
        ];

        if (Auth::check()) {
            $create['user_id'] = Auth::user()->id;
        }

        $store = Message::create($create);

        if ($store) {
            return back()->with('success', __('page.front.message.success'));
        }

        return back()->with('error', __('page.front.message.error'));
    }
}
