<?php

namespace Modules\Targets\Entities;

use Modules\Users\Entities\User;
use Modules\Targets\Entities\Target;
use Illuminate\Database\Eloquent\Model;

class TargetAchievement extends Model
{

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "user_id",
        "target_id",
        "achieved_amount",
        "percentage",
        'is_completed'
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function target()
    {
        return $this->belongsTo(Target::class);
    }
}