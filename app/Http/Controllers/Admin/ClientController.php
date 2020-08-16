<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the Users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        $owner = 'client';
        return view('admin.profile.client.index', ['profiles' => $model->paginate(15)],compact('owner'));
    }

    /**
     * Show the form for creating a new User
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.profile.client.create');
    }

    /**
     * Store a newly created User in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, User $model)
    {
        $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());

        return redirect()->route('admin.client.index')->with('success','User successfully created.');
    }


    public function edit(User $client)
    {
        $profile = $client;

        $owner = 'client';

        return view('admin.profile.client.edit', compact('profile','owner'));
    }
    /**
     * Update the specified User in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $client
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $client)
    {
        $client->update([
            'name'=>$request->name,
            'status'=>$request->status,
            'email'=>$request->email,
            'country'=>$request->country,
            'phone'=>$request->phone,
        ]);

        return redirect()->back()->with('success','User infomation successfully updated.');
    }

    /**
     * Remove the specified User from storage
     *
     * @param  \App\User  $client
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $client)
    {
        $client->delete();

        return redirect()->route('admin.client.index')->with('success','User successfully deleted.');
    }

    public function password(PasswordRequest $request, User $client)
    {
        $client->update(['password' => Hash::make($request->get('password'))]);

        return back()->with('success','Password successfully updated.');
    }

}
