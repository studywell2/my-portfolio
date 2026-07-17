<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminLiveChatController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.live-chat.reply');
    }
}

