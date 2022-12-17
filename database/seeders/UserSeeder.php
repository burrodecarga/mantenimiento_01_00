<?php

namespace Database\Seeders;

use App\Models\Specialty;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Edwin Henriquez',
            'email' => 'ed@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
            'remember_token' => Str::random(10),
        ]);

        $admin->syncRoles([]);
        $admin->syncRoles(['admin']);

        $planner = User::create([
            'name' => 'Planer Edwin Henriquez',
            'email' => 'planner@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
            'remember_token' => Str::random(10),
        ]);

        $planner->syncRoles([]);
        $planner->syncRoles(['planner']);

        $storer = User::create([
            'name' => 'Storer Edwin Henriquez',
            'email' => 'storer@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
            'remember_token' => Str::random(10),
        ]);

        $storer->syncRoles([]);
        $storer->syncRoles(['storer']);

        $rrhh = User::create([
            'name' => 'RRHH Edwin Henriquez',
            'email' => 'rrhh@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
            'remember_token' => Str::random(10),
        ]);
        $rrhh->syncRoles([]);
        $rrhh->syncRoles(['rrhh']);

        $super = User::create([
            'name' => 'Supervisor Edwin Henriquez',
            'email' => 'supervisor@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
            'remember_token' => Str::random(10),
        ]);

        $super->syncRoles([]);
        $super->syncRoles(['supervisor']);

        $tecnico = User::create([
            'name' => 'Jefe de Team de tareas',
            'email' => 'tecnico@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
            'remember_token' => Str::random(10),
        ]);
        $tecnico->syncRoles([]);
        $tecnico->syncRoles(['tecnico']);

        $team = Team::create([
            'name' => 'Equipo de Tareas',
            'specialty_id' => Specialty::all()->random()->id,
            'user_id' => $tecnico->id,
            'personal_team' => true,
        ]);

        $jefe = User::create([
            'name' => 'Jefe Edwin Henriquez',
            'email' => 'jefe@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
            'remember_token' => Str::random(10),
        ]);
        $jefe->syncRoles([]);
        $jefe->syncRoles(['jefe']);

        $ceo = User::create([
            'name' => 'CEO Edwin Henriquez',
            'email' => 'ceo@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
            'remember_token' => Str::random(10),
        ]);

        $ceo->syncRoles([]);
        $ceo->syncRoles(['ceo']);

        User::factory(4)->create()->each(function ($user) use ($team) {
            $user->syncRoles([]);
            $user->profile->salary = rand(3000, 5000);
            $user->profile->save();
            $team->users()->attach($user->id);
        });

        User::factory(30)->create()->each(function ($user) {
            $user->syncRoles([]);
            $user->profile->salary = rand(3000, 5000);
            $user->profile->save();
        });

    }

}
