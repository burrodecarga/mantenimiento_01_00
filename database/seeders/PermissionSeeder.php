<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //listado de permisos para roles
        Permission::create(['name'=>'roles.index','permission'=>'role list']);
        Permission::create(['name'=>'roles.create','permission'=>'role create']);
        Permission::create(['name'=>'roles.store','permission'=>'role create']);
        Permission::create(['name'=>'roles.edit','permission'=>'role edit']);
        Permission::create(['name'=>'roles.update','permission'=>'role edit']);
        Permission::create(['name'=>'roles.destroy','permission'=>'role delete']);
        Permission::create(['name'=>'roles.show','permission'=>'role view']);

        //listado de permisos para permissions
        Permission::create(['name'=>'permissions.index','permission'=>'permission list']);
        Permission::create(['name'=>'permissions.create','permission'=>'permission create']);
        Permission::create(['name'=>'permissions.store','permission'=>'permission create']);
        Permission::create(['name'=>'permissions.edit','permission'=>'permission edit']);
        Permission::create(['name'=>'permissions.update','permission'=>'permission edit']);
        Permission::create(['name'=>'permissions.destroy','permission'=>'permission delete']);
        Permission::create(['name'=>'permissions.show','permission'=>'permission view']);

        //listado de permisos para users
        Permission::create(['name'=>'users.index','permission'=>'user list']);
        Permission::create(['name'=>'users.create','permission'=>'user create']);
        Permission::create(['name'=>'users.store','permission'=>'user create']);
        Permission::create(['name'=>'users.edit','permission'=>'user edit']);
        Permission::create(['name'=>'users.update','permission'=>'user edit']);
        Permission::create(['name'=>'users.destroy','permission'=>'user delete']);
        Permission::create(['name'=>'users.show','permission'=>'user view']);

        //listado de permisos para zones
        Permission::create(['name'=>'zones.index','permission'=>'zone list']);
        Permission::create(['name'=>'zones.create','permission'=>'zone create']);
        Permission::create(['name'=>'zones.store','permission'=>'zone create']);
        Permission::create(['name'=>'zones.edit','permission'=>'zone edit']);
        Permission::create(['name'=>'zones.update','permission'=>'zone edit']);
        Permission::create(['name'=>'zones.destroy','permission'=>'zone delete']);
        Permission::create(['name'=>'zones.show','permission'=>'zone view']);

        //listado de permisos para systems
        Permission::create(['name'=>'subsystems.index','permission'=>'subsystem list']);
        Permission::create(['name'=>'subsystems.create','permission'=>'subsystem create']);
        Permission::create(['name'=>'subsystems.store','permission'=>'subsystem create']);
        Permission::create(['name'=>'subsystems.edit','permission'=>'subsystem edit']);
        Permission::create(['name'=>'subsystems.update','permission'=>'subsystem edit']);
        Permission::create(['name'=>'subsystems.destroy','permission'=>'subsystem delete']);
        Permission::create(['name'=>'subsystems.show','permission'=>'subsystem view']);

        //listado de permisos para subsystems
        Permission::create(['name'=>'systems.index','permission'=>'system list']);
        Permission::create(['name'=>'systems.create','permission'=>'system create']);
        Permission::create(['name'=>'systems.store','permission'=>'system create']);
        Permission::create(['name'=>'systems.edit','permission'=>'system edit']);
        Permission::create(['name'=>'systems.update','permission'=>'system edit']);
        Permission::create(['name'=>'systems.destroy','permission'=>'system delete']);
        Permission::create(['name'=>'systems.show','permission'=>'system view']);

        //listado de permisos para prototypes
        Permission::create(['name'=>'prototypes.index','permission'=>'prototype list']);
        Permission::create(['name'=>'prototypes.create','permission'=>'prototype create']);
        Permission::create(['name'=>'prototypes.store','permission'=>'prototype create']);
        Permission::create(['name'=>'prototypes.edit','permission'=>'prototype edit']);
        Permission::create(['name'=>'prototypes.update','permission'=>'prototype edit']);
        Permission::create(['name'=>'prototypes.destroy','permission'=>'prototype delete']);
        Permission::create(['name'=>'prototypes.show','permission'=>'prototype view']);

        //permisos 49

        //listado de permisos para protocols
        Permission::create(['name'=>'protocols.index','permission'=>'protocol list']);
        Permission::create(['name'=>'protocols.create','permission'=>'protocol create']);
        Permission::create(['name'=>'protocols.store','permission'=>'protocol create']);
        Permission::create(['name'=>'protocols.edit','permission'=>'protocol edit']);
        Permission::create(['name'=>'protocols.update','permission'=>'protocol edit']);
        Permission::create(['name'=>'protocols.destroy','permission'=>'protocol delete']);
        Permission::create(['name'=>'protocols.show','permission'=>'protocol view']);

        //permisos 63
        //listado de permisos para prototype-protocols
        Permission::create(['name'=>'prototypes.protocols.index','permission'=>'prototype-protocol list']);
        Permission::create(['name'=>'prototypes.protocols.create','permission'=>'prototype-protocol create']);
        Permission::create(['name'=>'prototypes.protocols.store','permission'=>'prototype-protocol create']);
        Permission::create(['name'=>'prototypes.protocols.edit','permission'=>'prototype-protocol edit']);
        Permission::create(['name'=>'prototypes.protocols.update','permission'=>'prototype-protocol edit']);
        Permission::create(['name'=>'prototypes.protocols.destroy','permission'=>'prototype-protocol delete']);
        Permission::create(['name'=>'prototypes.protocols.show','permission'=>'prototype-protocol view']);


         //permisos 70
        //listado de permisos para equipments
        Permission::create(['name'=>'equipments.index','permission'=>'equipment list']);
        Permission::create(['name'=>'equipments.create','permission'=>'equipment create']);
        Permission::create(['name'=>'equipments.store','permission'=>'equipment create']);
        Permission::create(['name'=>'equipments.edit','permission'=>'equipment edit']);
        Permission::create(['name'=>'equipments.update','permission'=>'equipment edit']);
        Permission::create(['name'=>'equipments.destroy','permission'=>'equipment delete']);
        Permission::create(['name'=>'equipments.show','permission'=>'equipment view']);

         //permisos 77
        //listado de permisos para equipments
        Permission::create(['name'=>'features.index','permission'=>'feature list']);
        Permission::create(['name'=>'features.create','permission'=>'feature create']);
        Permission::create(['name'=>'features.store','permission'=>'feature create']);
        Permission::create(['name'=>'features.edit','permission'=>'feature edit']);
        Permission::create(['name'=>'features.update','permission'=>'feature edit']);
        Permission::create(['name'=>'features.destroy','permission'=>'feature delete']);
        Permission::create(['name'=>'features.show','permission'=>'feature view']);


         //listado de permisos para services 84
         Permission::create(['name'=>'services.index','permission'=>'services list']);
         Permission::create(['name'=>'services.create','permission'=>'services create']);
         Permission::create(['name'=>'services.store','permission'=>'services create']);
         Permission::create(['name'=>'services.edit','permission'=>'services edit']);
         Permission::create(['name'=>'services.update','permission'=>'services edit']);
         Permission::create(['name'=>'services.destroy','permission'=>'services delete']);
         Permission::create(['name'=>'services.show','permission'=>'services view']);

//listado de permisos para tools 91
Permission::create(['name'=>'tools.index','permission'=>'tools list']);
Permission::create(['name'=>'tools.create','permission'=>'tools create']);
Permission::create(['name'=>'tools.store','permission'=>'tools create']);
Permission::create(['name'=>'tools.edit','permission'=>'tools edit']);
Permission::create(['name'=>'tools.update','permission'=>'tools edit']);
Permission::create(['name'=>'tools.destroy','permission'=>'tools delete']);
Permission::create(['name'=>'tools.show','permission'=>'tools view']);


//listado de permisos para services 98
Permission::create(['name'=>'supplies.index','permission'=>'supplies list']);
Permission::create(['name'=>'supplies.create','permission'=>'supplies create']);
Permission::create(['name'=>'supplies.store','permission'=>'supplies create']);
Permission::create(['name'=>'supplies.edit','permission'=>'supplies edit']);
Permission::create(['name'=>'supplies.update','permission'=>'supplies edit']);
Permission::create(['name'=>'supplies.destroy','permission'=>'supplies delete']);
Permission::create(['name'=>'supplies.show','permission'=>'supplies view']);

//listado de permisos para replacements 104
Permission::create(['name'=>'replacements.index','permission'=>'replacements list']);
Permission::create(['name'=>'replacements.create','permission'=>'replacements create']);
Permission::create(['name'=>'replacements.store','permission'=>'replacements create']);
Permission::create(['name'=>'replacements.edit','permission'=>'replacements edit']);
Permission::create(['name'=>'replacements.update','permission'=>'replacements edit']);
Permission::create(['name'=>'replacements.destroy','permission'=>'replacements delete']);
Permission::create(['name'=>'replacements.show','permission'=>'replacements view']);

//listado de permisos para replacements 111
Permission::create(['name'=>'employes.index','permission'=>'employes list']);
Permission::create(['name'=>'employes.create','permission'=>'employes create']);
Permission::create(['name'=>'employes.store','permission'=>'employes create']);
Permission::create(['name'=>'employes.edit','permission'=>'employes edit']);
Permission::create(['name'=>'employes.update','permission'=>'employes edit']);
Permission::create(['name'=>'employes.destroy','permission'=>'employes delete']);
Permission::create(['name'=>'employes.show','permission'=>'employes view']);

//listado de permisos para replacements 118
Permission::create(['name'=>'teams.index','permission'=>'teams list']);
Permission::create(['name'=>'teams.create','permission'=>'teams create']);
Permission::create(['name'=>'teams.store','permission'=>'teams create']);
Permission::create(['name'=>'teams.edit','permission'=>'teams edit']);
Permission::create(['name'=>'teams.update','permission'=>'teams edit']);
Permission::create(['name'=>'teams.destroy','permission'=>'teams delete']);
Permission::create(['name'=>'teams.show','permission'=>'teams view']);

//listado de permisos para replacements 125
Permission::create(['name'=>'fails.index','permission'=>'fails list']);
Permission::create(['name'=>'fails.create','permission'=>'fails create']);
Permission::create(['name'=>'fails.store','permission'=>'fails create']);
Permission::create(['name'=>'fails.edit','permission'=>'fails edit']);
Permission::create(['name'=>'fails.update','permission'=>'fails edit']);
Permission::create(['name'=>'fails.destroy','permission'=>'fails delete']);
Permission::create(['name'=>'fails.show','permission'=>'fails view']);

//listado de permisos para replacements 127-128
Permission::create(['name'=>'fails.tasks','permission'=>'fails tasks']);
Permission::create(['name'=>'fails.repareid','permission'=>'fails repareid']);

//listado de permisos para replacements 129
Permission::create(['name'=>'plans.index','permission'=>'plans list']);
Permission::create(['name'=>'plans.create','permission'=>'plans create']);
Permission::create(['name'=>'plans.store','permission'=>'plans create']);
Permission::create(['name'=>'plans.edit','permission'=>'plans edit']);
Permission::create(['name'=>'plans.update','permission'=>'plans edit']);
Permission::create(['name'=>'plans.destroy','permission'=>'plans delete']);
Permission::create(['name'=>'plans.show','permission'=>'plans view']);

        }
}
