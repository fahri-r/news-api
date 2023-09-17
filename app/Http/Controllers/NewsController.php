<?php

namespace App\Http\Controllers;

use App\Events\NewsLog;
use App\Models\Author;
use App\Models\File;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class NewsController extends BaseController
{
    public function index(Request $request)
    {
        $data = News::with(['author', 'image'])->get();
        $total = News::count();
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

        $author = Author::find(auth()->user()->user_id);

        if ($request->has('file')) {
            $file = $request->file('file')->storeOnCloudinary();

            $file_result = File::create([
                'url' => $file->getSecurePath(),
                'name' => $file->getOriginalFileName(),
                'type' => $file->getFileType(),
                'size' => $file->getSize(),
            ]);
        }

        $data = News::create([
            'title' => $request->title,
            'content' => $request->content,
            'published' => $request->published ?? false,
            'author_id' => $author->author_id,
            'slug' => $this->slugify($request->title),
            'file_id' =>  $file_result->file_id ?? null,
        ]);

        Event::dispatch(new NewsLog($data->slug, 'Create News'));

        return response()->json([
            "status" => true,
            "data" => $data
        ]);
    }


    public function show(string $slug)
    {
        $data = News::with(['author', 'image', 'comments'])->where('slug', $slug)->firstOrFail();

        return response()->json([
            "status" => true,
            "data" => $data
        ]);
    }


    public function update(Request $request, string $slug)
    {
        $data = News::where('slug', $slug)->firstOrFail();

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'published' => 'nullable',
        ]);

        $author = Author::find(auth()->user()->user_id);

        $data->title = $request->title;
        $data->content = $request->content;
        $data->published = $request->published ?? false;
        $data->author_id = $author->author_id;
        $data->slug = $this->slugify($request->title);
        $data->save();

        Event::dispatch(new NewsLog($data->slug, 'Update News'));

        return response()->json([
            "status" => true,
            "data" => $data
        ]);
    }


    public function destroy(string $slug)
    {
        $data = News::where('slug', $slug)->firstOrFail();
        $data->delete();

        Event::dispatch(new NewsLog($data->slug, 'Delete News'));

        return response()->json([
            "status" => true,
            "data" => $data
        ]);
    }
}
