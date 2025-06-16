<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sliders = [
            [
                'title' => 'Roadside Chill',
                'image' => 'gallery1.jpg',
                'is_read' => 0,
                'status' => 1,
            ],
            [
                'title' => 'Boat Ride',
                'image' => 'gallery2.jpg',
                'is_read' => 0,
                'status' => 1,
            ],
            [
                'title' => 'Horse Riding',
                'image' => 'gallery3.jpg',
                'is_read' => 0,
                'status' => 1,
            ],
            [
                'title' => 'Ceremony Function',
                'image' => 'gallery4.jpg',
                'is_read' => 0,
                'status' => 1,
            ],
            [
                'title' => 'Get Together',
                'image' => 'gallery5.jpg',
                'is_read' => 0,
                'status' => 1,
            ],
            [
                'title' => 'Together Get Arrange',
                'image' => 'gallery6.jpg',
                'is_read' => 0,
                'status' => 1,
            ],
        ];

        Gallery::insert($sliders);
    }
}
