<?php

namespace App\Http\Controllers\Setting;

use App\Models\Svg;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DesignController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * show design
     */
    public function index()
    {
        $files = Svg::paginate(20)->withQueryString();
        return view('design.index', compact('files'));
    }

    /**
     * upload file and redirect to workbench
     */
    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:svg|max:2048',
            'name' => 'required'
        ]);

        if(! $request->file('file')) {
            return back()->withInput();
        }

        $path = $request->file('file')->store('files');
        
        $svg = Svg::create([
            'name' => $request->name,
            'path' => $path
        ]);

        return redirect()->route('setting.design.workbench', $svg->id);
    }

    public function edit($id)
    {
        $svg = Svg::findOrFail($id);
        $files = Svg::paginate(20)->withQueryString();
        return view('design.edit', compact('svg','files'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:svg|max:2048',
            'name' => 'required'
        ]);

        if(! $request->file('file')) {
            return back()->withInput();
        }

        $path = $request->file('file')->store('files');
        
        $svg = Svg::findOrFail($id);
        $svg->update([
            'name' => $request->name,
            'path' => $path
        ]);

        return redirect()->route('setting.design.workbench', $svg->id);
    }

    /**
     * workbench
     */
    public function workbench($id, Request $request)
    {
        $svg = Svg::findOrFail($id);

        return view('design.workbench', compact('svg'));
    }
}
