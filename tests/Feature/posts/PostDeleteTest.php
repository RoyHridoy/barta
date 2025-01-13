<?php

use App\Livewire\PostInfo;
use App\Livewire\PostShow;
use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;

it('shows post delete action to only authorize user', function () {
    // Arrange
    $user1 = User::factory()->create();
    Post::factory()->create(['user_id' => $user1->id]);
    $user2 = User::factory()->create();

    // Act and Assert
    $this->actingAs($user1)->get('/')
        ->assertSee('Delete');

    $this->actingAs($user2)->get('/')
        ->assertDontSee('Delete');
});

it('provides user to delete own post from homepage', function () {
    // Arrange
    $user1 = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user1->id]);
    $user2 = User::factory()->create();

    // Act and Assert
    Livewire::actingAs($user2)
        ->test(PostInfo::class, ['ids', [$post->id]])
        ->call('delete', $post->id)
        ->assertStatus(403);

    Livewire::actingAs($user1)
        ->test(PostInfo::class, ['ids', [$post->id]])
        ->call('delete', $post->id)
        ->assertOk()
        ->assertDontSee($post->barta);

    $this->assertDatabaseMissing('posts', [
        'id' => $post->id,
    ]);
});

it('provides user to delete own post from post show page and redirect to homepage', function () {
    // Arrange
    $user1 = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user1->id]);
    $user2 = User::factory()->create();

    // Act and Assert
    Livewire::actingAs($user2)
        ->test(PostShow::class, ['post' => $post])
        ->call('delete', $post->id)
        ->assertStatus(403);

    Livewire::actingAs($user1)
        ->test(PostShow::class, ['post' => $post])
        ->call('delete', $post->id)
        ->assertRedirectToRoute('home');

    $this->assertDatabaseMissing('posts', [
        'id' => $post->id,
    ]);
});
