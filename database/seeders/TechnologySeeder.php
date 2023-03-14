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
            ['label' => 'HTML', 'color' => '#dc143c'],
            ['label' => 'CSS', 'color' => '#add8e6'],
            ['label' => 'JAVASCRIPT', 'color' => '#ffd700'],
            ['label' => 'BOOTSTRAP', 'color' => '#6b8e23'],
            ['label' => 'VUE', 'color' => '#9acd32'],
            ['label' => 'SASS', 'color' => '#6495ed'],
            ['label' => 'PHP', 'color' => '#7b68ee'],
            ['label' => 'SQL', 'color' => '#778899'],
            ['label' => 'LARAVEL', 'color' => '#ff7f50'],
        ];
        
        foreach ($technologies as $technology) {

            $new_technology = new Technology();
            $new_technology->label = $technology ['label'];
            $new_technology->color = $technology ['color'];
            $new_technology->save();
        }
    }      
}
