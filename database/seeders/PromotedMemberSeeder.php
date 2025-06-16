<?php

namespace Database\Seeders;

use App\Models\PromotedMember;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PromotedMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*seeder create work but type 01
        ================================*/

        // PromotedMember::create([
        //     'name' => 'Super Admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => bcrypt('password'),
        //     'role' => 1
        // ]);

        // PromotedMember::create([
        //     'name' => 'Striker Developer',
        //     'email' => 'striker.developer@gmail.com',
        //     'password' => bcrypt('password'),
        //     'role' => 1
        // ]);

        // PromotedMember::create([
        //     'name' => 'Striker Member',
        //     'email' => 'striker.member@gmail.com',
        //     'password' => bcrypt('password'),
        //     'role' => 0
        // ]);
    }
}
