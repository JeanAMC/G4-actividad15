<?php
use App\Models\Task;
use App\Models\User;

it('show a specific task', function () {
    $task = Task::factory()->create();

    $response = $this->get("/tasks/{$task->id}");

    $response->assertStatus(200);
    $response->assertViewIs('tasks.show');
    $response->assertViewHas('task', function ($viewTask) use ($task) {
        return $viewTask->id === $task->id;
    });
});