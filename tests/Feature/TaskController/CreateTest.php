<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('The aplication creates a user', function () {
    
    // Arrange
    $user = \App\Models\User::factory()->create();
    $this->actingAs($user);


    // Act
    $response = $this->post(route('tasks.store'), [
        'name' => 'Test Task',
        'user_id' => $user->id,
    ]);

    // Assert
    $response->assertRedirect(route('tasks.index'));
    $this->assertDatabaseHas('tasks', [
        'name' => 'Test Task',
        'user_id' => $user->id,
    ]);

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
    ]);
    $this->assertDatabaseHas('tasks', [
        'name' => 'Test Task',
        'user_id' => $user->id,
    ]);
    $this->assertCount(1, \App\Models\Task::all());
    $this->assertCount(1, \App\Models\User::all());
    $this->assertEquals('Test Task', \App\Models\Task::first()->name);

});