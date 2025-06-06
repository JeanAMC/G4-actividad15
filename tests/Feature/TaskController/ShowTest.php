<?php
use App\Models\Task;
use App\Models\User;

it('can show a task', function () {
    $user = User::factory()->create();
    $task = Task::factory()->create(['user_id' => $user->id, 'name' => 'IDENTIDAD']);

    $response = $this->actingAs($user)->get(route('tasks.show', $task));

    $response->assertStatus(200);
    $response->assertSee('IDENTIDAD');
});