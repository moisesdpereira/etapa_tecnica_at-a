<?php

namespace App\Http\Controllers;

use App\Mail\NewUser;
use App\Mail\NovoUsuario;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $department = Department::all();
        return view('user.create', compact('department'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = new User();
        $user->name = $request->input('name');
        $user->department_id = $request->input('department');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        $user->save();

        Mail::to($user)
            ->send(new NewUser($user));

        return Redirect::route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $department = Department::all();
        return view('user.edit', compact('user', 'department'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->input('name');
        $user->department_id = $request->input('department');
        $user->email = $request->input('email');

        $user->save();

        return Redirect::route('user.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return Redirect::route('user.index');
    }
}
