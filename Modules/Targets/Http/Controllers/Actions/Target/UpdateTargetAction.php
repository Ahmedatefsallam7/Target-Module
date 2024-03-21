<?php

namespace Modules\Targets\Http\Controllers\Actions\Target;

use Modules\Targets\Entities\Target;
use Modules\Targets\Transformers\TargetResource;

class UpdateTargetAction
{
    function execute($data)
    {
        // Get Target
        $target = Target::find($data['id']);

        // update
        $target->update($data);

        // return
        return new TargetResource($target);
    }
}
