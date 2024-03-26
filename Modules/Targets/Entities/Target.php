<?php

namespace Modules\Targets\Entities;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Targets\Entities\TargetAchievement;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Target extends Model {

    use Userstamps, SoftDeletes;
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED_BY = 'deleted_by';

    protected $fillable = [
        'targetable_type',
        'targetable_id',
        'subject',
        'description',
        'type',
        'duration',
        'amount',
        'start_date',
        'end_date',
    ];

    public function targetable(): MorphTo {
        return $this->morphTo();
    }

    public function targetAchievements(): MorphMany {
        return $this->morphMany( TargetAchievement::class, 'achievable' );

    }
}
