<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = [
            ['label' => 'HTML', 'color' => 'danger'],
            ['label' => 'CSS', 'color' => 'info'],
            ['label' => 'JAVASCRIPT', 'color' => 'warning'],
            ['label' => 'BOOTSTRAP', 'color' => 'dark'],
            ['label' => 'VUE', 'color' => 'success'],
            ['label' => 'SASS', 'color' => 'primary'],
            ['label' => 'PHP', 'color' => 'warning'],
            ['label' => 'SQL', 'color' => 'secondary'],
            ['label' => 'LARAVEL', 'color' => 'danger'],
        ];
        
        foreach ($technologies as $technology) {

            $new_technology = new Technology();
            $new_technology->label = $technology ['label'];
            $new_technology->color = $technology ['color'];
            $new_technology->save();
        }
    }      
}
