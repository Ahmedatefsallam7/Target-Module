<?php

namespace Modules\Users\Http\Controllers\Actions;

use Modules\Users\Entities\User;

class SearchUserQueryAction
{
    public function execute($request)
    {
        // Get Users
        $users = User::query();

        // return
        return $users;
    }
}
