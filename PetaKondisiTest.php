<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PetaKondisiTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group peta
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $user = \App\Models\User::find(1); 
            
            $browser->loginAs($user)
                ->visit('/dashboard/user')
                ->assertPathIs('/dashboard/user')
                ->clickLink('Baca Lebih Lanjut')
                ->assertPathIs('/kondisi-jalan')
                ->clickLink('Kembali');
        });
    }
}
