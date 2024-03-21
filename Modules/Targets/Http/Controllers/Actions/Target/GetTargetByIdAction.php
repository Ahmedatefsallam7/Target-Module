<?php

namespace Modules\Targets\Http\Controllers\Actions\Target;

use Modules\Targets\Entities\Target;
use Modules\Targets\Transformers\TargetResource;

class GetTargetByIdAction
{
    function execute($id)
    {
        // Get Target
        $target = Target::find($id);

        // return
        return new TargetResource($target);
    }
}
