<?php

namespace Modules\Targets\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Users\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Targets\Entities\TargetAchievement;
use Wildside\Userstamps\Userstamps;

class Target extends Model {

    use Userstamps, SoftDeletes;
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED_BY = 'deleted_by';

    protected $fillable = [
        'user_id',
        'subject',
        'description',
        'type',
        'duration',
        'amount',
        'start_date',
        'end_date',
    ];

    function user() {
        return $this->belongsTo( User::class, 'user_id' );
    }

    function target_achievements() {
        return $this->hasMany( TargetAchievement::class );
    }
}