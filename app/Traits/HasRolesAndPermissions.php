<?php

namespace App\Traits;

use App\Role;
use App\Permission;

trait HasRolesAndPermissions{
    /**
     * @return mixed
     */
    /**
     * The roles that belong to the HasRolesAndPermissions
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role','users_roles');
    }
    /**
     * The permissions that belong to the HasRolesAndPermissions
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'users_permissions');
    }

    public function post(){
        return $this->hasMany('App\Post');
    }


    
    public function hasRole($role)
    {        
        if( strpos($role, ',') !== false ){//check if this is an list of roles

            $listOfRoles = explode(',',$role);

            foreach ($listOfRoles as $role) {                    
                if ($this->roles->contains('slug', $role)) {
                    return true;
                }
            }
        }else{                
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }

        return false;
    }



    
}