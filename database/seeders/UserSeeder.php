<?php

namespace Database\Seeders;

use App\Models\Specialty;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
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
        $user= User::create([
            'name' => 'Edwin Henriquez',
            'email' => 'ed@gmail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('123'),
            'remember_token' => Str::random(10),
        ]);

        $user->assignRole('admin');

        $user= User::create([
            'name' => 'Planer Edwin Henriquez',
            'email' => 'planner@gmail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('123'),
            'remember_token' => Str::random(10),
        ]);

        $user->assignRole('planner');


        $user= User::create([
            'name' => 'Storer Edwin Henriquez',
            'email' => 'storer@gmail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('123'),
            'remember_token' => Str::random(10),
        ]);

        $user->assignRole('storer');


        $user= User::create([
            'name' => 'RRHH Edwin Henriquez',
            'email' => 'rrhh@gmail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('123'),
            'remember_token' => Str::random(10),
        ]);

        $user->assignRole('rrhh');

        $user= User::create([
            'name' => 'Supervisor Edwin Henriquez',
            'email' => 'supervisor@gmail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('123'),
            'remember_token' => Str::random(10),
        ]);

        $user->assignRole('supervisor');

        $user= User::create([
            'name' => 'Jefe de Team de tareas',
            'email' => 'tecnico@gmail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('123'),
            'remember_token' => Str::random(10),
        ]);

        $user->assignRole('tecnico');

        $team = Team::create([
            'name' => 'Equipo de Tareas',
            'specialty_id' => Specialty::all()->random()->id,
            'user_id' => $user->id,
            'personal_team' => true,
        ]);

        $user= User::create([
            'name' => 'Jefe Edwin Henriquez',
            'email' => 'jefe@gmail.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('123'),
            'remember_token' => Str::random(10),
        ]);

        $user->assignRole('jefe');


        User::factory(4)->create()->each(function($user) use($team){
            $user->profile->salary = rand(3000,50000);
            $user->profile->save();
            $team->users()->attach($user->id);
        });


        User::factory(30)->create()->each(function($user){
            $user->profile->salary = rand(3000,50000);
            $user->profile->save();
        });


    }


}
