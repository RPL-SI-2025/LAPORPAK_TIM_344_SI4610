<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TrackReportTest extends DuskTestCase
{

    /** @test
     * @group bikinlaporan
     */
    public function buat_laporan()
    {
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
                ->assertPathIs('/lapor')
                ->pause(1000);
            $browser->select('jenis_laporan', 'Publik')
                ->pause(1000)
                ->type('lokasi_laporan', 'Jl. Contoh')
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
                ->waitUntilMissing('.swal2-container', 5)
                ->refresh()
                ->pause(1500);
        });
    }

    /** @test
     * @group detail
     */
    public function view_detail_laporan()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->waitFor('input[name=email]', 5)
                ->type('email', 'test@example.com')
                ->type('password', 'test12345')
                ->press('Masuk')
                ->pause(1500)
                ->visit('/laporan')
                ->assertSee('Laporan Saya')
                ->click('.btn-navy .fa-eye')
                ->pause(1000)
                ->assertSee('Detail Laporan')
                ->pause(1200); 
        });
    }

    /** @test
     * @group update
     */
    public function update_laporan()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->waitFor('input[name=email]', 5)
                ->type('email', 'test@example.com')
                ->type('password', 'test12345')
                ->press('Masuk')
                ->pause(1500)
                ->visit('/laporan')
                ->assertSee('Laporan Saya')
                ->pause(1000);
            $browser->click('a.btn-edit-custom')
                ->pause(1000)
                ->assertSee('Edit Laporan')
                ->pause(1000)
                ->type('deskripsi', 'Disini jalanan berlubang besar dan banyak orang yang kecelakaan')
                ->pause(1200)
                ->press('Update')
                ->pause(1200)
                ->assertSee('Berhasil')
                ->pause(1200);
        });
    }

    /** @test
     * @group hapus
     */
    public function hapus_laporan()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->waitFor('input[name=email]', 5)
                ->type('email', 'test@example.com')
                ->type('password', 'test12345')
                ->press('Masuk')
                ->pause(1500)
                ->visit('/laporan')
                ->assertSee('Laporan Saya')
                ->press('Hapus')
                ->pause(1500)
                ->assertSee('Data laporan akan dihapus permanen')
                ->pause(1500)
                ->press('Ya, hapus')
                ->assertSee('Berhasil')
                ->pause(1200);
        });
    }
}