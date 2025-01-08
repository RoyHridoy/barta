<?php

use App\Livewire\PostEdit;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;

it('shows post edit action to only authorize user', function () {
    // Arrange
    $user1 = User::factory()->create();
    $userOnePost = Post::factory()->create(['user_id' => $user1->id]);
    $user2 = User::factory()->create();
    $userTwoPost = Post::factory()->create(['user_id' => $user2->id]);

    // Act and Assert
    $this->actingAs($user1)->get('/')
        ->assertSee(route('posts.edit', ['post' => $userOnePost]))
        ->assertDontSee(route('posts.edit', ['post' => $userTwoPost]));
});

it('loads post edit page only for the authorize user', function () {
    // Arrange
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);
    $randomUser = User::factory()->create();

    // Act and Assert
    $this->actingAs($user)
        ->get(
            route('posts.edit', ['post' => $post->id])
        )
        ->assertStatus(200);

    $this->actingAs($randomUser)
        ->get(
            route('posts.edit', ['post' => $post->id])
        )
        ->assertStatus(403);
});

it('loads existing post content to the edit page', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user)
        ->get(
            route('posts.edit', ['post' => $post->id])
        )
        ->assertOk()
        ->assertSee($post->barta);
});

it('loads existing post content with photo to the edit page', function () {
    // Arrange
    $user = User::factory()->create();
    $post = Post::factory()->create([
        'user_id' => $user->id,
        'photo' => 'images/test-image.jpg',
    ]);

    // Act and Assert
    $this->actingAs($user)
        ->get(
            route('posts.edit', ['post' => $post->id])
        )
        ->assertOk()
        ->assertSee($post->barta)
        ->assertSee(asset('storage/images/test-image.jpg'));
});

it('validates barta field when updating', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create([
        'user_id' => $user->id,
    ]);

    Livewire::actingAs($user)
        ->test(PostEdit::class, ['post' => $post->id])
        ->assertOk()
        ->set('form.barta', '')
        ->call('update')
        ->assertHasErrors(['form.barta' => 'required']);
});

it('handles barta photo uploads when updating', function () {
    $user = User::factory()->create();

    $post = Post::factory()->create([
        'user_id' => $user->id,
    ]);

    Storage::fake('public');

    // Test with valid photo
    $photo = UploadedFile::fake()->image('photo.jpg');
    Livewire::actingAs($user)
        ->test(PostEdit::class, ['post' => $post->id])
        ->set('form.barta', 'Barta content')
        ->set('form.tempPhoto', $photo)
        ->call('update')
        ->assertHasNoErrors('form.tempPhoto');

    // Test with large photo
    $largePhoto = UploadedFile::fake()->image('large-image.jpg')->size(2048);
    Livewire::actingAs($user)
        ->test(PostEdit::class, ['post' => $post->id])
        ->set('form.barta', 'Barta content')
        ->set('form.tempPhoto', $largePhoto)
        ->call('update')
        ->assertHasErrors(['form.tempPhoto' => 'max']);
});

it('updates barta with new content', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create([
        'barta' => 'Old Content',
        'user_id' => $user->id,
    ]);

    Livewire::actingAs($user)
        ->test(PostEdit::class, ['post' => $post])
        ->set('form.barta', 'New Barta Content')
        ->call('update')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('posts', [
        'user_id' => $user->id,
        'barta' => 'New Barta Content',
    ]);
});

it('updates barta with photo', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create([
        'barta' => 'Old Content',
        'photo' => 'images/existing-photo.jpg',
        'user_id' => $user->id,
    ]);

    Storage::fake('public');
    $newImage = UploadedFile::fake()->image('new-photo.jpg');

    Livewire::actingAs($user)
        ->test(PostEdit::class, ['post' => $post])
        ->set('form.barta', 'New Barta Content')
        ->set('form.tempPhoto', $newImage)
        ->call('update')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('posts', [
        'user_id' => $user->id,
        'barta' => 'New Barta Content',
        'photo' => 'posts/'.$newImage->hashName(),
    ]);

    $this->assertDatabaseMissing('posts', [
        'photo' => 'images/existing-photo.jpg',
    ]);

    Storage::disk('public')->assertExists('posts/'.$newImage->hashName());
});
