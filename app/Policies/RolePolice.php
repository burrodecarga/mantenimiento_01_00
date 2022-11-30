<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class RolePolice
{
    use HandlesAuthorization;

   public function isDeleted(User $user, Role $role){
      if($role->name=='admin' || $role->name=='super-admin'){
        return false;
      }else {return true;}
   }
}
