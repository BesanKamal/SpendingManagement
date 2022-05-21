<?php

namespace App\Http\Controllers;

use App\Models\operation_name;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class OperationNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $operation_name = Operation_name::all();
        return response()->view('cms.operation_names.index',['operation_names' => $operation_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.operation_names.create');
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
           
       ]);
       
      
        if (! $Validator->fails()) {
            $operation_name = new operation_name();
            $operation_name->name = $request->input('name');
            
            $isSaved = $operation_name->save();
           
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
     * @param  \App\Models\operation_name  $operation_name
     * @return \Illuminate\Http\Response
     */
    public function show(operation_name $operation_name)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\operation_name  $operation_name
     * @return \Illuminate\Http\Response
     */
    public function edit(operation_name $operation_name)
    {
        return response()->view('cms.operation_names.edit', ['operation_name' => $operation_name]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\operation_name  $operation_name
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, operation_name $operation_name)
    {
        $Validator = Validator($request->all(), [
            'name' => 'required',
            
       ]);
       
      
        if (!$Validator->fails()) {
            $operation_name = new operation_name();
            $operation_name->name = $request->input('name');
            
            $isSaved = $operation_name->save();
           
            return response()->json(
                ['message' => $isSaved ? 'Updated Successfully' : 'Update Failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
            
        } else {
            return response()->json(
                ['message' => $Validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\operation_name  $operation_name
     * @return \Illuminate\Http\Response
     */
    public function destroy(operation_name $operation_name)
    {
        $deleted = $operation_name->delete();
        return response()->json(
         ['message'=> $deleted ? 'Deleted Successfully' : 'Delete Faild!'], 
         $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST 
        );
    }
}
