<?php

namespace Database\Seeders;

use App\Models\Fail;
use App\Models\Resume;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fails = Fail::where('status',1)
        ->withSum('replacements','fail_replacement.total')
        ->withSum('supplies','fail_supply.total')
        ->withSum('services','fail_service.total')
        ->get();
        foreach($fails as $fail){

        $team = $fail->teams()->first();
        $users = $team->users()->inRandomOrder()->take(rand(1,$team->users->count()-1))->get();
        $total_workers = 0;
        $str = '';

        foreach($users as $user){
            $total_workers = $total_workers+$user->profile->salary;
            $str = $str.','.$user->id;
        }




         $total_replacement = $fail->replacements_sum_fail_replacementtotal;
         $total_supply = $fail->supplies_sum_fail_supplytotal;
         $total_service = $fail->services_sum_fail_servicetotal;
         $time = $fail->reported_at->diffInHours($fail->repareid_ad);
         $days = $fail->reported_at->diffInDays($fail->repareid_ad);
         $resume = new Resume();
         $resume->fail =$fail->id;
         $resume->equipment = $fail->equipment_id;
         $resume->type = $fail->type;
         $resume->total_replacement = $total_replacement;
         $resume->total_supply = $total_supply;
         $resume->total_service = $total_service;
         $resume->total_workers = $total_workers;
         $resume->workers = $str;
         $resume->total=$total_workers+$total_replacement+$total_service+$total_supply;
         $resume->reported_at = $fail->reported_at;
         $resume->repareid_at=$fail->repareid_at;
         $resume->time = $time;
         $resume->days = $days;
$resume->save();


        }

    }
}
