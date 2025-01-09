<?php

use App\Livewire\Comments;
use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;

it('ensures only an user can see comment creation form', function () {
    // Arrange
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);

    // Act and Assert
    $this->get(
        route('posts.show', ['post' => $post->id])
    )
        ->assertRedirect(route('login'));

    $this->actingAs($user)
        ->get(
            route('posts.show', ['post' => $post->id])
        )
        ->assertSee('Write a comment')
        ->assertSee('Comment');
});

it('validates comment form field', function () {
    // Arrange
    $user = User::factory()->create();
    $post = Post::factory()->create();

    // Act and Assert
    Livewire::actingAs($user)
        ->test(Comments::class, ['post' => $post])
        ->set('createCommentForm.body', '')
        ->call('createComment')
        ->assertHasErrors(['createCommentForm.body' => 'required']);
});

it('can create comment successfully', function () {
    // Arrange
    $user = User::factory()->create();
    $post = Post::factory()->create();

    // Act and Assert
    Livewire::actingAs($user)
        ->test(Comments::class, ['post' => $post])
        ->set('createCommentForm.body', 'This is a comment')
        ->call('createComment')
        ->assertSee('This is a comment');

    $this->assertDatabaseHas('comments', [
        'body' => 'This is a comment',
        'user_id' => $user->id,
    ]);
});

it('can successfully count total comments', function () {
    // Arrange
    $user = User::factory()->create();
    $post = Post::factory()->create();

    // Act and Assert
    Livewire::actingAs($user)
        ->test(Comments::class, ['post' => $post])
        ->assertSeeText(0);

    Livewire::actingAs($user)
        ->test(Comments::class, ['post' => $post])
        ->set('createCommentForm.body', 'This is a comment')
        ->call('createComment')
        ->assertSeeText(1);
});
