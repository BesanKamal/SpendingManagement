<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function showLoginView()
    {
        return response()->view('cms.auth.login');
    }

    public function login(Request $request)
    {
            $validator = validator($request->all(), [
                'email' => 'required',
                'password' => 'required',
                'remember' => 'required|boolean',

            ]);

            if(! $validator->fails()){
                $credentials = [
                    'email' => $request->input('email'),
                    'password' => $request->input('password'),
                ];
                if (Auth::guard('admin')->attempt($credentials, $request->input('remember'))) {
                    return response()->json(['message' => 'Logged in successfully']);
                }
                else {
                    return response()->json(['message' => 'Login failed, check credential'], Response::HTTP_BAD_REQUEST);

                }

            } else{

                return response()->json(['message' => $validator->getMessageBag()->first()],
                    Response::HTTP_BAD_REQUEST

                );

            }

    }

    public function logout(Request $request){
    Auth::guard('admin')->logout();
    $request->session()->invalidate();
    return redirect()->route('cms.login');
    }
}
