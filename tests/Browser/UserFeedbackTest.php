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
        // Membuat user dummy untuk login
        $user = User::factory()->create([
            'email' => 'user@gmail.com',
            'password' => bcrypt('passworduser'), // Pastikan sesuai dengan input login
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'passworduser')
                ->press('Masuk')
                ->pause(2000)
                ->assertPathIs('/dashboard/user')
                ->pause(2000)
                ->press('Notifikasi')
                ->pause(10000);

            // Tambahkan langkah lanjutan sesuai dengan pengujian feedback
            // Contoh (opsional, sesuaikan dengan aplikasi kamu):
            // ->clickLink('Laporan Selesai')
            // ->type('feedback', 'Aplikasi sangat membantu')
            // ->press('Kirim Feedback')
            // ->assertSee('Terima kasih atas feedback Anda');
        });
    }
}
