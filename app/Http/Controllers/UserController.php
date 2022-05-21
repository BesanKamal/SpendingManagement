<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Response;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return response()->view('cms.users.index',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return response()->view('cms.users.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       
        $Validator = Validator($request->all(), [
            'name' => 'required',
            'email' => 'required',
            // 'password' => 'required',
       ]);
       
      
        if (! $Validator->fails()) {
            $user = new user();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            // $user->password = $request->input('password');
            $user->password = Hash::make(12345);
            $isSaved = $user->save();
           
            return response()->json(
                ['message' => $isSaved ? 'Saved successfully' : 'Save failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
            );
        } else {
            return response()->json(
                ['message', $Validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return response()->view('cms.users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
        $Validator = Validator($request->all(), [
            'name' => 'required',
            'email' => 'required',
            // 'password' => 'required',
       ]);
       
      
        if (! $Validator->fails()) {
            $user = new user();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            // $user->password = Hash::make(12345);
            $isSaved = $user->save();
           
            return response()->json(
                ['message' => $isSaved ? 'Saved successfully' : 'Save failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
            );
        } else {
            return response()->json(
                ['message', $Validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $deleted = $user->delete();
       return response()->json(
        ['message'=> $deleted ? 'Deleted Successfully' : 'Delete Faild!'], 
        $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST 
       );

    }
}
