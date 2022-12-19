<?php

namespace App\Http\Controllers\Setting;

use App\Models\Navigation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class NavigationController extends Controller
{
    public function index()
    {
        $navigations = Navigation::tree();
        return view('navigation.index', compact('navigations'));
    }

    public function create()
    {
        return view('navigation.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'route' => 'required',
        ]);

        Navigation::create($request->all());

        return redirect()->route('setting.navigations');
    }
}
