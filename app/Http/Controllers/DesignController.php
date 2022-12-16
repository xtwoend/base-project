<?php

namespace App\Http\Controllers;

use App\Models\Svg;
use Illuminate\Http\Request;

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
        return view('design.index');
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

        return redirect()->route('design.workbench', $svg->id);
    }

    /**
     * workbench
     */
    public function workbench($id, Request $request)
    {
        $svg = Svg::findOrFail($id);

        return view('design/workbench', compact('svg'));
    }
}
