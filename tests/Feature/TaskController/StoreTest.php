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
        // Arrange: creamos un usuario para asociarlo con la tarea
        $user = User::factory()->create();

        // Act: enviamos una solicitud POST a la ruta del store
        $response = $this->post(route('tasks.store'), [
            'name' => 'Nueva Tarea',
            'user_id' => $user->id,
        ]);

        // Assert: verificamos que la tarea fue creada en la base de datos
        $this->assertDatabaseHas('tasks', [
            'name' => 'Nueva Tarea',
            'user_id' => $user->id,
        ]);

        // Assert: verificamos que redirige a la ruta de index
        $response->assertRedirect(route('tasks.index'));
    }
}
