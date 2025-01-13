<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the creation of a project.
     */
    public function testCreateProject()
    {
        $response = $this->postJson('/api/projects', [
            'title' => 'New Project',
            'description' => 'Description for the new project',
            'status' => 'open',
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure(['id', 'title', 'description', 'status']);
    }

    /**
     * Test fetching all projects.
     */
    public function testGetAllProjects()
    {
        Project::factory()->count(3)->create();

        $response = $this->getJson('/api/projects');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    /**
     * Test fetching a single project.
     */
    public function testGetSingleProject()
    {
        $project = Project::factory()->create();

        $response = $this->getJson('/api/projects/' . $project->id);

        $response->assertStatus(200);
        $response->assertJsonFragment(['title' => $project->title]);
    }

    /**
     * Test updating a project.
     */
    public function testUpdateProject()
    {
        $project = Project::factory()->create();

        $response = $this->putJson('/api/projects/' . $project->id, [
            'title' => 'Updated Project Title',
            'description' => 'Updated description',
            'status' => 'completed',
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment(['title' => 'Updated Project Title']);
    }

    /**
     * Test deleting a project.
     */
    public function testDeleteProject()
    {
        $project = Project::factory()->create();

        $response = $this->deleteJson('/api/projects/' . $project->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }
}
