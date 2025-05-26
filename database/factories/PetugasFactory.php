<?php
namespace Database\Factories;
use App\Models\Petugas;
use Illuminate\Database\Eloquent\Factories\Factory;

class PetugasFactory extends Factory
{
    protected $model = Petugas::class;
    public function definition()
    {
        return [
            'nama' => $this->faker->name(),
            'kontak' => $this->faker->phoneNumber(),
            'foto' => null,
        ];
    }
}
