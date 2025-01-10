<?php

use App\Livewire\Comments;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Notifications\CommentCreated;
use Livewire\Livewire;

test('comment notification', function () {
    // Arrange
    $commentOwner = User::factory()->create();
    $postOwner = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $postOwner->id]);
    $comment = Comment::factory()->create([
        'post_id' => $post->id,
        'user_id' => $commentOwner->id,
    ]);

    Notification::fake();

    // Act and Assert
    Livewire::actingAs($commentOwner)
        ->test(Comments::class, ['post' => $post])
        ->set('createCommentForm.body', 'A new comment')
        ->call('createComment');

    Notification::assertSentTo($postOwner, CommentCreated::class);
});
