<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function orders()
    {
        $orders = Auth::user()->orders()->latest()->get();
        return view('profile.orders', compact('orders'));
    }
}