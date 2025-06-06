<?php

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('deletes a task and redirects to the index page', function () {
    $task = Task::factory()->create();

    $response = $this->delete("/tasks/{$task->id}");

    $response->assertRedirect(route('tasks.index'));

    expect(Task::find($task->id))->toBeNull();
});

it('can delete a task with a specific user', function () {
    $user = \App\Models\User::factory()->create();
    $task = Task::factory()->create(['user_id' => $user->id]);

    $response = $this->actingAs($user)->delete(route('tasks.destroy', $task));

    $response->assertRedirect(route('tasks.index'));
    expect(Task::find($task->id))->toBeNull();
});