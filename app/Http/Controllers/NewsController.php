<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {        
        $data = News::with(['author', 'image'])->get();
        $total = News::count();

        $page = 1;
        if ($request->has('page')) {
            $page = (int) $request->input('page');
        }

        $limit = 10;
        if ($request->has('limit')) {
            $limit = (int) $request->input('limit');
        }
     
        return response()->json([
            'status' => 'ok',
            "data" => $data,
            'total' => $total,
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
