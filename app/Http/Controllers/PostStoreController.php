<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;

class PostStoreController extends Controller
{
    public function __invoke(PostRequest $request)
    {
        $post = $request->validated();

        if ($request->hasFile('image')) {
            $post['image'] = $request->file('image')->store('posts', 'public');
        }

        auth()->user()->posts()->create($post);
        return redirect()->route('home')->with('success', "You have successfully created post.");
    }
}
