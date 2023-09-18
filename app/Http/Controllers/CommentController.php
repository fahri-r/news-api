<?php

namespace App\Http\Controllers;

use App\Jobs\CreateComment;
use App\Models\Comment;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends BaseController
{
    public function index(Request $request)
    {
        $page = $request->has('page') ? $request->input('page') : 1;
        $per_page = $request->has('per_page') ? (int) $request->input('per_page') : 10;
        $data = Comment::with(['subscriber', 'news'])->paginate($per_page, ['*'], 'page', $page);

        return response()->json([
            'success' => true,
            "data" => $data->items(),
            'total' => $data->total(),
            'per_page' => $data->perPage(),
            'page' => $data->currentPage(),
        ]);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'news_id' => 'required',
            'content' => 'required',
        ]);

        $subscriber = Subscriber::where('user_id', auth()->user()->user_id)->firstOrFail();

        CreateComment::dispatch($request->news_id, $request->content, $subscriber->subscriber_id);

        Log::info('Dispatched comment');

        return response()->json([
            "success" => true,
        ]);
    }


    public function show(string $id)
    {
        $data = Comment::find($id);

        return response()->json([
            "success" => true,
            "data" => $data
        ]);
    }
}
