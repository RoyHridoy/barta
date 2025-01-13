<?php

use App\Livewire\CommentItem;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Notifications\ReplyCreated;
use Livewire\Livewire;

it('ensure user get comment reply notification', function () {
    // Arrange
    $commentOwner = User::factory()->create();
    $postOwner = User::factory()->create();
    $replyOwner = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $postOwner->id]);
    $comment = Comment::factory()->create([
        'post_id' => $post->id,
        'user_id' => $commentOwner->id,
    ]);

    Notification::fake();

    // Act and Assert
    Livewire::actingAs($replyOwner)
        ->test(CommentItem::class, ['comment' => $comment])
        ->set('createReplyForm.body', 'A new comment')
        ->call('reply');

    Notification::assertSentTo($commentOwner, ReplyCreated::class);
});
