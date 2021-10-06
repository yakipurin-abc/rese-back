<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;

class ReserveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $user_id = $request->input('user_id');
        $shop_id = $request->input('shop_id');
        $date = $request->input('date');
        $time = $request->input('time');
        $number = $request->input('number');
        $item = new Reserve;
        $item->user_id = $user_id;
        $item->shop_id = $shop_id;
        $item->date = $date;
        $item->time = $time;
        $item->number = $number;
        $item->save();
        return response()->json([
            'message' => 'Reservation created successfully',
            'data' => $item
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $reserves =
        Reserve::with(['shop.area', 'shop.genre', 'user'])->get()->where('shop_id', $request->id);
        $items = Reserve::with('shop')->get()->where('user_id', $request->id);
        if ($items) {
            return response()->json([
                'data' => $items,
                'reserves' =>$reserves
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserve $reserve)
    {
        $update = [
            'shop_id' => $request->shop_id,
            'user_id' => $request->user_id,
            'date' => $request->date,
            'time' => $request->time,
            'number' => $request->number,
        ];
        $item = Reserve::where('id', $reserve->id)->update($update);
        if ($item) {
            return response()->json([
                'message' => 'Updated successfully',
            ],
                200
            );
        } else {
            return response()->json([
                'message' => 'Not found',
            ],
                404
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserve $reserve)
    {
        $item = Reserve::where('id', $reserve->id)->delete();
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
}
