<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            ['name' => 'News'],
            ['name' => 'Podcast'],
            ['name' => 'Article'],
            ['name' => 'Store'],
            ['name' => 'Job'],
            ['name' => 'Advertismaent']
        ];
        Section::insert($sections);
    }
}
