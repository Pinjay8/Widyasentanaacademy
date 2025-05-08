<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Campaigns;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory(1)->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'no_telp' => '08123456789',
            'password' => bcrypt('password'),
        ]);

        Admin::factory(1)->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);

        Campaigns::create([
            'id' => 1,
            'admin_id' => 1,
            'title' => 'Campaign 1',
            'description' => 'Description for Campaign 1',
            'slug' => 'campaign-1',
            'target_amount' => 1000000,
            'collected_amount' => 100000,
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'status' => 'aktif',
            'thumbnail' => 'campaigns/thumbnail/campaign1.jpg',
        ]);

        Campaigns::create([
            'id' => 2,
            'admin_id' => 1,
            'title' => 'Campaign 2',
            'description' => 'Description for Campaign 2',
            'slug' => 'campaign-2',
            'target_amount' => 2000000,
            'collected_amount' => 500000,
            'start_date' => now(),
            'end_date' => now()->addDays(60),
            'status' => 'aktif',
            'thumbnail' => 'campaigns/thumbnail/campaign2.jpg',
        ]);

        Campaigns::create([
            'id' => 3,
            'admin_id' => 1,
            'title' => 'Campaign 3',
            'description' => 'Description for Campaign 3',
            'slug' => 'campaign-3',
            'target_amount' => 1500000,
            'collected_amount' => 300000,
            'start_date' => now(),
            'end_date' => now()->addDays(45),
            'status' => 'aktif',
            'thumbnail' => 'campaigns/thumbnail/campaign3.jpg',
        ]);


        Campaigns::create([
            'id' => 4,
            'admin_id' => 1,
            'title' => 'Campaign 4',
            'description' => 'Description for Campaign 4',
            'slug' => 'campaign-4',
            'target_amount' => 2500000,
            'collected_amount' => 800000,
            'start_date' => now(),
            'end_date' => now()->addDays(90),
            'status' => 'aktif',
            'thumbnail' => 'campaigns/thumbnail/campaign4.jpg',
        ]);
    }
}
