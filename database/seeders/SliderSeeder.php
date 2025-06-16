<?php

namespace Database\Seeders;

use App\Models\HeroSlider;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sliders = [
            [
                'title' => 'Strickers Club, Incorporated',
                'details' => '<P data-animation="fadeInUp" data-delay=".4s">Serving our community since 1933</P>',
                'image' => 'h1_hero1.jpg',
                'call_back_url' => 'contact',
                'btn_text' => 'Contact Us',
                'is_read' => 0,
                'status' => 1,
            ],
            [
                'title' => 'Civic Activities',
                'details' => '<p data-animation="fadeInUp" data-delay=".2s" style="margin-bottom:2%;font-weight:0;padding:2px !important;line-height: 1.0 !important;">Joining the NAACP in 1934 to support an anti-lynch law</p>
                <p data-animation="fadeInUp"data-delay=".2s" style="margin-bottom:2%;font-weight:0;padding:2px !important;line-height: 1.0 !important;">Donating a bus for mentally challenged children</p>
                <p data-animation="fadeInUp" data-delay=".2s" style="margin-bottom:5%;font-weight:0;padding:2px !important;line-height: 1.0 !important;">Sponsoring the Ebony fashion show</p>',
                'image' => 'h1_hero2.jpg',
                'call_back_url' => 'debutante.program',
                'btn_text' => 'Debutante Program',
                'is_read' => 0,
                'status' => 1,
            ],
            [
                'title' => 'Debutante Program',
                'details' => '<P data-animation="fadeInUp" data-delay=".4s" style="margin-bottom:5%;font-weight:0;padding:2px !important;line-height: 1.0 !important;">The Debutante / Escort program is the PRIDE of <br>the Strikers Club, Inc.</P>',
                'image' => 'h1_hero3.jpg',
                'call_back_url' => 'debutante.application',
                'btn_text' => 'Debutante Application',
                'is_read' => 0,
                'status' => 1,
            ],
        ];

        HeroSlider::insert($sliders);
    }
}
