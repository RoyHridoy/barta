<?php

use App\Livewire\Comments;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;

it('renders comments list properly', function () {
    // Arrange
    $user = User::factory()->create();
    $post = Post::factory()->create();

    // Act and Assert
    Livewire::actingAs($user)
        ->test(Comments::class, ['post' => $post])
        ->assertOk()
        ->assertViewIs('livewire.comments');
});

it('mount comments by chunks', function () {
    // Arrange
    $user = User::factory()->create();
    $post = Post::factory()->create();
    Comment::factory(40)->create(['post_id' => $post->id]);

    // Act and Assert
    Livewire::actingAs($user)
        ->test(Comments::class, ['post' => $post])
        ->assertSet('chunks', function ($chunks) {
            $commentIds = Comment::latest()->pluck('id')->toArray();
            $expectedCHunks = collect($commentIds)->chunk(10)->toArray();

            return $chunks === $expectedCHunks;
        });
});

it('loads more comments', function () {
    // Arrange
    $user = User::factory()->create();
    $post = Post::factory()->create();
    Comment::factory(20)->create();

    // Act and Assert
    Livewire::actingAs($user)
        ->test(Comments::class, ['post' => $post])
        ->set('page', 1)
        ->call('loadMore')
        ->assertSet('page', 2);
});

it('checks more comments availability', function () {
    // Arrange
    $user = User::factory()->create();
    $post = Post::factory()->create();

    // Act and Assert
    $component = Livewire::actingAs($user)
        ->test(Comments::class, ['post' => $post])
        ->set('chunks', [[1, 2, 3], [4, 5, 6]])
        ->set('page', 1);

    $result = $component->instance()->hasMorePages();
    self::assertTrue($result);
});

it('checks no available comments', function () {
    // Arrange
    $user = User::factory()->create();
    $post = Post::factory()->create();

    // Act and Assert
    $component = Livewire::actingAs($user)
        ->test(Comments::class, ['post' => $post])
        ->set('chunks', [[1, 2, 3], [4, 5, 6]])
        ->set('page', 2);

    $result = $component->instance()->hasMorePages();
    self::assertFalse($result);
});
