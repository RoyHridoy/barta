<?php

use App\Livewire\CommentItem;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;

it('shows comment delete action to only authorize user', function () {
    // Arrange
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user2->id]);
    $userOneComment = Comment::factory()->create([
        'user_id' => $user1->id,
        'post_id' => $post->id,
        'body' => 'Old Comment',
    ]);

    // Act and Assert
    Livewire::actingAs($user2)
        ->test(CommentItem::class, ['comment' => $userOneComment])
        ->assertDontSee('Delete Comment');

    Livewire::actingAs($user1)
        ->test(CommentItem::class, ['comment' => $userOneComment])
        ->assertSee('Delete Comment');
});

it('provides user to delete own comment', function () {
    // Arrange
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user2->id]);
    $userOneComment = Comment::factory()->create([
        'user_id' => $user1->id,
        'post_id' => $post->id,
        'body' => 'Old Comment',
    ]);
    $randomUser = User::factory()->create();

    // Act and Assert
    Livewire::actingAs($randomUser)
        ->test(CommentItem::class, ['comment' => $userOneComment])
        ->call('delete')
        ->assertStatus(403);

    Livewire::actingAs($user1)
        ->test(CommentItem::class, ['comment' => $userOneComment])
        ->call('delete')
        ->assertOk()
        ->assertDontSee($userOneComment->body);

    $this->assertDatabaseMissing('comments', [
        'id' => $userOneComment->id,
    ]);
});
