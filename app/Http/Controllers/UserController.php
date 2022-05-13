<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'foto' => 'required',
            'password' => ['required', 'min:6']
        ]);
        $user = User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'foto' => $request->foto,
                'password' => Hash::make($request->password)
            ]
        );

        return UserResource::make($user)->additional([
            'token' => $user->createToken('cook4life')->plainTextToken
        ]);
    }
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
        {
            $this->store($request);
        }

        User::where('email', $request['email'])->update(['foto' =>$request->foto]);
        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('cook4life')->plainTextToken;

        return UserResource::make($user)->additional([
            'token' => $token
        ]);
    }
}
