<?php

namespace Modules\Users\Entities;

use Modules\Targets\Entities\Target;
use Modules\Users\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Targets\Entities\TargetAchievement;

class User extends Model {
    use  GeneralTrait, SoftDeletes;

    /**
    * The attributes that are mass assignable.
    */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'department',
    ];

    function targets() {
        return $this->hasMany( Target::class );
    }

    function target_achievements() {
        return $this->hasMany( TargetAchievement::class );
    }
}