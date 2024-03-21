<?php

namespace Modules\Users\Http\Controllers\Actions;

use Modules\Users\Entities\User;

class DestroyUserAction
{
    public function execute($id)
    {
        // Get user and delete
        User::destroy($id);

        // return
        return true;
    }
}
