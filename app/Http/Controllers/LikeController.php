<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (empty($request->user_id)) {
            $items = Like::all();
            $shop = Shop::with('likes')->get();
            return response()->json([
                'data' => $items,
                'shop' => $shop,
            ], 200);
        }
        list($likes, $items) = $this->likesUser($request->user_id);
        return response()->json([
            'data' => $likes,
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
        $item = Like::create($request->all());
        return response()->json([
            'data' => $item,
        ], 201);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        $update = [
            'message' => $request->message,
            'url' => $request->url
        ];
        $item = Like::where('id', $like->id)->update($update);
        if ($item) {
            return response()->json([
                'message' => 'Updated successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $item = Like::where('shop_id', $request->shop_id)->where('user_id', $request->user_id)->delete();
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
     * ユーザーがいいねしているかを取得
     *
     * @param string $user_id firebaseのユーザーID
     * @return array
     */
    private function likesUser($user_id)
    {
        $items = Like::with(['shop.area', 'shop.genre'])->where('user_id', $user_id)->get();
        $likes = Shop::with('area', 'genre')->get();
        foreach ($likes as $like) {
            $item = Like::where('user_id', $user_id)->where('shop_id', $like->id)->get();

            if ($item->isEmpty()) {
                $like->isLike = false;
            } else {
                $like->isLike = true;
            }
        }
        return [$likes, $items];
    }
}
