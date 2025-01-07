<?php

use App\Livewire\PostIndex;
use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;
use function Pest\Laravel\actingAs;

it('renders post list component properly', function () {
    actingAs(User::factory()->create());
    Livewire::test(PostIndex::class)
        ->assertOk()
        ->assertViewIs('livewire.post-index');
});

it('mount posts by chunks', function(){
    $user = User::factory()->create();

    Post::factory(20)->create(['user_id' => $user->id]);
    Post::factory(20)->create();

    Livewire::actingAs($user)
        ->test(PostIndex::class)
        ->assertSet('chunks', function($chunks){
            $postsIds = Post::latest()->pluck('id')->toArray();
            $expectedCHunks = collect($postsIds)->chunk(15)->toArray();
            return $chunks === $expectedCHunks;
        });
});

it('loads more increments page', function(){
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(PostIndex::class)
        ->set('page',1)
        ->call('loadMore')
        ->assertSet('page',2);
});

it('checks has more pages', function(){
    $user = User::factory()->create();

    $component = Livewire::actingAs($user)
        ->test(PostIndex::class)
        ->set('chunks', [[1,2,3],[4,5,6]])
        ->set('page',1);

    $result = $component->instance()->hasMorePages();
    self::assertTrue($result);
});

it('checks has no pages', function(){
    $user = User::factory()->create();

    $component = Livewire::actingAs($user)
        ->test(PostIndex::class)
        ->set('chunks', [[1,2,3],[4,5,6]])
        ->set('page',2);

    $result = $component->instance()->hasMorePages();
    self::assertFalse($result);
});
