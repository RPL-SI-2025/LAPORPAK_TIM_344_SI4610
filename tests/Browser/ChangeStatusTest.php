<?php

use Laravel\Dusk\Browser;

test('example', function () {
    $this->browse(function (Browser $browser) {
        $user = \App\Models\User::where('email','admin@laporpak.com')->first();
            $browser
            ->loginAs($user);
            
            $statuses = [
            'diajukan',
            'diverifikasi',
            'ditolak',
            'diterima',
            'ditindaklanjuti',
            'ditanggapi',
            'selesai',
            ];

            foreach ($statuses as $status) {
                $browser
                    ->loginAs($user)
                    ->visit('/admin/laporan')
                    ->assertPathIs('/admin/laporan')
                    ->pause(2000)
                    ->assertSee('Laporan')
                    ->clickLink('Detail')
                    ->pause(2000)
                    ->select('status', $status)
                    ->pause(1000)
                    ->press('Ubah Status')
                    ->acceptDialog()
                    ->pause(2000)
                    ->visit('/admin/laporan')
                    ->pause(2000)
                    ->assertSee('Laporan'); // Tambahkan validasi status di sini jika perlu
            }
    });
});