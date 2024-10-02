<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostUpdateController extends Controller
{
    public function __invoke(PostRequest $request, Post $post)
    {
        $updatedData = $request->validated();

        if ($request->hasFile('image') && $post->image) {
            unlink( "storage/" . $post->image );
        }

        if ($request->hasFile('image')) {
            $updatedData['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($updatedData);
        return redirect()->route('posts.show', $post->id)->with('success', "You have successfully updated the post.");
    }
}
