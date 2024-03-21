<?php

namespace Modules\Users\Http\Controllers\Actions;

use Modules\Users\Entities\User;

class DestroyUserAction
{
    function execute($id)
    {
        // Get user and delete
        User::destroy($id);

        // return
        return true;
    }
}
#