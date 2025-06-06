<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskEditTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_shows_the_edit_form_with_task_and_users(): void
    {
        // Arrange
        $user = User::factory()->create();
        $task = Task::factory()->for($user)->create();

        // Act
        $response = $this->get(route('tasks.edit', $task));

        // Assert
        $response->assertStatus(200)
                 ->assertViewIs('tasks.edit')
                 ->assertViewHas(['task', 'users'])
                 ->assertSee($task->name);
    }

    /** @test */
    public function it_updates_a_task_and_redirects(): void
    {
        // Arrange
        $originalUser = User::factory()->create();
        $task         = Task::factory()->for($originalUser)->create([
            'name' => 'Old Name',
        ]);

        $newUser = User::factory()->create();

        // Act
        $response = $this->put(route('tasks.update', $task), [
            'name'    => 'Updated Task',
            'user_id' => $newUser->id,
        ]);

        // Assert redirect + DB changes
        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', [
            'id'   => $task->id,
            'name' => 'Updated Task',
        ]);
    }
}