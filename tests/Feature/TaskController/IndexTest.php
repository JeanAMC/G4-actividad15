<?php


use App\Models\Task;
use App\Models\User;


it('can view tasks', function () {
    $user = User::factory()->create();
    $task = Task::factory()->create(['user_id' => $user->id, 'name' => 'IDENTIDAD']);
    
    $response = $this->actingAs($user)->get(route('tasks.index'));

    $response->assertStatus(200);
    $response->assertSee('IDENTIDAD');
});

it('can filter tasks by user', function () {
    $user = User::factory()->create();
    $user2 = User::factory()->create();
    $task = Task::factory()->create(['user_id' => $user->id, 'name' => 'IDENTIDAD1']);
    $task2 = Task::factory()->create(['user_id' => $user2->id, 'name' => 'IDENTIDAD2']);

    

    $response = $this->actingAs($user)->get(route('tasks.index', ['user_id' => $user->id]));
    $response->assertStatus(200);
    $response->assertSee('IDENTIDAD1');
    $response->assertDontSee('IDENTIDAD2');

});