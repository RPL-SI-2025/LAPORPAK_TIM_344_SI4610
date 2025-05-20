<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\Complaint; // Menggunakan model Complaint yang sesuai dengan laporan
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminLaporanTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test bahwa admin bisa mengakses halaman detail laporan.
     * Pastikan admin dapat mengakses halaman detail laporan.
     */
    public function test_admin_can_access_laporan_detail_page()
    {
        // Buat user admin
        $admin = User::factory()->create(['is_admin' => true]); // pastikan admin ada

        // Buat laporan
        $laporan = Complaint::factory()->create();

        // Login sebagai admin
        $response = $this->actingAs($admin);

        // Akses halaman detail laporan dengan ID laporan yang dibuat
        $response = $this->get(route('admin.laporan.detail', $laporan->id));

        // Pastikan halaman dapat diakses dengan status 200 (berhasil)
        $response->assertStatus(200);
    }

    /**
     * Test bahwa admin bisa mengubah status laporan.
     * Pastikan status laporan bisa diubah sesuai input admin.
     */
    public function test_admin_can_update_laporan_status()
    {
        // Buat user admin
        $admin = User::factory()->create(['is_admin' => true]); // pastikan admin ada

        // Buat laporan dengan status awal 'diajukan'
        $laporan = Complaint::factory()->create([
            'status' => 'diajukan', // status awal
        ]);

        // Login sebagai admin
        $response = $this->actingAs($admin);

        // Kirim permintaan untuk mengubah status laporan
        $response = $this->put(route('admin.laporan.updateStatus', $laporan->id), [
            'status' => 'diverifikasi' // Pilih status baru
        ]);

        // Pastikan status laporan berhasil diubah
        $laporan->refresh();
        $this->assertEquals('diverifikasi', $laporan->status);

        // Pastikan admin diarahkan kembali ke halaman laporan admin
        $response->assertRedirect(route('admin.laporan.index'));
    }

    /**
     * Test bahwa status laporan yang diubah akan tampil sesuai di halaman laporan pengguna.
     * Pastikan perubahan status laporan muncul di halaman pengguna setelah diubah oleh admin.
     */
    public function test_laporan_status_updated_on_user_page()
    {
        // Buat user admin dan laporan
        $admin = User::factory()->create(['is_admin' => true]);
        $laporan = Complaint::factory()->create([
            'status' => 'diajukan', // status awal
        ]);

        // Login sebagai admin dan ubah status laporan
        $response = $this->actingAs($admin)->put(route('admin.laporan.updateStatus', $laporan->id), [
            'status' => 'diverifikasi',
        ]);

        // Cek bahwa status laporan berubah
        $laporan->refresh();
        $this->assertEquals('diverifikasi', $laporan->status);

        // Pastikan laporan ditampilkan dengan status baru pada halaman pengguna
        $response = $this->get(route('laporan.masuk')); // Halaman laporan pengguna
        $response->assertSee('diverifikasi'); // Pastikan status 'diverifikasi' muncul di halaman pengguna
    }
}
