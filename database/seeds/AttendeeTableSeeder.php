<?php

use Illuminate\Database\Seeder;

class AttendeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Attendee::class, 20)->create();
    }
}
