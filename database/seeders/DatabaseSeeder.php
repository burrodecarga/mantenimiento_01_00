<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Equipment;
use App\Models\Fail;

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
$this->call(PermissionSeeder::class);
$this->call(RoleSeeder::class);

        $this->call(SpecialtySeeder::class);
        $this->call(UserSeeder::class);
$this->call(ZoneSeeder::class);
$this->call(SystemSeeder::class);
$this->call(TaskSeeder::class);
$this->call(FeatureSeeder::class);
$this->call(ProtocolSeeder::class);
$this->call(PrototypeSeeder::class);


$this->call(FailSeeder::class);
Equipment::factory(30)->create();
Fail::factory(230)->create();
$this->call(TeamSeeder::class);
$this->call(ReplacementSeeder::class);
$this->call(ServiceSeeder::class);
$this->call(SupplySeeder::class);
$this->call(ToolSeeder::class);
$this->call(PlanSeeder::class);

//$this->call(GoalSeeder::class);
//$this->call(TimelineSeeder::class);
$this->call(WorkSeeder::class);

    }
}
