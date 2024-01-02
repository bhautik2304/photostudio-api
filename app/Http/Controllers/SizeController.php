<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response([
            'sizes' => Size::all(),
            'message' => 'Retrieved successfully',
            'success' => true,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        // Validate the request...
        $size = new Size();
        $size->name = $request->name;
        $size->img = storeFile($request, 'img', '/img/size/');
        $size->save();

        return response([
            'size' => $size,
            'message' => 'Created successfully',
            'success' => true,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Size $size, $id)
    {
        //
        $size = Size::find($id)->update([
            'name' => $request->name,
            // 'img' => storeFile($request, 'img', '/img/size/'),
        ]);

        if ($request->hasFile('img')) {
            Size::find($id)->update([
                'img' => storeFile($request, 'img', '/img/size/'),
            ]);
        }

        return response([
            'message' => 'Updated successfully',
            'success' => true,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size,$id)
    {
        //
        Size::find($id)->delete();
        return response([
            'message' => 'Deleted successfully',
            'success' => true,
        ], 200);
    }
}
