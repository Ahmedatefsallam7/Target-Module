<?php

namespace Modules\Users\Entities;

use Modules\Targets\Entities\Target;
use Modules\Users\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Targets\Entities\TargetAchievement;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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

    public function targets(): MorphMany {
        return $this->morphMany( Target::class, 'targetable' );
    }

    public function targetAchievements(): MorphMany {
        return $this->morphMany( TargetAchievement::class, 'achievable' );
    }
}
