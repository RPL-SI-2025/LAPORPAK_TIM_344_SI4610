<?php

namespace Tests\Browser\Admin;

use App\Models\User;
use App\Models\Berita;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DeleteBeritaTest extends DuskTestCase
{
    protected $user;
    protected $testBerita;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::where('email', 'admin@laporpak.com')->first();
        
        if (!$this->user) {
            throw new \Exception('Admin user not found in database');
        }

        // Buat test_tag unik untuk setiap test
        $this->testcaseTag = 'testcase_' . uniqid();
        // Find or create the test berita yang memiliki test_tag
        $this->testBerita = Berita::firstOrCreate(
            [
                'judul' => 'Test Berita',
                'test_tag' => $this->testcaseTag
            ],
            [
                'kategori' => 'Test Kategori',
                'isi' => 'Isi berita test',
                'tanggal_terbit' => '2025-05-18',
                'status' => 'published',
                'gambar' => 'berita/news10.jpg',
            ]
        );

        if (!$this->testBerita) {
            throw new \Exception('Test berita not found or failed to create.');
        }
    }

    public function test_admin_can_delete_berita()
    {
        $berita = $this->testBerita;

        // Verify the berita exists before deletion
        $this->assertDatabaseHas('berita', [
            'id' => $berita->id,
            'judul' => $berita->judul
        ]);

        $this->browse(function (Browser $browser) use ($berita) {
            // Set a large window size
            $browser->resize(1920, 1080);
            
            $browser->loginAs($this->user)
                   ->visit('/admin/berita')
                   ->screenshot('before-delete-berita')
                   ->assertSee($berita->judul);

            // Wait for the delete button and ensure it's clickable
            $deleteButton = '#delete-berita-' . $berita->id;
            
            // Wait for the delete button to be present and visible
            $browser->waitFor($deleteButton, 10)
                   ->pause(1000) // Extra time for any animations
                   ->screenshot('before-click-delete');

            // Debug: Log the button's HTML
            $browser->script("console.log('Delete button HTML:', document.querySelector('{$deleteButton}')?.outerHTML);");
            
            // Try to find the row with the berita title for better scrolling
            $browser->script(
                "var targetRow = null;" .
                "var rows = document.querySelectorAll('tr');" .
                "for (var i = 0; i < rows.length; i++) {" .
                "  if (rows[i].textContent.includes('" . addslashes($berita->judul) . "')) {" .
                "    targetRow = rows[i];" .
                "    break;" .
                "  }" .
                "}" .
                "if (targetRow) {" .
                "  targetRow.scrollIntoView({behavior: 'smooth', block: 'center'});" .
                "  console.log('Scrolled to row with title: ', '" . addslashes($berita->judul) . "');" .
                "} else {" .
                "  console.error('Row not found with title: ', '" . addslashes($berita->judul) . "');" .
                "}"
            );
            
            // Add a small delay after scrolling
            $browser->pause(1000);
            
            // Click the delete button using JavaScript
            $browser->script(
                "var btn = document.querySelector('{$deleteButton}');" .
                "if (btn) {" .
                "  console.log('Found delete button, clicking...');" .
                "  btn.scrollIntoView({behavior: 'smooth', block: 'center'});" .
                "  setTimeout(function() { " .
                "    console.log('Clicking button...');" .
                "    btn.click();" .
                "  }, 1000);" .
                "} else {" .
                "  console.error('Delete button not found with selector: {$deleteButton}');" .
                "  console.log('Available buttons: ', Array.from(document.querySelectorAll('button')).map(b => b.outerHTML).join('\\n'));" .
                "}"
            );
            
            // Wait for the confirmation dialog
            try {
                $browser->waitForDialog(5)
                       ->acceptDialog()
                       ->pause(1000) // Wait for dialog to close
                       ->screenshot('after-dialog')
                       ->waitUntilMissing($deleteButton, 10)
                       ->assertDontSee($berita->judul)
                       ->assertSee('Berita berhasil dihapus')
                       ->screenshot('after-delete');
            } catch (\Exception $e) {
                // Take a screenshot if something goes wrong
                $browser->screenshot('error-during-delete');
                throw $e;
            }
        });

        // Verify the berita was actually deleted from the database
        $this->assertDatabaseMissing('berita', [
            'test_tag' => $this->testcaseTag
        ]);
        // Bersihkan data dummy jika masih ada
        Berita::where('test_tag', $this->testcaseTag)->delete();
    }
}
