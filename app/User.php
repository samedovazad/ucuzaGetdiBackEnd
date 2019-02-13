<?php

namespace App;

use App\Helper\Standarts;
use App\Models\Admin\Group;
use App\Models\Admin\IgnoreUser;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public static function type($type){
        return self::where('user_type',Standarts::user_types[$type]);
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function fullname(){
        return $this->name." ".$this->surname;
    }

    public function avatar(){
        return $this->avatar != null ?
            Storage::url($this->avatar)
            : asset(Standarts::fileDirectories['avatarFiles'].'user.png');
    }

    public function birthday(){
        return Carbon::parse($this->birthday)->format('d-m-Y');
    }


    public function phone($numberType){

    }

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function isIgnore(){
        return IgnoreUser::where('user_id',$this->id)->whereNull('deleted_at') ? false : true;
    }


}
