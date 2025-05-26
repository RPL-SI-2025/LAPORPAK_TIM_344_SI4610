<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

use App\Models\User;
use App\Models\Petugas;
use App\Models\Laporan;

class AdminPetugasCrudTest extends DuskTestCase
{
    /**
     * Bersihkan data dummy setelah setiap testcase.
     */
    protected function tearDown(): void
    {
        // Hapus admin test
        \App\Models\User::where('email', 'like', 'admin_%@mail.com')->delete();
        // Hapus petugas test
        \App\Models\Petugas::where('nama', 'like', 'Petugas %')->delete();
        // Hapus laporan test
        \App\Models\Laporan::where('nomor_laporan', 'like', 'LAPTEST%')->delete();

        parent::tearDown();
    }



    public function test_admin_can_create_petugas()
    {
        $unique = uniqid();
        $admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin_test_' . $unique . '@mail.com'
        ]);
        $this->browse(function (Browser $browser) use ($admin, $unique) {
            $browser->loginAs($admin)
                ->visit('/admin/petugas')
                ->click('@open-tambah-petugas-modal')
                ->whenAvailable('@modal-tambah-petugas', function ($modal) use ($unique) {
                    $modal->type('nama', 'Petugas Dusk ' . $unique)
                          ->type('kontak', '08123456789')
                          ->attach('foto', __DIR__.'/dummy.jpg')
                          ->click('@submit-tambah-petugas');
                })
                ->waitForText('Petugas berhasil ditambahkan', 5)
                ->assertSee('Petugas berhasil ditambahkan');
        });
    }

    public function test_admin_can_view_petugas_list()
    {
        $unique = uniqid();
        $admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin_view_' . $unique . '@mail.com'
        ]);
        $petugas = Petugas::factory()->create(['nama' => 'Petugas List ' . $unique]);
        $this->browse(function (Browser $browser) use ($admin, $unique) {
            $browser->loginAs($admin)
                ->visit('/admin/petugas')
                ->assertSee('Petugas List ' . $unique);
        });
    }

    public function test_admin_can_assign_task_to_petugas()
    {
        $unique = uniqid();
        $admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin_assign_' . $unique . '@mail.com'
        ]);
        $petugas = Petugas::factory()->create(['nama' => 'Petugas Assign ' . $unique]);
        // Ambil nomor laporan yang statusnya diajukan
        $laporan = Laporan::factory()->create([
            'nomor_laporan' => 'LAPTEST' . $unique,
            'status' => 'diajukan'
        ]);

        $this->browse(function (Browser $browser) use ($admin, $petugas, $laporan) {
            $browser->loginAs($admin)
                ->visit('/admin/petugas')
                ->click('@kirim-petugas-btn-' . $petugas->id)
                ->whenAvailable('#kirimPetugasModal' . $petugas->id, function ($modal) use ($laporan) {
                    $modal->type('nomor_laporan', $laporan->nomor_laporan)
                          ->click('@kirim-tugas-submit');
                })
                ->waitForText('Tugas berhasil dikirim', 5)
                ->assertSee('Tugas berhasil dikirim');
        });
    }

    public function test_admin_can_see_verifikasi_laporan_page()
    {
        $unique = uniqid();
        $admin = User::factory()->create(['role' => 'admin', 'email' => 'admin_verif_' . $unique . '@mail.com']);
        $petugas = Petugas::factory()->create(['nama' => 'Petugas Verif ' . $unique]);
        $laporan = Laporan::factory()->create([
            'nomor_laporan' => 'LAPTEST' . $unique,
            'status' => 'diajukan'
        ]);

        // Assign laporan ke petugas
        $this->browse(function (Browser $browser) use ($admin, $petugas, $laporan) {
            $browser->loginAs($admin)
                ->visit('/admin/petugas')
                ->click('@kirim-petugas-btn-' . $petugas->id)
                ->whenAvailable('#kirimPetugasModal' . $petugas->id, function ($modal) use ($laporan) {
                    $modal->type('nomor_laporan', $laporan->nomor_laporan)
                          ->click('@kirim-tugas-submit');
                })
                ->waitForText('Tugas berhasil dikirim', 5)
                // Langsung ke halaman verifikasi tugas laporan
                ->visit('/admin/petugas/laporan-tugas')
                ->select('petugas_id', $petugas->id)
                ->waitForText($laporan->nomor_laporan, 5)
                ->assertSee($laporan->nomor_laporan);
        });
    }

    public function test_petugas_task_appears_on_verifikasi_laporan()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $petugas = Petugas::factory()->create(['nama' => 'Petugas Verif']);
        $laporan = Laporan::factory()->create(['status' => 'diverifikasi']);
        $this->browse(function (Browser $browser) use ($admin, $petugas, $laporan) {
            $browser->loginAs($admin)
                ->visit('/admin/laporan?status=diverifikasi')
                ->assertSee('Petugas')
                ->assertSee('Laporan');
        });
    }
}