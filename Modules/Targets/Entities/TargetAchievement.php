<?php

namespace Modules\Targets\Entities;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class TargetAchievement extends Model {

    use Userstamps, SoftDeletes;

    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED_BY = 'deleted_by';

    protected $fillable = [
        'achievable_type',
        'achievable_id',
        'achieved_amount',
        'percentage',
    ];

    public function achievable(): MorphTo {
        return $this->morphTo();
    }
}
