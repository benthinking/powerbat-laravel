<?php

namespace Database\Seeders;

use App\Models\Site;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Group;
use App\Models\Order;
use App\Models\Point;
use App\Models\Device;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Group::factory(5)->create();
        Order::factory(3)->create();
        Device::factory(7)->create();
        Site::factory(5)->has(
            Point::factory(3)->hasData(5)
        )->create();
    }
}
