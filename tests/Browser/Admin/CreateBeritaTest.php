<?php

namespace Tests\Browser\Admin;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CreateBeritaTest extends DuskTestCase
{
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::where('email', 'admin@laporpak.com')->first();
        
        if (!$this->user) {
            throw new \Exception('Admin user not found in database');
        }
    }

    public function test_admin_can_create_berita()
    {
        $this->browse(function (Browser $browser) {
            $browser->maximize()
                    ->loginAs($this->user)
                    ->visit('/admin/berita/create')
                    ->assertSee('Tambah Berita')
                    ->pause(2000) // Wait for page load
                    ->type('judul', 'Test Berita')
                    ->type('kategori', 'Test Kategori')
                    ->waitFor('.note-editable')
                    ->keys('.note-editable', 'Ini adalah isi berita test')
                    ->type('tanggal_terbit', '2025-05-18')
                    ->select('status', 'draft')
                    ->attach('gambar', public_path('assets/img/news10.jpg'))
                    ->press('Simpan Berita')
                    ->pause(2000) // Wait for redirect
                    ->assertPathIs('/admin/berita')
                    ->assertSee('Berita berhasil ditambahkan');
        });
    }
}
