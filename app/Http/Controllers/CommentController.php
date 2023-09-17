<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class CommentController extends BaseController
{
    public function index(Request $request)
    {
        $data = Comment::with(['subscriber'])->get();
        $total = Comment::count();
        $page = $request->has('page') ? $request->input('page') : 1;
        $per_page = $request->has('per_page') ? (int) $request->input('per_page') : 10;

        return response()->json([
            'status' => 'ok',
            "data" => $data,
            'total' => $total,
            'per_page' => $per_page,
            'page' => $page,
        ]);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'published' => 'nullable',
        ]);

        $author = Comment::find(auth()->user()->user_id);

        $data = Comment::create([
            'title' => $request->title,
            'content' => $request->content,
            'published' => $request->published ?? false,
            'author_id' => $author->author_id,
            'slug' => $this->slugify($request->title),
        ]);

        return response()->json([
            "success" => true,
            "data" => $data
        ]);
    }


    public function show(string $slug)
    {
        $data = Comment::where('slug', $slug)->firstOrFail();

        return response()->json([
            "success" => true,
            "data" => $data
        ]);
    }


    public function update(Request $request, string $slug)
    {
        $data = Comment::where('slug', $slug)->firstOrFail();
        
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'published' => 'nullable',
        ]);

        $author = Subscriber::find(auth()->user()->user_id);

        $data = Comment::create([
            'title' => $request->title,
            'content' => $request->content,
            'published' => $request->published ?? false,
            'author_id' => $author->author_id,
            'slug' => $this->slugify($request->title),
        ]);

        $data->title = $request->title;
        $data->content = $request->content;
        $data->published = $request->published ?? false;
        $data->author_id = $author->author_id;
        $data->slug = $this->slugify($request->title);
        $data->save();

        return response()->json([
            "success" => true,
            "data" => $data
        ]);
    }


    public function destroy(string $slug)
    {
        $data = Comment::where('slug', $slug)->firstOrFail();
        $data->delete();

        return response()->json([
            "success" => true,
            "data" => $data
        ]);
    }
}
