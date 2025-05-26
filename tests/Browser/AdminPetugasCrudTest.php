<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use App\Models\Petugas;
use App\Models\Laporan;

class AdminPetugasCrudTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function admin_can_create_petugas()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/petugas')
                ->press('Tambah Petugas')
                ->type('nama', 'Petugas Dusk')
                ->type('kontak', '08123456789')
                ->attach('foto', __DIR__.'/dummy.jpg')
                ->press('Simpan')
                ->assertSee('Petugas berhasil ditambahkan');
        });
    }

    /** @test */
    public function admin_can_view_petugas_list()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $petugas = Petugas::factory()->create(['nama' => 'Petugas List']);
        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/petugas')
                ->assertSee('Petugas List');
        });
    }

    /** @test */
    public function admin_can_assign_task_to_petugas()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $petugas = Petugas::factory()->create();
        $laporan = Laporan::factory()->create();
        $this->browse(function (Browser $browser) use ($admin, $petugas, $laporan) {
            $browser->loginAs($admin)
                ->visit('/admin/petugas')
                ->click('@assign-task-button')
                ->select('laporan_id', $laporan->id)
                ->press('Kirim Tugas')
                ->assertSee('Tugas berhasil dikirim');
        });
    }

    /** @test */
    public function admin_can_see_verifikasi_laporan_page()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                ->visit('/admin/laporan?status=diverifikasi')
                ->assertSee('Verifikasi Laporan');
        });
    }

    /** @test */
    public function petugas_task_appears_on_verifikasi_laporan()
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
                ->visit('/admin/laporan?status=diverifikasi')
                ->assertSee('Petugas')
                ->assertSee('Laporan');
        });
    }
}

        $this->browse(function (Browser $browser) {
            $browser->loginAs(1) // pastikan user id 1 adalah admin
                ->visit('/admin/petugas')
                ->press('Tambah Petugas')
                ->type('nama', 'Petugas Dusk')
                ->type('kontak', '08123456789')
                ->attach('foto', __DIR__.'/dummy.jpg')
                ->press('Simpan')
                ->assertSee('Petugas berhasil ditambahkan');
        });
    }

    /** @test */
    public function admin_can_view_petugas_list()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visit('/admin/petugas')
                ->assertSee('Daftar Petugas');
        });
    }

    /** @test */
    public function admin_can_assign_task_to_petugas()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visit('/admin/petugas')
                ->click('@assign-task-button') // pastikan ada selector dusk di tombol assign
                ->select('laporan_id', 1) // pastikan laporan id 1 ada
                ->press('Kirim Tugas')
                ->assertSee('Tugas berhasil dikirim');
        });
    }

    /** @test */
    public function admin_can_see_verifikasi_laporan_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visit('/admin/laporan?status=diverifikasi')
                ->assertSee('Verifikasi Laporan');
        });
    }

    /** @test */
    public function petugas_task_appears_on_verifikasi_laporan()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visit('/admin/laporan?status=diverifikasi')
                ->assertSee('Petugas')
                ->assertSee('Laporan');
        });
    }
}
