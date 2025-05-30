<?php

namespace Tests\Browser;

use App\Models\Faq;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FaqTest extends DuskTestCase
{
    use DatabaseMigrations;


    /** @test */
    public function admin_can_create_faq()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                    ->visit('/admin/faq')
                    ->visit('/admin/faq/create')
                    ->type('question', 'Contoh Pertanyaan FAQ')
                    ->type('answer', 'Ini adalah contoh jawaban untuk FAQ.')
                    ->press('Submit')
                    ->assertPathIs('/admin/faq');
        });
    }

    /** @test */
    public function admin_can_edit_faq()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $faq = Faq::create([
            'question' => 'Pertanyaan Awal',
            'answer' => 'Jawaban Awal',
            'status' => 1
        ]);
      
        $this->browse(function (Browser $browser) use ($admin, $faq) {
            // First, navigate to the edit page directly
            $browser->loginAs($admin)
                    ->visit("/admin/faq/{$faq->id}/edit")
                    ->resize(1920, 1080)
                    ->assertPathIs("/admin/faq/{$faq->id}/edit");

            // Now interact with the form
            $browser->type('question', 'FAQ yang telah Diedit')
                    ->type('answer', 'Jawaban telah diperbarui.')
                    ->pause(500);

            // Scroll to and click the Update button
            $browser->pause(500)
                    ->press('Update')
                    ->waitForLocation('/admin/faq')
                    ->assertPathIs('/admin/faq');
        });
    }

    /** @test */
public function admin_can_delete_faq()
{
    $admin = User::factory()->create(['role' => 'admin']);
    $faq = Faq::create([
        'question' => 'Pertanyaan untuk Dihapus ' . time(),
        'answer' => 'Ini akan dihapus',
        'status' => 1
    ]);

    $this->browse(function (Browser $browser) use ($admin, $faq) {
        $browser->loginAs($admin)
                ->visit('/admin/faq')
                ->assertSee($faq->question)

                // Bypass confirm dialog with JS
                ->script('window.confirm = function () { return true; };');

        // Kembali ke halaman karena script() tidak chaining
        $browser->visit('/admin/faq')
                ->with("table tbody tr:first-child", function ($row) {
                    $row->press('Delete');
                })

                // Tunggu redirect atau reload
                ->pause(1000);
    });
}
}