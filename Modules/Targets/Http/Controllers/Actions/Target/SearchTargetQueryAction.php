<?php

namespace Modules\Targets\Http\Controllers\Actions\Target;

use Modules\Targets\Entities\Target;

class SearchTargetQueryAction
{
    function execute($request)
    {
        // Get Users
        $targets = Target::query();

        // return
        return $targets;
    }
}
