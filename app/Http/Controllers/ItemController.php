<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Items;

class ItemController extends Controller
{
    private function find($id)
    {
        try {
            $item = Items::find($id);
        } catch (Exception $e) {
            return response()->json([
                'errors'    => $e->getMessage()
            ], 400);
        }

        return $item;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = request()->get('page') == 'all' ? 'all' : 
            (request()->get('page') > 1 ? request()->get('page') - 1 : 0);

        try {
            $items = Items::where('is_trash', false)
                            ->orderBy('id', 'desc')
                            ->when($page !== 'all', function ($query) use ($page) {
                                return $query->skip($page * 10)
                                            ->take(10);
                            })
                            ->get();
            
            foreach ($items as $key => $val) {
                $items[$key]['created_date'] = $val['created_at']->format('d M Y H:i');
            }

        } catch (Exception $e) {
            return response()->json([
                'errors'    => $e->getMessage()
            ], 400);
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
            ], 400);
        }

        $item = new Items;
        $item->name = request()->get('name');
        $item->save();

        return response()->json([
            'message'    => 'Data berhasil dimasukkan.'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = $this->find($id);

        if ($item) {
            $item['created_date'] = $item['created_at']->format('d M Y H:i');
            return response()->json($item);
        } else {
            return response()->json([
                'errors'    => 'Tidak dapat menemukan data.'
            ], 400);
        }
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
        if (!request()->has('name')) {
            return response()->json([
                'errors'    => 'Nama harus diisi!'
            ], 400);
        }

        $item = $this->find($id);

        if ($item) {
            $item->name = request()->get('name');
            $item->save();

            return response()->json([
                'message'    => 'Data berhasil diupdate.'
            ], 201);
        } else {
            return response()->json([
                'errors'    => 'Tidak dapat menemukan data.'
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = $this->find($id);

        if ($item) {
            $item->is_trash = true;
            $item->save();

            return response()->json([
                'message'    => 'Data berhasil dihapus.'
            ]);
        } else {
            return response()->json([
                'errors'    => 'Tidak dapat menemukan data.'
            ]);
        }
    }
}
