<?php

namespace Modules\Targets\Http\Controllers\Actions\Target;

use Modules\Targets\Entities\Target;

class DestroyTargetAction
{
    function execute($id)
    {
        // Get Target
        $target = Target::destroy($id);

        // return
        return true;
    }
}
