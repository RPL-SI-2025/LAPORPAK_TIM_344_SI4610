<?php

namespace Tests\Browser\Admin;

use App\Models\User;
use App\Models\Berita;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class UpdateBeritaStatusTest extends DuskTestCase
{
    protected $user;
    protected $berita;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::where('email', 'admin@laporpak.com')->first();
        if (!$this->user) {
            throw new \Exception('Admin user not found in database');
        }

        // Buat berita draft yang akan diupdate
        $this->berita = Berita::firstOrCreate(
            ['judul' => 'Test Berita'],
            [
                'kategori' => 'Test Kategori',
                'isi' => 'Isi berita test',
                'tanggal_terbit' => '2025-05-18',
                'status' => 'draft',
                'gambar' => 'berita/news10.jpg'
            ]
        );
    }

    public function test_admin_can_update_status_from_draft_to_publish()
    {
        $this->browse(function (Browser $browser) {
            $browser->maximize()
                ->loginAs($this->user)
                ->visit("/admin/berita/{$this->berita->id}/edit")
                ->assertSee('Edit Berita')
                ->select('status', 'published')  // Ganti status ke published (sesuai validasi controller)
                ->press('Update Berita')          // Pastikan tombol submitnya labelnya Update Berita
                ->pause(2000)
                ->assertPathIs('/admin/berita')
                ->assertSee('Berita berhasil diperbarui');
        });
    }
}
