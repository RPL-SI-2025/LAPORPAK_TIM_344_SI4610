<?php
namespace Tests\Feature;

use App\Models\User;
use App\Models\Laporan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LacakLaporanTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_laporan_status_with_valid_nomor_laporan()
    {
        // Arrange: buat user & laporan
        $user = User::factory()->create();
        $laporan = Laporan::factory()->create([
            'id_user' => $user->id,
            'status_laporan' => 'Diproses',
        ]);

        // Act: login dan akses halaman lacak laporan
        $response = $this->actingAs($user)->get('/lacak-laporan');

        $response->assertStatus(200); // halaman tersedia

        // Masukkan nomor laporan valid
        $response = $this->post('/lacak-laporan/cari', [
            'id_laporan' => $laporan->id_laporan,
        ]);

        // Assert: diarahkan ke halaman status
        $response->assertRedirect("/lacak-laporan/{$laporan->id_laporan}");

        // Tampilkan status
        $this->get("/lacak-laporan/{$laporan->id_laporan}")
             ->assertSee($laporan->status_laporan);
    }

    /** @test */
    public function user_sees_error_when_laporan_not_found()
    {
        // Arrange: user login
        $user = User::factory()->create();

        // Act: user coba cari laporan dengan id yang tidak ada
        $response = $this->actingAs($user)->post('/lacak-laporan/cari', [
            'id_laporan' => 9999, // ID tidak ada
        ]);

        // Assert: sistem tampilkan pesan error
        $response->assertRedirect('/lacak-laporan');
        $response->assertSessionHas('error', 'Data Tidak Ditemukan');
    }
}