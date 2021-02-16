<?php

use Illuminate\Database\Seeder;

class ScholarshipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Scholarship::class, 12)->create();
    }
}
