<?php

use App\Livewire\PostIndex;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

it('ensures only an user can see barta creation form', function () {
    $this->get(route('home'))
        ->assertRedirect(route('login'));
});

it('renders post creation component', function () {
    // Arrange
    $user = User::factory()->create();

    // Act and Assert
    Livewire::actingAs($user)
        ->test(PostIndex::class)
        ->assertOk()
        ->assertSeeHtml("What's going on, {$user->firstName}?")
        ->assertSee('Post')
        ->assertSee('Picture');
});

it('validates barta field', function () {
    // Arrange
    $user = User::factory()->create();

    // Act and Assert
    Livewire::actingAs($user)
        ->test(PostIndex::class)
        ->assertOk()
        ->set('form.barta', '')
        ->call('save')
        ->assertHasErrors(['form.barta' => 'required']);
});

it('handles barta photo uploads', function () {
    // Arrange
    $user = User::factory()->create();
    Storage::fake('public');

    // Act and Assert
    actingAs($user);
    // Test with valid photo
    $photo = UploadedFile::fake()->image('photo.jpg');
    Livewire::test(PostIndex::class)
        ->set('form.barta', 'Barta content')
        ->set('form.tempPhoto', $photo)
        ->call('save')
        ->assertHasNoErrors('form.tempPhoto');

    // Test with large photo
    $largePhoto = UploadedFile::fake()->image('large-image.jpg')->size(2048);
    Livewire::test(PostIndex::class)
        ->set('form.barta', 'Barta content')
        ->set('form.tempPhoto', $largePhoto)
        ->call('save')
        ->assertHasErrors(['form.tempPhoto' => 'max']);
});

it('creates barta', function () {
    // Arrange
    $user = User::factory()->create();

    // Act and Assert
    Livewire::actingAs($user)
        ->test(PostIndex::class)
        ->set('form.barta', 'Barta content')
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('posts', [
        'user_id' => $user->id,
        'barta' => 'Barta content',
    ]);
});

it('creates barta with photo', function () {
    // Arrange
    $user = User::factory()->create();
    Storage::fake('public');
    $photo = UploadedFile::fake()->image('photo.jpg');

    // Act and Assert
    Livewire::actingAs($user)
        ->test(PostIndex::class)
        ->set('form.barta', 'Barta content')
        ->set('form.tempPhoto', $photo)
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('posts', [
        'user_id' => $user->id,
        'barta' => 'Barta content',
        'photo' => 'posts/'.$photo->hashName(),
    ]);

    Storage::disk('public')->assertExists('posts/'.$photo->hashName());
});
