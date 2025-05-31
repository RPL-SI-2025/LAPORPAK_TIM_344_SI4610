<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

use Illuminate\Support\Facades\Hash;

class UserStatisticsTest extends DuskTestCase
{ // Tidak memakai trait agar tidak menghapus data utama
    

    /** @test */
   public function user_can_see_own_statistics()
{
    // Pastikan user dummy ada
    User::updateOrCreate(
        ['email' => 'testcase@example.com'],
        [
            'name' => 'test user',
            'password' => Hash::make('test12345'),
            'role' => 'user',
            'status' => 'aktif',
            'email_verified_at' => now(),
        ]
    );

    // Ambil semua status unik dari tabel laporans
    $statuses = \App\Models\Laporan::select('status')->distinct()->pluck('status')->toArray();

    $this->browse(function (Browser $browser) use ($statuses) {
        $browser->visit('/login')
            ->waitFor('input[name=email]', 5)
            ->type('email', 'testcase@example.com')
            ->type('password', 'test12345')
            ->press('Masuk')
            ->pause(1500)
            ->visit('/dashboard/user');
        foreach ($statuses as $status) {
            $browser->assertSee($status);
        }
    });

    // Hapus user dummy setelah test jika perlu
    User::where('email', 'testcase@example.com')->delete();
}
    }

