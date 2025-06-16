<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $designation = [
            [
                'name' => 'President',
                'is_read' => 0,
                'status' => 1,
            ],
            [
                'name' => 'Vice President',
                'is_read' => 0,
                'status' => 1,
            ],
            [
                'name' => 'Recording Secretary',
                'is_read' => 0,
                'status' => 1,
            ],
            [
                'name' => 'Financial Secretary',
                'is_read' => 0,
                'status' => 1,
            ],
            [
                'name' => 'Corresponding Secretary',
                'is_read' => 0,
                'status' => 1,
            ],
            [
                'name' => 'Treasurer',
                'is_read' => 0,
                'status' => 1,
            ],
            [
                'name' => 'Business Manager',
                'is_read' => 0,
                'status' => 1,
            ],
            [
                'name' => 'Member At Large',
                'is_read' => 0,
                'status' => 1,
            ],
            [
                'name' => 'Member',
                'is_read' => 0,
                'status' => 1,
            ],
        ];
        Designation::insert($designation);
    }
}
