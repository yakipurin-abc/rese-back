<?php

namespace App\Http\Controllers;

use App\Models\Muser;
use Illuminate\Http\Request;

class MuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Muser::all();
        $musers = Muser::with('role')->get();
        return response()->json([
            'data' => $items,
            'muser' => $musers,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Muser  $muser
     * @return \Illuminate\Http\Response
     */
    public function show(Muser $muser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Muser  $muser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Muser $muser)
    {
        $update = [
            'name' => $request->name,
            'role_id' => $request->role_id,

        ];
        $item = Muser::where('id', $muser->id)->update($update);
        if ($item) {
            return response()->json(
                [
                    'message' => 'Updated successfully',
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'message' => 'Not found',
                ],
                404
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Muser  $muser
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $item = Muser::find($request->id)->delete();
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
