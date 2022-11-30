<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/task.json');
        $data = json_decode($json);

        foreach ($data as $obj){
         $task = new Task();
         $task->name = mb_strtolower($obj->task);
         $task->description = mb_strtolower($obj->detail);
         $task->save();
        }
     }
}
