<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Discipline;

class DisciplineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Discipline::factory()->count(10)->create();
    }
}
