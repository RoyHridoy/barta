<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $search = $request->query('search');
        $posts = Post::with('user')->withCount('comments')
                    ->when(request()->query('search'), function ($query) use ($search) {
                        $query->whereRelation('user', 'username', 'LIKE', "%{$search}%")
                            ->orWhereRelation('user', 'email', 'LIKE', "%{$search}%")
                            ->orWhereRelation('user', function ($query) use ($search) {
                                $query->whereRaw("firstName || ' ' || lastName like '%{$search}%'");
                            });
                    })
                    ->latest()
                    ->paginate(10);
        $posts->appends(['search' => request()->query('search')]);
        return view('index', compact('posts'));
    }
}
