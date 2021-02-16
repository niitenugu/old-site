<?php

use Illuminate\Database\Seeder;

class ScholarshipAttendeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ScholarshipAttendee::class, 20)->create();
    }
}
