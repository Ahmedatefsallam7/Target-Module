<?php

namespace Modules\Targets\Entities;

use Modules\Users\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Targets\Entities\TargetAchievement;

class Target extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "user_id",
        'title',
        'description',
        'type',
        'duration',
        'amount',
        'start_date',
        'end_date',
    ];

    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    function target_achievements()
    {
        return $this->hasMany(TargetAchievement::class);
    }
}
