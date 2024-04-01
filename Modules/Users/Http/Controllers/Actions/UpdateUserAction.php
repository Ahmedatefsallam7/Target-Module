<?php

namespace Modules\Users\Http\Controllers\Actions;

use Modules\Users\Entities\User;
use Modules\Users\Transformers\UserResource;

class UpdateUserAction {
    function execute( array $data ) {
        // Get user
        $user = User::find( $data[ 'id' ] );

        // Update user data
        $user->update( $data );

        // Return updated user resource
        return new UserResource( $user );
    }
}