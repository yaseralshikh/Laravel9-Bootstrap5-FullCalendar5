<?php

namespace Database\Seeders;

use App\Models\Office;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offices = Office::all();
        $tasks = [
            [
                'name' => 'يوم مكتبي',
            ],
            [
                'name' => 'إجازة',
            ],
            [
                'name' => 'برنامج تدريبي',
            ],
        ];

        foreach ($offices as $office) {
            foreach($tasks as $task){
                Task::create([
                    'name' => $task['name'],
                    'office_id' => $office->id,
                    'level_id' => 5,
                    'status' => 1,
                ]);
            };
        };
    }
}
