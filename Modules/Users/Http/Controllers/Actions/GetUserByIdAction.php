<?php

namespace Modules\Users\Http\Controllers\Actions;

use Modules\Users\Entities\User;

class GetUserByIdAction
{
    public function execute($id)
    {
        // Get User
        $user = User::with([
            'targets',
            'target_achievements' => function ($q) {
                return $q->where('is_completed', 1);
            }
        ])->withCount([
            'targets',
            'target_achievements' => function ($q) {
                return $q->where('is_completed', 1);
            }
        ])
            ->find($id);

        // return
        return $user;
    }
}
