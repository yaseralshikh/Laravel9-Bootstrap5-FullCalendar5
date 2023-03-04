<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OfficeSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(SpecializationSeeder::class);
        $this->call(LaratrustSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SemesterSeeder::class);
        $this->call(WeekSeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(SiteSeeder::class);
        $this->call(JobTypeSeeder::class);
    }
}
