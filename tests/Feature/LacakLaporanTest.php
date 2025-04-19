<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Report;
use App\Models\User;

class LacakLaporanTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_access_track_report_page()
    {
        $response = $this->get(route('lacak-laporan'));
        $response->assertStatus(200);
        $response->assertViewIs('reports.track');
    }

    /** @test */
    public function user_can_access_track_report_page()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('lacak-laporan'));
        $response->assertStatus(200);
        $response->assertViewIs('reports.track');
    }

    /** @test */
    public function guest_can_search_report_with_valid_number()
    {
        $report = Report::factory()->create([
            'nomor_laporan' => 'LAP123456',
            'status' => 'Selesai',
        ]);
        $response = $this->post(route('report.search'), [
            'nomor_laporan' => 'LAP123456',
        ]);
        $response->assertStatus(200);
        $response->assertViewIs('reports.detail');
        $response->assertSee('LAP123456');
    }

    /** @test */
    public function user_can_search_report_with_valid_number()
    {
        $user = User::factory()->create();
        $report = Report::factory()->create([
            'nomor_laporan' => 'LAP123456',
            'status' => 'Diproses',
        ]);
        $response = $this->actingAs($user)->post(route('report.search'), [
            'nomor_laporan' => 'LAP123456',
        ]);
        $response->assertStatus(200);
        $response->assertViewIs('reports.detail');
        $response->assertSee('LAP123456');
    }

    /** @test */
    public function search_report_with_invalid_number_returns_error()
    {
        $response = $this->post(route('report.search'), [
            'nomor_laporan' => 'TIDAKADA',
        ]);
        $response->assertRedirect();
        $response->assertSessionHas('error', 'Nomor laporan tidak ditemukan');
    }
}