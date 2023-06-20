<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $post = Post::search(trim($request->get('search')) ?? '');

        if ($request->get('category_id')) {
            $post->where('category_id', $request->get('category_id'));
        }

        if ($request->get('order_by')) {
            $orderBy = explode(',', $request->get('order_by'));
            $post->orderBy($orderBy[0], $orderBy[1] ?? 'asc');
        }

        return response()->json([
            'data' => $post->get(),
            'status' => 200,
        ]);
    }
}
