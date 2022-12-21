<?php

namespace App\Http\Controllers\Setting;

use App\Models\User;
use App\Models\Navigation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * data
     */
    public function data(Request $request)
    {
        $per_page = $request->input('rowsPerPage');
        $users = User::with('permissions')->paginate($per_page);

        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $navs = Navigation::all();
        
        return view('users.create', compact('navs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'permissions' => 'required|array'
        ]);
       
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if($request->permissions) {
            $user->permissions()->sync($request->permissions);
        }

        return redirect()->route('setting.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $navs = Navigation::all();
        $userHasPermissions = $user->permissions()->pluck('navigation_id')->toArray();

        return view('users.edit', compact('user', 'navs', 'userHasPermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'permissions' => 'required|array'
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        
        if($request->has('password') && $request->password != '') {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        if($request->permissions) {
            $user->permissions()->sync($request->permissions);
        }

        return redirect()->route('setting.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       return User::where('root', 0)->where('id', $id)->delete();
    }
}
