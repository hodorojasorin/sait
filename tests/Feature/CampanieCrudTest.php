<?php

namespace Tests\Feature;

use App\Models\Campanie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CampanieCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_is_available(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Administrezi campaniile');
    }

    public function test_campaign_can_be_created_updated_and_deleted(): void
    {
        $createResponse = $this->post(route('campanii.store'), [
            'client_name' => 'Velox Studio',
            'project_name' => 'Lansare Q2',
            'service_type' => 'seo',
            'status' => 'activa',
            'budget' => '1500.50',
            'launch_date' => '2026-03-15',
            'notes' => 'Campanie pentru cresterea traficului organic.',
        ]);

        $createResponse
            ->assertRedirect(route('campanii.index'))
            ->assertSessionHas('status');

        $campanie = Campanie::firstOrFail();

        $this->assertDatabaseHas('campanii', [
            'client_name' => 'Velox Studio',
            'project_name' => 'Lansare Q2',
            'status' => 'activa',
        ]);

        $updateResponse = $this->put(route('campanii.update', $campanie), [
            'client_name' => 'Velox Studio',
            'project_name' => 'Lansare Q2 - update',
            'service_type' => 'analytics',
            'status' => 'finalizata',
            'budget' => '1850.00',
            'launch_date' => '2026-03-20',
            'notes' => 'Campanie incheiata cu rezultate bune.',
        ]);

        $updateResponse
            ->assertRedirect(route('campanii.index'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('campanii', [
            'id' => $campanie->id,
            'project_name' => 'Lansare Q2 - update',
            'service_type' => 'analytics',
            'status' => 'finalizata',
        ]);

        $deleteResponse = $this->delete(route('campanii.destroy', $campanie));

        $deleteResponse
            ->assertRedirect(route('campanii.index'))
            ->assertSessionHas('status');

        $this->assertDatabaseMissing('campanii', [
            'id' => $campanie->id,
        ]);
    }
}
