<?php

namespace Modules\Users\Http\Controllers\Actions;

use Modules\Users\Entities\User;
use Modules\Users\Transformers\UserResource;

class StoreUserAction
{
    function execute($data)
    {
        $users = [];

        // Store one user or more
        foreach ($data['users'] as $userData) {
            $user = User::create([
                "name" => $userData["name"],
                "email" => $userData["email"],
                "phone" => $userData["phone"] ?? null,
                "department" => $userData["department"],
            ]);

            $users[] = new UserResource($user);
        }

        //return
        return $users;
    }
}
#