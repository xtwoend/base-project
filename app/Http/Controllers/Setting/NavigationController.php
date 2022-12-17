<?php

namespace App\Http\Controllers\Setting;

use App\Models\Navigation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NavigationController extends Controller
{
    public function index()
    {
        $navigations = Navigation::orderBy('order')->get();
        return view('navigation.index', compact('navigations'));
    }
}
