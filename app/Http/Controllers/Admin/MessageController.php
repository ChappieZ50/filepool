<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::orderByDesc('id')->paginate();
        return view('fpool.messages.messages')->with('messages', $messages);
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);
        return view('fpool.messages.message')->with('message', $message);
    }

    public function destroy($id)
    {
        $message = Message::where('id', $id)->first();
        if ($message && $message->delete()) {
            return response()->json(['message' => 'Message successfully deleted.', 'status' => true]);
        }

        return response()->json(['message' => 'Something gone wrong.', 'status' => false], 404);
    }
}
