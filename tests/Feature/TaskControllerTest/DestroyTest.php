<?php

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can delete a task and redirect to index', function () {
    $task = Task::factory()->create();

    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
    ]);

    $response = $this->delete(route('tasks.destroy', $task));

    $response->assertRedirect(route('tasks.index'));
    $this->assertDatabaseMissing('tasks', [
        'id' => $task->id,
    ]);
});
