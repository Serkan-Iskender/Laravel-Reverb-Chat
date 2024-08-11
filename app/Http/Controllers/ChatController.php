<?php

namespace App\Http\Controllers;

use App\Events\SendMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        if (auth()->guest()) {
            return view('auth');
        }

        $user = auth()->user();

        return view('chat', compact('user'));
    }

    public function sendMessage(Request $request)
    {
        if (auth()->guest()) {
            return response()->json(['status' => 'Giriş yapmalısınız.']);
        }

        $user = auth()->user();
        $message = $request->input('message');

        SendMessage::dispatch($user, $message);

        return response()->json(['status' => 'Mesaj gönderildi.']);
    }
}
