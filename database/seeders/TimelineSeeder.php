<?php

namespace Database\Seeders;

use App\Models\Fail;
use App\Models\Profile;
use App\Models\Replacement;
use App\Models\Resume;
use App\Models\Service;
use App\Models\Supply;
use App\Models\Team;
use App\Models\Timeline;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

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
            $monto = Profile::whereIn('id', $users)->sum('salary');
            //  var_dump($monto);
            $str = implode(',', $users->toArray());
            $t->update([
                'status' => $faker->randomElement([1, 1, 1, 1, 0, 1, 0, 1, 0]),
                'done' => $t->end,
                'time' => $t->start->diffInHours($t->done),
                'days' => $t->start->diffInDays($t->done),
                'workers_id' => $str,
                'team_id' => $team->id,
                'total_workers' => $monto,
            ]);
            $t->save;
        }

        $timelines = Timeline::all();
        foreach ($timelines as $t) {
            $replacements = Replacement::inRandomOrder()->limit(rand(2, 6))->get()->pluck('id');
            $t->replacements()->attach($replacements, ["price" => 500, 'quantity' => 3, 'total' => 1500]);

            $supplies = Supply::inRandomOrder()->limit(rand(2, 6))->get()->pluck('id');
            $t->supplies()->attach($supplies, ["price" => 350, 'quantity' => 3, 'total' => 1050]);

            $services = Service::inRandomOrder()->limit(rand(2, 6))->get()->pluck('id');
            $t->services()->attach($services, ["price" => 6500, 'total' => 6500]);
        }

        $fails = Fail::all();
        foreach ($fails as $t) {
            $num = $faker->numberBetween($min = 3000, $max = 12000);
            $q = $faker->numberBetween($min = 1, $max = 9);
            $to = $num * $q;
            $replacements = Replacement::inRandomOrder()->limit(rand(2, 6))->get()->pluck('id');
            $t->replacements()->attach($replacements, ["price" => $num, 'quantity' => $q, 'total' => $to]);

            $num = $faker->numberBetween($min = 1000, $max = 9000);
            $q = $faker->numberBetween($min = 1, $max = 9);
            $to = $num * $q;

            $supplies = Supply::inRandomOrder()->limit(rand(2, 6))->get()->pluck('id');
            $t->supplies()->attach($supplies, ["price" => $num, 'quantity' => $q, 'total' => $to]);
            $num = $faker->numberBetween($min = 3600, $max = 13400);
            $services = Service::inRandomOrder()->limit(rand(2, 6))->get()->pluck('id');
            $t->services()->attach($services, ["price" => $num, 'total' => $num]);}

        $fallas = Fail::withSum('replacements', 'fail_replacement.total')
            ->withSum('supplies', 'fail_supply.total')
            ->withSum('services', 'fail_service.total')->get();

        //dd(json_decode($fallas));

        foreach ($fallas as $f) {

            $team =Team::all()->random();
            $cost = 0;
            foreach ($team->users as $p) {
                if ($p->profile) {
                    $cost = $p->profile->salary + $cost;}
            }

            $id = $team->users()->pluck('users.id')->toArray();
            $str = implode(',',$id);

            $time = $f->reported_at->diffInHours($f->repareid_at);
            $days = $f->reported_at->diffInDays($f->repareid_at);


            $resume = Resume::create([
                'fail' => $f->id,
                'equipment' => $f->equipment_id,
                'type' => $f->type,
                'total_replacement' =>  $faker->numberBetween(8000, 15000),
                'total_supply' => $faker->numberBetween(8000, 15000),
                'total_service' => $faker->numberBetween(8000, 15000),
                'total_workers' => $faker->numberBetween(8000, 15000),
                'workers'=>$str,
                'total' =>$faker->numberBetween(35000,70000),
                'reported_at' =>Carbon::parse($t->reported_at),
                'assigned_at'=> Carbon::parse($t->assigned_at),
                'repareid_at' =>Carbon::parse($t->repareid_at),
                'days' =>$days,
                'time' =>$time

            ]);
        }
    }

}
