<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

final class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}
