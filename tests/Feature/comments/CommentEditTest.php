<?php

use App\Livewire\CommentItem;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;

it('shows comment edit action to the authorize user', function () {
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
        ->assertDontSee('Edit Comment');

    Livewire::actingAs($user1)
        ->test(CommentItem::class, ['comment' => $userOneComment])
        ->assertSee('Edit Comment');
});

it('loads comment edit form to the authorize user', function () {
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
    Livewire::actingAs($user1)
        ->test(CommentItem::class, ['comment' => $userOneComment])
        ->assertSee('Update')
        ->assertSee('Cancel')
        ->assertSee(['commentEditForm.body' => 'Old Comment']);

    Livewire::actingAs($randomUser)
        ->test(CommentItem::class, ['comment' => $userOneComment])
        ->call('edit')
        ->assertStatus(403)
        ->assertDontSee('Update')
        ->assertDontSee('Cancel');
});

it('validates comment edit form field', function () {
    // Arrange
    $user = User::factory()->create();
    $post = Post::factory()->create();
    $comment = Comment::factory()->create([
        'post_id' => $post->id,
        'user_id' => $post->id,
    ]);

    // Act and Assert
    Livewire::actingAs($user)
        ->test(CommentItem::class, ['comment' => $comment])
        ->set('commentEditForm.body', '')
        ->call('edit')
        ->assertHasErrors(['commentEditForm.body' => 'required']);
});

it('allows only authorized user for updating comment', function () {
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
    Livewire::actingAs($user1)
        ->test(CommentItem::class, ['comment' => $userOneComment])
        ->set(['commentEditForm.body' => 'New Comment'])
        ->call('edit')
        ->assertSee('New Comment');

    $this->assertDatabaseHas('comments', [
        'body' => 'New Comment',
        'id' => $userOneComment->id,
        'post_id' => $post->id,
    ]);

    Livewire::actingAs($randomUser)
        ->test(CommentItem::class, ['comment' => $userOneComment])
        ->call('edit')
        ->assertStatus(403);
});
