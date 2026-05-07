<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    public function run(): void
    {
        $divisions = [
            ['name' => 'Engineering', 'description' => 'Software development and technical infrastructure'],
            ['name' => 'Human Resources', 'description' => 'Talent acquisition, employee relations, and HR policies'],
            ['name' => 'Marketing', 'description' => 'Brand management, campaigns, and market research'],
            ['name' => 'Finance', 'description' => 'Financial planning, accounting, and budget management'],
            ['name' => 'Operations', 'description' => 'Business operations and process management'],
            ['name' => 'Sales', 'description' => 'Revenue generation and client relationship management'],
            ['name' => 'Product', 'description' => 'Product strategy, roadmap, and management'],
            ['name' => 'Design', 'description' => 'UI/UX design and creative direction'],
        ];

        foreach ($divisions as $division) {
            Division::create($division);
        }
    }
}
