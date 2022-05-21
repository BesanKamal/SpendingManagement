<?php

namespace App\Http\Controllers;

use App\Models\spending;
use App\Models\operation_name;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class SpendingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $spendings = Spending::all();
        return response()->view('cms.spendings.index',['spendings' => $spendings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $operation_name = Operation_name::all();
        return response()->view('cms.spendings.create',['users' => $users,'operation_names' => $operation_name]);


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
            'quantity' => 'required',
            'price' => 'required',
            'operation_name_id' => 'required',
            
            
       ]);
       
      
        if (! $Validator->fails()) {
            $spending = new spending();
            $spending->quantity = $request->input('quantity');
            $spending->price = $request->input('price');
            $spending->operation_name_id = $request->input('operation_name_id');
            $isSaved = $spending->save();
           
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
     * @param  \App\Models\spending  $spending
     * @return \Illuminate\Http\Response
     */
    public function show(spending $spending)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\spending  $spending
     * @return \Illuminate\Http\Response
     */
    public function edit(spending $spending)
    {
        return response()->view('cms.spendings.edit', ['spending' => $spending]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\spending  $spending
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, spending $spending)
    {
        $Validator = Validator($request->all(), [
            'quantity' => 'required',
            'price' => 'required',
            'operation_name_id' => 'required',

            
            
       ]);
       
      
        if (! $Validator->fails()) {
            $spending = new spending();
            $spending->quantity = $request->input('quantity');
            $spending->price = $request->input('price');
            $spending->operation_name_id = $request->input('operation_name_id');
            $isSaved = $spending->save();
           
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
     * @param  \App\Models\spending  $spending
     * @return \Illuminate\Http\Response
     */
    public function destroy(spending $spending)
    {
       
        $deleted = $spending->delete();
        return response()->json(
         ['message'=> $deleted ? 'Deleted Successfully' : 'Delete Faild!'], 
         $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST 
        );

    }
}
