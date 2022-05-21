<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Dotenv\Validator;
use App\Models\User;
use App\Models\income_side;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $incomes = Income::all();
        return response()->view('cms.income.index',['incomes' => $incomes]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $income_sides = Income_Side::all();

        return response()->view('cms.income.create',['users' => $users,'income_sides' => $income_sides]);
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
            'currency' => 'required',
            'user_id' => 'required',
            'name_income_side' => 'required',
       ]);
       
      
        if (! $Validator->fails()) {
            $income = new Income();
            $income->currency = $request->input('currency');
            $income->user_id = $request->input('user_id');
            $income->name_income_side = $request->input('name_income_side');
            $isSaved = $income->save();
           
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
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        dd('SHOW');
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
        //
        return response()->view('cms.income.edit', ['income' => $income]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Income $income)
    {
       
        $Validator = Validator($request->all(), [
            'currency' => 'required',
            'user_id' => 'required',
            'name_income_side' => 'required',
       ]);
       
      
        if (!$Validator->fails()) {
            $income = new Income();
            $income->currency = $request->input('currency');
            $income->user_id = $request->input('user_id');
            $income->name_income_side = $request->input('name_income_side');
            $isSaved = $income->save();
           
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
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        //
       $deleted = $income->delete();
       return response()->json(
        ['message'=> $deleted ? 'Deleted Successfully' : 'Delete Faild!'], 
        $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST 
       );
    }
}
