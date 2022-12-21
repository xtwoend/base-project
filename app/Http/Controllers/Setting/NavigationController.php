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
        $icons = config('icons');
        return view('navigation.create', compact('icons'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'route' => 'required',
        ]);

        $input = $request->all();
        $input['parent_id'] = $request->parent_id ?: NULL;

        Navigation::create($input);

        return redirect()->route('setting.navigation');
    }

    public function edit($id)
    {
        $nav = Navigation::findOrFail($id);
        $icons = config('icons');

        return view('navigation.edit', compact('nav', 'icons'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'route' => 'required',
        ]);

        $input = $request->all();
        $input['parent_id'] = $request->parent_id ?: null;

        $nav = Navigation::find($id);
        $nav->fill($input);
        $nav->save();

        return redirect()->route('setting.navigation');
    }

    public function destroy($id)
    {
        $nav = Navigation::findOrFail($id);

        return $nav->delete();
    }
}
