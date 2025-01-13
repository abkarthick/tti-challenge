<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthProjectTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_user_and_get_token()
    {
        // Step 1: Register a new user
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(201);
        $this->assertArrayHasKey('token', $response->json());

        // Save the token for use in other tests
        $token = $response->json('token');
        $this->assertNotEmpty($token);
    }

    public function test_login_user_and_access_protected_routes()
    {
        // Step 2: Create a user directly in the database
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Step 3: Login to get a token
        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $this->assertArrayHasKey('token', $response->json());
        $token = $response->json('token');

        // Step 4: Use the token to access protected routes
        $this->withHeaders(['Authorization' => "Bearer $token"])
            ->getJson('/api/projects')
            ->assertStatus(200);
    }

    public function test_create_project_with_authenticated_user()
    {
        // Step 1: Create a user and login to get a token
        $user = User::factory()->create();
        $token = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->json('token');

        // Step 2: Use the token to create a project
        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
            ->postJson('/api/projects', [
                'title' => 'New Project',
                'description' => 'Project description',
                'status' => 'open',
            ]);

        $response->assertStatus(201);
        $response->assertJsonFragment(['title' => 'New Project']);
    }

    public function test_create_task_under_project()
    {
        // Step 1: Create a user, login, and create a project
        $user = User::factory()->create();
        $token = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->json('token');

        $project = Project::factory()->create();

        // Step 2: Use the token to create a task under the project
        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
            ->postJson("/api/projects/{$project->id}/tasks", [
                'title' => 'New Task',
                'description' => 'Task description',
                'status' => 'to_do',
            ]);

        $response->assertStatus(201);
        $response->assertJsonFragment(['title' => 'New Task']);
    }

    public function test_access_protected_routes_without_token()
    {
        $response = $this->getJson('/api/projects');
        $response->assertStatus(401);
    }
}
