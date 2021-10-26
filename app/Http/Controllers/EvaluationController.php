<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Evaluation::all();
        return response()->json([
            'items' => $items,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = Evaluation::create($request->all());
        return response()->json([
            'data' => $item,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function show($shop_id)
    {
        $items = Evaluation::with('shop')->where('shop_id', $shop_id)->get();
        if ($items) {
            return response()->json([
                'data' => $items,
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluation $evaluation)
    {
        $item = Evaluation::where('id', $evaluation->id)->delete();
        if ($item) {
            return response()->json([
                'message' => 'Deleted successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }
    public function checkEva(Request $request)
    {
        $items = Evaluation::where('shop_id', $request->shop_id)->where('user_id', $request->user_id)->get();
        if ($items) {
            return response()->json([
                'data' => $items,
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }
    }
}
