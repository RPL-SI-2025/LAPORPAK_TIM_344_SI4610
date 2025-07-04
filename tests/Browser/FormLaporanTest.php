<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FormLaporanTest extends DuskTestCase
{
    /**
     * Test semua field required kosong
     */
    public function test_semua_field_kosong()
    {
        \App\Models\User::where('email', 'test@example.com')->delete();
        \App\Models\User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('test12345'),
            'role' => 'user'
        ]);
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->waitFor('input[name=email]', 5)
                ->type('email', 'test@example.com')
                ->type('password', 'test12345')
                ->press('Masuk')
                ->pause(1500)
                ->assertPathIs('/dashboard/user')
                ->assertSee('LAYANAN PENGADUAN ONLINE')
                ->clickLink('LAPOR!')
                ->assertPathIs('/lapor');
            $browser->press('Kirim')
                ->pause(1200)
                ->assertSee('Tidak Dapat Mengirimkan Laporan Kosong')
                ->pause(1200)
                ->press('Tutup')
                ->refresh()
                ->pause(1500);
        });
    }

    /**
     * Test field bukti laporan kosong
     */
    public function test_bukti_laporan_kosong()
    {
        $this->browse(function (Browser $browser) {
            $browser->select('jenis_laporan', 'Publik')
                ->pause(1000)
                ->type('lokasi', '-6.9298242,107.6349601')
                ->pause(1000)
                ->select('kategori_laporan', 'Jalan Rusak')
                ->pause(1000)
                ->type('deskripsi_laporan', 'Ada jalan rusak di sini')
                ->pause(1000)
                ->waitUntilMissing('.swal2-container', 5)
                ->pause(1200)
                ->check('input#ceklis')
                ->press('Kirim')
                ->pause(1200)
                ->assertSee('Lengkapi Bukti Kerusakan')
                ->pause(1200)
                ->press('Tutup')
                ->refresh()
                ->pause(1500);
        });
    }

    /**
     * Test salah satu field required kosong
     */
    public function test_kolom_lain_kosong()
    {
        $this->browse(function (Browser $browser) {
            $browser->select('jenis_laporan', 'Publik')
                ->pause(1000)
                ->select('kategori_laporan', 'Jalan Rusak')
                ->pause(1000)
                ->type('deskripsi_laporan', 'Ada jalan rusak di sini')
                ->pause(1000)
                ->attach('bukti_laporan', realpath(base_path('tests/Browser/dummy.jpg')))
                ->waitUntilMissing('.swal2-container', 5)
                ->pause(1200)
                ->check('input#ceklis')
                ->press('Kirim')
                ->pause(1200)
                ->assertSee('Lengkapi Kolom yang Kosong')
                ->pause(1200)
                ->press('Tutup')
                ->refresh()
                ->pause(1500);
        });
    }

    /**
     * Test ceklis pernyataan tidak diceklis
     */
    public function test_ceklis_tidak_diceklis()
    {
        $this->browse(function (Browser $browser) {
            $browser->select('jenis_laporan', 'Publik')
                ->pause(1000)
                ->type('lokasi', '-6.9298242,107.6349601')
                ->pause(1000)
                ->select('kategori_laporan', 'Jalan Rusak')
                ->pause(1000)
                ->type('deskripsi_laporan', 'Ada jalan rusak di sini')
                ->pause(1000)
                ->attach('bukti_laporan', realpath(base_path('tests/Browser/dummy.jpg')))
                // Tidak mencentang ceklis
                ->press('Kirim')
                ->pause(1200)
                ->assertSee('Ceklis Pernyataan')
                ->pause(1200)
                ->press('Tutup')
                ->refresh()
                ->pause(1500);
        });
    }

    /**
     * Test laporan berhasil dibuat
     */
    public function test_laporan_berhasil_dibuat()
    {
        $this->browse(function (Browser $browser) {
            $browser->select('jenis_laporan', 'Publik')
                ->pause(1000)
                ->type('lokasi', '-6.9298242,107.6349601')
                ->pause(1000)
                ->select('kategori_laporan', 'Jalan Rusak')
                ->pause(1000)
                ->type('deskripsi_laporan', 'Ada jalan rusak di sini')
                ->pause(1000)
                ->attach('bukti_laporan', realpath(base_path('tests/Browser/dummy.jpg')))
                ->waitUntilMissing('.swal2-container', 5)
                ->pause(1200)
                ->check('input#ceklis')
                ->press('Kirim')
                ->waitFor('.swal2-container', 5)
                ->whenAvailable('.swal2-container', function ($modal) {
                    $modal->assertSee('Laporan berhasil dikirim!');
                    $modal->script("document.querySelector('.swal2-confirm').click();");
                })
                ->pause(1200)
                ->waitUntilMissing('.swal2-container', 5)
                ->press('Tutup')
                ->refresh()
                ->pause(1500);
        });
    }
} 