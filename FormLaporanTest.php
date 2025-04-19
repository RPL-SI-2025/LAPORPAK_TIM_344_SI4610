<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FormLaporanTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test normal case - semua kolom diisi dengan valid
     */
    public function test_normal_case()
    {
        Storage::fake('public');
        
        $file = UploadedFile::fake()->create('bukti.txt', 100);
        
        $response = $this->withoutExceptionHandling()
            ->post('/submit-laporan', [
                'bukti_laporan' => $file,
                'lokasi_laporan' => 'Jalan Raya Bogor KM 10',
                'kategori_laporan' => 'Jalan Rusak',
                'deskripsi_laporan' => 'Terdapat lubang besar di tengah jalan',
                'pernyataan' => 'on'
            ]);

        $response->assertOk()
            ->assertJson(['message' => 'Laporan berhasil dikirim!']);
    }

    /**
     * Test case : bukti laporan tidak diisi
     */
    public function test_missing_bukti_laporan()
    {
        $response = $this->post('/submit-laporan', [
            'lokasi_laporan' => 'Jalan Raya Bogor KM 10',
            'kategori_laporan' => 'Jalan Rusak',
            'deskripsi_laporan' => 'Terdapat lubang besar di tengah jalan',
            'pernyataan' => 'on'
        ]);

        $response->assertStatus(400)
            ->assertJson(['message' => 'Lengkapi bukti kerusakan']);
    }

    /**
     * Test case : kolom wajib tidak diisi
     */
    public function test_missing_required_fields()
    {
        Storage::fake('public');
        
        $file = UploadedFile::fake()->create('bukti.txt', 100);
        
        $response = $this->post('/submit-laporan', [
            'bukti_laporan' => $file,
            'pernyataan' => 'on'
        ]);

        $response->assertStatus(400)
            ->assertJson(['message' => 'Lengkapi kolom yang kosong']);
    }

    /**
     * Test case : semua kolom kosong
     */
    public function test_all_fields_empty()
    {
        $response = $this->post('/submit-laporan', []);

        $response->assertStatus(400)
            ->assertJson(['message' => 'Tidak dapat mengirimkan laporan kosong']);
    }

    /**
     * Test case : pernyataan tidak diceklis
     */
    public function test_pernyataan_not_checked()
    {
        Storage::fake('public');
        
        $file = UploadedFile::fake()->create('bukti.txt', 100);
        
        $response = $this->post('/submit-laporan', [
            'bukti_laporan' => $file,
            'lokasi_laporan' => 'Jalan Raya Bogor KM 10',
            'kategori_laporan' => 'Jalan Rusak',
            'deskripsi_laporan' => 'Terdapat lubang besar di tengah jalan'
        ]);

        $response->assertStatus(400)
            ->assertJson(['message' => 'Ceklis pernyataan persetujuan']);
    }
}
