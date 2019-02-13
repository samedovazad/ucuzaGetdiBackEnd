<?php

namespace App\Models\Admin;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $timestamps = false;
    private $availableModules = false;


    public function getModulePriv($module){
        if (!isset($this->getAviableModules()[$module])) return 1;
        return $this->getAviableModules()[$module];
    }

    public function getAviableModules(){
        if ($this->aviable_modules == null) return [];
        return $this->availableModules ? $this->availableModules : ($this->availableModules = json_decode($this->aviable_modules, true));
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
