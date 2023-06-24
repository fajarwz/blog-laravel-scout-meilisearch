<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use MeiliSearch\Endpoints\Indexes;
use Illuminate\Database\Eloquent\Builder;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $post = Post::search(trim($request->get('search')) ?? '', 
            function(Indexes $meiliSearch, string $query, array $options) use ($request) {
                if ($request->get('order_by')) {
                    $orderBy = explode(',', $request->order_by);
                    $options['sort'] = [$orderBy[0].':'.($orderBy[1] ?? 'asc')];
                }
                if ($request->get('category_id')) {
                    $options['filter'] = 'category_id = "'.$request->category_id.'"';
                }

                return $meiliSearch->search($query, $options);
            })
            ->query(fn (Builder $query) => $query->with('category'));

        // $post = Post::search(trim($request->get('search')) ?? '');

        // if ($request->get('category_id')) {
        //     $post->where('category_id', $request->get('category_id'));
        // }

        // if ($request->get('order_by')) {
        //     $orderBy = explode(',', $request->get('order_by'));
        //     $post->orderBy($orderBy[0], $orderBy[1] ?? 'asc');
        // }

        return response()->json([
            'data' => $post->get(),
            'status' => 200,
        ]);
    }
}
