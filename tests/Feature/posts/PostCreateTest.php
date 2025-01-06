<?php

use App\Livewire\PostIndex;
use App\Models\User;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use function Pest\Laravel\actingAs;

it('renders post creation component', function () {
    $user = User::factory()->create();
    actingAs($user);

    Livewire::test(PostIndex::class)
        ->assertOk()
        ->assertSeeHtml("What's going on, {$user->firstName}?")
        ->assertSee('Post')
        ->assertSee('Picture');
});

it('validates barta field', function(){
    $user = User::factory()->create();
    actingAs($user);

    Livewire::test(PostIndex::class)
        ->assertOk()
        ->set('form.barta', '')
        ->call('save')
        ->assertHasErrors(['form.barta' => 'required']);
});

it('handles barta photo uploads', function(){
    $user = User::factory()->create();
    actingAs($user);

    Storage::fake('public');

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

it('creates barta', function(){
    $user = User::factory()->create();
    actingAs($user);

    Livewire::test(PostIndex::class)
        ->set('form.barta', 'Barta content')
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('posts', [
        'user_id' => $user->id,
        'barta' => 'Barta content'
    ]);
});

it('creates barta with photo', function(){
    $user = User::factory()->create();
    actingAs($user);

    $photo = UploadedFile::fake()->image('photo.jpg');

    Livewire::test(PostIndex::class)
        ->set('form.barta', 'Barta content')
        ->set('form.tempPhoto', $photo)
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('posts', [
        'user_id' => $user->id,
        'barta' => 'Barta content'
    ]);
});
