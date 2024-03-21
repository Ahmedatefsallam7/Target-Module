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
    private $searchUserQueryAction;
    private $storeUserAction;
    private $getUserByIdAction;
    private $updateUserAction;
    private $destroyUserAction;

    public function __construct(
        SearchUserQueryAction $searchUserQueryAction,
        StoreUserAction $storeUserAction,
        GetUserByIdAction $getUserByIdAction,
        UpdateUserAction $updateUserAction,
        DestroyUserAction $destroyUserAction
    ) {
        $this->searchUserQueryAction = $searchUserQueryAction;
        $this->storeUserAction = $storeUserAction;
        $this->getUserByIdAction = $getUserByIdAction;
        $this->updateUserAction = $updateUserAction;
        $this->destroyUserAction = $destroyUserAction;
    }

    public function index(Request $request)
    {
        $users = $this->searchUserQueryAction->execute($request);

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

        $user = $this->storeUserAction->execute($data);

        $record = Str::plural('record', $user);

        return $this->successResponse(__('main.' . $record . '_has_been_created_successfully'), $user);
    }

    public function show(GetUserByIdRequest $request)
    {
        $user = $this->getUserByIdAction->execute($request->id);

        return $this->successResponse(__('main.record_has_been_retrieved_successfully'), $user);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $data = $this->unsetNullValues($request->all());

        $user = $this->updateUserAction->execute($data);

        return $this->successResponse(__('main.record_has_been_updated_successfully'), $user);
    }

    public function destroy(GetUserByIdRequest $request, $id)
    {
        $this->destroyUserAction->execute($request->id);

        return $this->successResponse(__('main.record_has_been_deleted_successfully'), null);
    }
}
