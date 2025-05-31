<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminFeedbackTest extends DuskTestCase
{
    public function testAdminCanSendFeedbackOnCompletedReport()
    {
        $this->browse(function (Browser $browser) {
            $admin = User::where('email', 'admin@laporpak.com')->first();

            $browser->loginAs($admin)
                ->visit('/admin/feedback')
                ->assertSee('Umpan Balik')
                ->pause(1000);

            // Pastikan ada laporan dengan status "selesai"
            if ($browser->element('@selesai-feedback-btn')) {
                $browser->click('@selesai-feedback-btn') // Klik tombol upload
                        ->pause(3000)
                        ->assertPathIs('/admin/feedback/create*')
                        ->attach('bukti_feedback', storage_path('app/public/test-images/sample.jpg')) // File test disiapkan
                        ->pause(3000)
                        ->press('Simpan')
                        ->pause(3000)
                        ->assertSee('Bukti feedback berhasil disimpan.');
            } else {
                $browser->script('console.warn("Tidak ada laporan berstatus selesai.")');
            }
        });
    }
}
