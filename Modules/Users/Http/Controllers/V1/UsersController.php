<?php

namespace Modules\Users\Http\Controllers\V1;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Modules\Users\Traits\GeneralTrait;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Modules\Users\Http\Requests\Users\StoreUserRequest;
use Modules\Users\Http\Requests\Users\UpdateUserRequest;
use Modules\Users\Http\Requests\Users\GetUserByIdRequest;
use Modules\Users\Http\Controllers\Actions\StoreUserAction;
use Modules\Users\Http\Controllers\Actions\UpdateUserAction;
use Modules\Users\Http\Controllers\Actions\DestroyUserAction;
use Modules\Users\Http\Controllers\Actions\GetUserByIdAction;
use Modules\Users\Http\Controllers\Actions\SearchUserQueryAction;

class UsersController extends Controller
{
    use GeneralTrait;
    private $userActions;

    public function __construct(
        SearchUserQueryAction $searchUserQueryAction,
        StoreUserAction $storeUserAction,
        GetUserByIdAction $getUserByIdAction,
        UpdateUserAction $updateUserAction,
        DestroyUserAction $destroyUserAction
    ) {
        $this->userActions = [
            'search' => $searchUserQueryAction,
            'store' => $storeUserAction,
            'getById' => $getUserByIdAction,
            'update' => $updateUserAction,
            'destroy' => $destroyUserAction
        ];
    }
    public function index(Request $request)
    {
        $users = $this->userActions['search']->execute($request);

        $data = DataTables::of($users)
            ->addColumn('created_at', function ($user) {
                return $user->created_at->format('M j, Y | h:i A');
            })
            ->make(true)
            ->original;

        return $this->successResponse(__('main.records_has_been_retrieved_successfully'), $data);
    }

    public function store(StoreUserRequest $request)
    {
        $data = $this->unsetNullValues($request->all());

        $user = $this->userActions['store']->execute($data);

        $record = Str::plural('record', $user);

        return $this->successResponse(__('main.' . $record . '_has_been_created_successfully'), $user);
    }

    public function show(GetUserByIdRequest $request)
    {
        $user = $this->userActions['getById']->execute($request->id);

        return $this->successResponse(__('main.record_has_been_retrieved_successfully'), $user);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $data = $this->unsetNullValues($request->all());

        $user = $this->userActions['update']->execute($data);

        return $this->successResponse(__('main.record_has_been_updated_successfully'), $user);
    }

    public function destroy(GetUserByIdRequest $request, $id)
    {
        $this->userActions['destroy']->execute($request->id);

        return $this->successResponse(__('main.record_has_been_deleted_successfully'), null);
    }
}