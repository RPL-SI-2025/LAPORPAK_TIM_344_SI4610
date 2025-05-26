<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class NotifikasiTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group notifikasi
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $user = \App\Models\User::find(1); 
            
            $browser->loginAs($user)
                ->visit('/dashboard/user')
                ->assertPathIs('/dashboard/user')
                ->clickLink('Lihat semua notifikasi')
                ->assertPathIs('/notifications')
                ->assertSee('Status laporan')
                ->clickLink('Kembali');
        });
    }
}
