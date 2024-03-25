<?php

namespace Modules\Targets\Entities;

use Modules\Users\Entities\User;
use Modules\Targets\Entities\Target;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class TargetAchievement extends Model {

    use Userstamps, SoftDeletes;

    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED_BY = 'deleted_by';

    protected $fillable = [
        'user_id',
        'target_id',
        'achieved_amount',
        'percentage',
    ];

    function user() {
        return $this->belongsTo( User::class );
    }

    function target() {
        return $this->belongsTo( Target::class );
    }
}