<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Items;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = request()->get('page') > 1 ? request()->get('page') - 1 : 0;

        try {
            $items = Items::orderBy('id', 'desc')
                            ->skip($page * 10)
                            ->take(10)
                            ->get();
            
            foreach ($items as $key => $val) {
                $items[$key]['created_date'] = $val['created_at']->format('d M Y H:i');
            }

        } catch (Exception $e) {
            return response()->json([
                'errors'    => $e->getMessage()
            ]);
        }

        return response()->json([
            'items' => $items,
            'count' => count($items)
        ]);
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
        if (!request()->has('name')) {
            return response()->json([
                'errors'    => 'Nama harus diisi!'
            ]);
        }

        $item = new Items;
        $item->name = request()->get('name');
        $item->save();

        return response()->json([
            'message'    => 'Data berhasil dimasukkan.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
