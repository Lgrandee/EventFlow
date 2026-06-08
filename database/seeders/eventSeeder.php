<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::updateOrCreate(
            ['name' => 'Tech Conference 2024'],
            [
                'location' => 'San Francisco, CA',
                'start_time' => '2024-09-15 09:00:00',
                'description' => 'A conference for tech enthusiasts to discuss the latest trends in technology.',
                'Category_id' => 1,
                'max-attendees' => 500,
                'created_by' => 1,
            ]
        );
    }
}
