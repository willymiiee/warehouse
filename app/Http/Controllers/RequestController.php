<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\RequestRule;
use App\User;
use App\Models\Requests as Req;
use App\Http\Controllers\ItemController;
use Carbon\Carbon;

class RequestController extends Controller
{
    protected $item;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->item = app(ItemController::class);
    }

    public function find($id)
    {
        try {
            $req = Req::find($id);
        } catch (Exception $e) {
            return response()->json([
                'errors'    => $e->getMessage()
            ], 400);
        }

        if ($req) {
            $req->user;
            $req->item;
        }
        
        return $req;
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
        
        $status = request()->get('status') ? request()->get('status') : 'pending';

        try {
            $reqs = Req::where('status', $status)
                            ->orderBy('id', 'desc')
                            ->when($page !== 'all', function ($query) use ($page) {
                                return $query->skip($page * 10)
                                            ->take(10);
                            })
                            ->get();
        } catch (Exception $e) {
            return response()->json([
                'errors'    => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'items' => $reqs,
            'count' => count($reqs)
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
    public function store(RequestRule $request)
    {
        $user = User::find($request->get('user_id'));
        $item = $this->item->find($request->get('item_id'));

        if (!$item || !$user) {
            return response()->json([
                'errors'    => 'Data tidak ditemukan!'
            ], 400);
        }

        $req = new Req;
        $req->user_id = $request->get('user_id');
        $req->item_id = $request->get('item_id');
        $req->status = 'pending';
        $req->created_at = Carbon::now('Asia/Jakarta');
        $req->save();

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
        $req = $this->find($id);

        if ($req) {
            return response()->json($req);
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
        if (!request()->has('status')) {
            return response()->json([
                'errors'    => 'Status harus diisi!'
            ], 400);
        }

        $req = $this->find($id);

        if ($req) {
            $req->status = request()->get('status');

            if (request()->get('status') == 'approved') {
                $req->approved_at = Carbon::now('Asia/Jakarta');
            } else {
                $req->rejected_at = new Carbon('Asia/Jakarta');
                $req->reject_note = request()->get('reject_note') ? request()->get('reject_note') : '';
            }

            $req->save();

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
        //
    }
}
