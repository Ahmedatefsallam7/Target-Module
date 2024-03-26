<?php

namespace Modules\Users\Http\Controllers\Actions;

use Modules\Users\Entities\User;

class GetUserByIdAction {
    public function execute( $id ) {
        // Get User
        $user = User::with( [ 'targets' ] )->withCount( [ 'targets' ] )->find( $id );

        // return
        return $user;
    }
}