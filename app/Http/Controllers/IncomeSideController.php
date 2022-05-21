<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;

use App\Models\income_side;
use Illuminate\Http\Request;

class IncomeSideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $income_sides = Income_Side::all();
        return response()->view('cms.income_sides.index',['income_sides' => $income_sides]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.income_sides.create');
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
        //
        $validator = Validator($request->all(), [
            'name_income_side' => 'required',
            
        ]);

        if (!$validator->fails()) {
            $income_sides = new income_side();
            $income_sides->name_income_side = $request->input('name_income_side');
            
            $isSaved = $income_sides->save();
           
            return response()->json(
                ['message' => $isSaved ? 'Saved successfully' : 'Save failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\income_side  $income_side
     * @return \Illuminate\Http\Response
     */
    public function show(income_side $income_side)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\income_side  $income_side
     * @return \Illuminate\Http\Response
     */
    public function edit(income_side $income_side)
    {
        return response()->view('cms.income_sides.edit', ['income_side' => $income_side]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\income_side  $income_side
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, income_side $income_side)
    {
        $validator = Validator($request->all(), [
            'name_income_side' => 'required',
            
        ]);

        if (!$validator->fails()) {
            $income_sides = new income_side();
            $income_sides->name_income_side = $request->input('name_income_side');
            
            $isSaved = $income_sides->save();
           
            return response()->json(
                ['message' => $isSaved ? 'Saved successfully' : 'Save failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\income_side  $income_side
     * @return \Illuminate\Http\Response
     */
    public function destroy(income_side $income_side)
    {

        $deleted = $income_side->delete();
        return response()->json(
         ['message'=> $deleted ? 'Deleted Successfully' : 'Delete Faild!'], 
         $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST 
        );
        //
    }
}
