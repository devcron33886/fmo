<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'name' => 'ECD',
                'status' => 'active',
            ], [
                'Malnutrition Control',
                'status' => 'active',
            ], [
                'School Feeding',
                'status' => 'active',
            ], [
                'name' => 'Zamuka',
                'status' => 'active',
            ], [
                'name' => 'MVTC',
                'status' => 'active',
            ], [
                'name' => 'Fruits Trees',
                'status' => 'active',
            ], [
                'name' => 'Scholarships',
                'status' => 'active',
            ], [
                'name' => 'Micro Credit',
                'status' => 'active',
            ], [
                'name' => 'ToolKits',
                'status' => 'active',
            ], [
                'name' => 'Urgent Community Support',
                'status' => 'active',
            ],
        ];
        Project::insert($projects);
    }
}
