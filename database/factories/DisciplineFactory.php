<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discipline>
 */
class DisciplineFactory extends Factory
{
    protected $model = \App\Models\Discipline::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nomes = [
            'Administração',
            'Direito',
            'Medicina',
            'Engenharia',
            'Ciência da Computação',
            'Analise e Desenvolvimento de Sistemas',
            'Engenharia de Software',
            'Sistemas de Informação',
            'Design',
            'Arquitetura',
            'Educação Física',
            'Enfermagem',
            'Farmácia',
            'Fisioterapia',
            'Nutrição',
            'Odontologia',
            'Psicologia',
            'Veterinária',
            'Biomedicina',
            'Pedagogia',
            'Jornalismo',
            'Publicidade e Propaganda',
            'Relações Internacionais',
        ];

        // Garante que o nome randomico seja único para evitar duplicatas 
        $name = $this->faker->unique()->randomElement($nomes);
        // retira acentuação para formar o código
        $normalized = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $name);
        // pega as três primeiras letras e transforma em maiúsculas
        $prefix = strtoupper(substr($normalized, 0, 3));
        // gera um número aleatório de três dígitos
        $number = $this->faker->numerify('###');

        return [
            'name' => $name,
            'code' => "DISC-{$prefix}-{$number}",
            'ch' => $this->faker->numberBetween(2000, 3200), // carga horária
            'active' => $this->faker->boolean(90), // 90% chance de ser true
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
