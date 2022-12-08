<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Team;
use App\Models\Timeline;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Faker\Generator;


class TimelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/timelines.json');
        $objects = json_decode($json);
        foreach ($objects as $object) {
            $v = (array) $object;
            $timeline = new Timeline();
            $timeline->fill($v);
            $timeline->save();
        }

        $faker = app(Generator::class);
        $timelines = Timeline::all();

        foreach ($timelines as $t) {
            $team = Team::all()->random();
            $users = $team->users()->pluck('users.id');
            $monto = Profile::whereIn('id',$users)->sum('salary');
          //  var_dump($monto);
            $str = implode(',',$users->toArray());
            $t->update([
                'status' =>$faker->randomElement([1,1,1,1,0,1,0,1,0]),
                'done' =>$t->end,
                'time' =>$t->start->diffInHours($t->done),
                'days' =>$t->start->diffInDays($t->done),
                'workers_id'=>$str,
                'team_id'=>$team->id,
                'total_workers'=>$monto
            ]);
            $t->save;
        }

    }}
