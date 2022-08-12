<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeedBackRequest;
use App\Models\FeedBack;
use Illuminate\Http\Request;

class FeedBackController extends Controller
{
    public function contact(StoreFeedBackRequest $request) {
        $feedBack = FeedBack::create($request->validated());
        return redirect()->route('home')->with(['success' => 'Спасибо, ответ придет на указанную почту в течение 3 рабочих дней']);
    }
}
