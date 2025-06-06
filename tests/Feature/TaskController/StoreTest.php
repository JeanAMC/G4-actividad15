<?php
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_creates_task_and_redirects()
    {
        $user = User::factory()->create();

        $response = $this->post(route('tasks.store'), [
            'name' => 'Nueva Tarea',
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('tasks', [
            'name' => 'Nueva Tarea',
            'user_id' => $user->id,
        ]);

        $response->assertRedirect(route('tasks.index'));
    }
}
