<?php

namespace Database\Factories;

use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    protected $model = Report::class;

    public function definition()
    {
        return [
            'nomor_laporan' => 'LAP' . $this->faker->unique()->numerify('######'),
            'judul' => $this->faker->sentence(),
            'deskripsi' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['Diajukan', 'Diproses', 'Ditindaklanjuti', 'Ditanggapi', 'Selesai']),
            'user_id' => User::factory(),
        ];
    }
}
