<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) 
    {
        // get user paginate 10
        $users = DB::table('users')
            ->when($request->keyword, function($query) use ($request){
                $query->where('name', 'like', "%{$request->keyword}%")
                    ->orWhere('email', 'like', "%{$request->keyword}%")    
                    ->orWhere('phone', 'like', "%{$request->keyword}%"); 
            })->orderBy('id', 'asc')->paginate(10);

        return view('pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'required',
            'roles' => 'required',
        ]);
        User::create($request->all());

        return redirect()->route('users.index')->with('Success', 'User created success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->roles = $request->roles;
        $user->save();

        // check phone number is not empty
        if($request->phone){
           $user->update(['phone' => $request->phone]);
        }
        // check password is not empty
        if($request->password){
           $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('users.index')->with('Success', 'User update success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
