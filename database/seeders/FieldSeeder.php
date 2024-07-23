<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fields = [
            [
                'name' => 'Grade',
            ], [
                'name' => 'Academic Year',
            ], [
                'name' => 'Father\'s Name',
            ],
            [
                'name' => 'Fathers\'s National Id',
            ], [
                'name' => 'Mother\'s Name',
            ], [
                'name' => 'Home Phone Number',
            ], [
                'name' => 'Age(Months)',
            ], [
                'name' => 'Associated Health Center',
            ], [
                'name' => 'Package Reception Date ',
            ], [
                'name' => 'Entry MUAC',
            ], [
                'name' => 'Current MUAC',
            ], [
                'name' => 'Current Nutrition Color Code ',
            ], [
                'name' => 'School Name',
            ],
            [
                'name' => 'Trimester',
            ], [
                'name' => 'School Phone',
            ], [
                'name' => 'District',

            ], [
                'name' => 'School fees',
            ], [
                'name' => 'Spouse name',
            ], [
                'name' => 'Spouse\'s National ID',
            ], [
                'name' => 'Family Size',
            ], [
                'name' => 'Main source of income',
            ], [
                'name' => 'Entrance year',
            ], [
                'name' => 'House',
            ], [
                'Home equipments',
            ],
            ['name' => 'Bicycle'],
            ['name' => 'Cowshed'],
            ['name' => 'Cow'],
            ['name' => 'Goats'],
            ['name' => 'National ID'],
            ['name' => 'Student Contact'],
            ['name' => 'Trade'],
            ['name' => 'Resident District'],
            ['name' => 'Scholarship Type'],
            ['name' => 'Intake'],
            ['name' => 'Graduation Date'],
            ['name' => 'Avocadoes'],
            ['name' => 'Mangoes'],
            ['name' => 'Oranges'],
            ['name' => 'Papayas'],
            ['name' => 'University to attend'],
            ['name' => 'Faculty(Study Option)'],
            ['name' => 'Mobile Number'],
            ['name' => 'Program Duration'],
            ['name' => 'Budget up to completion'],
            ['name' => 'Loan One'],
            ['name' => 'Loan Two'],
            ['name' => 'TVET'],
            ['name' => 'Level'],
            ['name' => 'Toolkit Received'],
            ['name' => 'Toolkit Cost'],
            ['name' => 'Subdized Percentage'],
            ['name' => 'Toolkit Cost'],
            ['name' => 'Loan'],
            ['name' => 'Total'],
        ];
        \App\Models\Field::insert($fields);
    }
}
