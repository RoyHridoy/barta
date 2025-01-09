<?php

use App\Livewire\CommentItem;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;

it('ensures that reply action is only available for parent comments', function () {
    // Arrange
    User::factory()->create();
    Post::factory()->create();
    $parentComment = Comment::factory()->create();
    $replyComment = Comment::factory()->create(['parent_id' => $parentComment->id]);

    $randomUser = User::factory()->create();

    // Act and Assert
    Livewire::actingAs($randomUser)
        ->test(CommentItem::class, ['comment' => $parentComment])
        ->assertSeeHtml("data-comment-id=\"{$parentComment->id}\"");

    Livewire::actingAs($randomUser)
        ->test(CommentItem::class, ['comment' => $replyComment])
        ->assertDontSeeHtml("data-comment-id=\"{$replyComment->id}\"");
});

it('validates reply form field', function () {
    // Arrange
    $user = User::factory()->create();
    Post::factory()->create();
    $comment = Comment::factory()->create();

    // Act and Assert
    Livewire::actingAs($user)
        ->test(CommentItem::class, ['comment' => $comment])
        ->set('createReplyForm.body', '')
        ->call('reply')
        ->assertHasErrors(['createReplyForm.body' => 'required']);
});

it('can reply comment successfully', function () {
    // Arrange
    User::factory()->create();
    Post::factory()->create();
    $comment = Comment::factory()->create();
    $randomUser = User::factory()->create();

    // Act and Assert
    Livewire::actingAs($randomUser)
        ->test(CommentItem::class, ['comment' => $comment])
        ->set('createReplyForm.body', 'This is a reply comment')
        ->call('reply')
        ->assertHasNoErrors()
        ->assertSet('createReplyForm.body', '')
        ->assertSee('This is a reply comment');

    $this->assertDatabaseHas('comments', [
        'body' => 'This is a reply comment',
        'user_id' => $randomUser->id,
        'parent_id' => $comment->id,
    ]);
});
