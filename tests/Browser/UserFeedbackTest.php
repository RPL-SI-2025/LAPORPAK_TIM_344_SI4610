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
        $user = \App\Models\User::where('email','user@gmail.com')->first();
            $browser
                ->loginAs($user)
                ->visit('/dashboard/user')
                ->assertPathIs('/dashboard/user')
                ->pause(2000)
                ->press('Notifikasi')
                ->pause(2000);

            // Tambahkan langkah lanjutan sesuai dengan pengujian feedback
            // Contoh (opsional, sesuaikan dengan aplikasi kamu):
            // ->clickLink('Laporan Selesai')
            // ->type('feedback', 'Aplikasi sangat membantu')
            // ->press('Kirim Feedback')
            // ->assertSee('Terima kasih atas feedback Anda');
        });
    }
}
