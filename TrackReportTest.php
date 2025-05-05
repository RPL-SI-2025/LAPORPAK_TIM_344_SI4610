<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TrackReportTest extends DuskTestCase
{
    // Uncomment if you want to refresh database before each test
    // use DatabaseMigrations;

    /** @test */
    public function guest_can_track_report_by_code()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/track')
                    ->assertSee('LACAK LAPORANMU')
                    ->type('nomor_laporan', 'LAP123456') // Pastikan nomor ini ADA di database test
                    ->press('Cari Laporan')
                    ->pause(1000)
                    ->assertSee('Nomor Laporan'); // Pastikan ini ada di hasil view jika sukses
        });
    }

    /** @test */
    public function guest_cannot_track_report_with_invalid_number()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/track')
                    ->assertSee('LACAK LAPORANMU')
                    ->type('nomor_laporan', 'NOMORTIDAKADA')
                    ->press('Cari Laporan')
                    ->waitFor('.swal2-popup', 5)
                    ->assertSee('Nomor Laporan Tidak Ditemukan')
                    ->press('Tutup'); // Optional: klik tombol close pada popup
        });
    }

    /** @test */
    public function user_cannot_track_report_with_invalid_number()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'user@gmail.com')
                    ->type('password', 'user12345')
                    ->press('Masuk')
                    ->waitForText('LAYANAN PENGADUAN ONLINE', 5)
                    ->assertSee('LAYANAN PENGADUAN ONLINE')
                    ->scrollIntoView('#kategori')
                    ->waitFor('#kategori', 5)
                    ->assertSee('KATEGORI LAPORAN')
                    ->pause(500)
                    ->within('#kategori', function (Browser $section) {
                        $section->clickLink('Lacak Laporanmu');
                    })
                    ->waitForLocation('/track', 5)
                    ->assertPathIs('/track')
                    ->assertSee('LACAK LAPORANMU')
                    ->type('nomor_laporan', 'NOMORTIDAKADA')
                    ->press('Cari Laporan')
                    ->waitFor('.swal2-popup', 5)
                    ->assertSee('Nomor Laporan Tidak Ditemukan')
                    // ->press('Tutup');
                    ->refresh()
                    ->pause(1500);
        });
    }

    /** @test */
    public function user_can_track_report_with_valid_number()
    {
        $this->browse(function (Browser $browser) {
            $browser // ->visit('/login')
            //         ->type('email', 'user@gmail.com')
            //         ->type('password', 'user12345')
            //         ->press('Masuk')
            //         ->visit('/dashboard/user')
            //         ->waitForText('LAYANAN PENGADUAN ONLINE', 5)
            //         ->assertSee('LAYANAN PENGADUAN ONLINE')
            //         ->scrollIntoView('#kategori')
            //         ->waitFor('#kategori', 5)
            //         ->assertSee('KATEGORI LAPORAN')
            //         ->pause(500)
                    // ->scrollIntoView('a:contains("Lacak Laporanmu")')
                    // ->within('#kategori', function (Browser $section) {
                    //     $section->clickLink('Lacak Laporanmu');
                    // })
                    // ->waitForLocation('/track', 5)
                    // ->assertPathIs('/track')
                    // ->assertSee('LACAK LAPORANMU')
                    ->type('nomor_laporan', 'LAP123456')
                    ->press('Cari Laporan')
                    ->pause(1000)
                    ->assertSee('Nomor Laporan');
        });
    }
}