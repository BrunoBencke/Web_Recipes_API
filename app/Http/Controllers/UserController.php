<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'name',
                'email',
                'password',
            ]);

            $user = new User();
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->email = $request->email;
            $user->save();
            return ['retorno'=>'ok'];
        } catch(\Exception $erro){
            return ['retorno'=>'erro', 'details'=>$erro];
        }
    }
}
