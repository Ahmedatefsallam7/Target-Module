<?php

namespace Modules\Users\Http\Controllers\Actions;

use Modules\Users\Entities\User;
use Modules\Users\Transformers\UserResource;

class UpdateUserAction
{
    function execute($data)
    {
        // Get user
        $user = User::find($data['id']);

        // update user
        $user->update($data);

        // return
        return new UserResource($user);
    }
}
#