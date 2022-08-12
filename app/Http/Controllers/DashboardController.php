<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        return view('dashboard.index');
    }

    public function domains() {
        return view('dashboard.domains')->withDomains(auth()->user()->domains);
    }

    public function support() {
        return view('dashboard.support');
    }

    public function supportSend(Request $request) {
        return back()->with('info', 'Ваш запрос был отправлен, спасибо!');
    }
}
