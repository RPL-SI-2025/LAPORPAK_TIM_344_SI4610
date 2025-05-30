<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserFeedbackTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_submit_feedback_after_report_completed()
    {
        $this->browse(function (Browser $browser) {
         
            $user = User::factory()->create([
                'email' => 'user@gmail.com',
                'password' => bcrypt('password') 
            ]);

            $browser
                ->loginAs($user)
                ->visit('/dashboard/user')
                ->assertPathIs('/dashboard/user')
                ->pause(3000)
                ->press('Notifikasi')
                ->pause(3000);

           
        });
    }
}
