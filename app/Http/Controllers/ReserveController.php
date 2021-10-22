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
    public function index(Request $request)
    {
        if (empty($request->user_id) ) {
            $items = Reserve::all();
            return response()->json([
                'data' => $items,
            ], 200);
        }
        list($reserves, $items, ) = $this->reservesUser($request->id, $request->user_id);
        return response()->json([
            'data' => $reserves,
            'items' => $items,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $name = $request->input('name');
        $user_id = $request->input('user_id');
        $shop_id = $request->input('shop_id');
        $date = $request->input('date');
        $time = $request->input('time');
        $number = $request->input('number');
        $item = new Reserve;
        $item->user_id = $user_id;
        $item->name = $name;
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
        $items = Reserve::with('shop')->where('shop_id', $request->shop_id)->get();
        if ($items) {
            return response()->json([
                'reserves' => $items,
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

    /**
     * ユーザーが予約しているかを取得
     *
     * @param string $user_id firebaseのユーザーID
     * @return array $shop_id shopのID
     */
    private function reservesUser($shop_id, $user_id)
    {
        $reserves = Reserve::with(['shop.area', 'shop.genre'])->get()->where('shop_id', $shop_id);
        $items = Reserve::with('shop')->where('user_id', $user_id)->get();
        $evaluation =
        Reserve::with('shop')->where('shop_id', $shop_id)->where('user_id', $user_id)->get();
            return [$reserves, $items, $evaluation] ;
    }

    public function get(Request $request)
    {
        $reserves = Reserve::with('shop')->where('shop_id', $request->shop_id)->get();

        if ($reserves) {
            return response()->json([
                'message' => 'Reserves got successfully',
                'data' => $reserves,
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }
    }
}