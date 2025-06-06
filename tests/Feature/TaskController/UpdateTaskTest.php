<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('updates a task name', function () {
    $user = User::factory()->create();
    $task = Task::factory()->create([
        'name' => 'Original',
        'user_id' => $user->id,
    ]);

    $response = $this->put(route('tasks.update', $task), [
        'name' => 'Updated Name',
    ]);

    $response->assertRedirect(route('tasks.index'));

    $this->assertEquals('Updated Name', $task->fresh()->name);
});

