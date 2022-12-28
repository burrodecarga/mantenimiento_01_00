<?php

namespace Database\Seeders;

use App\Models\Fail;
use App\Models\Profile;
use App\Models\Team;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Team::factory(8)->create()->each(function ($team) {
            $zones = Zone::all()->random()->pluck('id');
            $team->zones()->attach($zones);
            $users = User::where('id', '>', 8)->get()->random(4)->pluck('id');
            $role = Role::find(7);
            foreach ($users as $user) {
                User::find($user)->assignRole($role);

            }

            $team->users()->attach($users);
        });

        $team = Team::find(1);
        $fails = Fail::all()->random(4)->pluck('id');
        $team->fails()->attach($fails);

        $n =rand(3000,5000);
        Profile::where('salary',0)->update(['salary'=>$n]);
    }
}
