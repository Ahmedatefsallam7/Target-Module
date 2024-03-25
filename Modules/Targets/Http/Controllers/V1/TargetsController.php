<?php

namespace Modules\Targets\Http\Controllers\V1;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Modules\Users\Traits\GeneralTrait;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Modules\Targets\Http\Requests\Target\StoreTargetRequest;
use Modules\Targets\Http\Requests\Target\UpdateTargetRequest;
use Modules\Targets\Http\Requests\Target\GetTargetByIdRequest;
use Modules\Targets\Http\Controllers\Actions\Target\StoreTargetAction;
use Modules\Targets\Http\Controllers\Actions\Target\UpdateTargetAction;
use Modules\Targets\Http\Controllers\Actions\Target\DestroyTargetAction;
use Modules\Targets\Http\Controllers\Actions\Target\GetTargetByIdAction;
use Modules\Targets\Http\Controllers\Actions\Target\SearchTargetQueryAction;

class TargetsController extends Controller
{
    use GeneralTrait;

    private $searchTargetQueryAction;
    private $storeTargetAction;
    private $getTargetByIdAction;
    private $updateTargetAction;
    private $destroyTargetAction;

    public function __construct(
        SearchTargetQueryAction $searchTargetQueryAction,
        StoreTargetAction $storeTargetAction,
        GetTargetByIdAction $getTargetByIdAction,
        UpdateTargetAction $updateTargetAction,
        DestroyTargetAction $destroyTargetAction
    ) {
        $this->searchTargetQueryAction = $searchTargetQueryAction;
        $this->storeTargetAction = $storeTargetAction;
        $this->getTargetByIdAction = $getTargetByIdAction;
        $this->updateTargetAction = $updateTargetAction;
        $this->destroyTargetAction = $destroyTargetAction;
    }

    public function index(Request $request)
    {

        // Search
        $targets = $this->searchTargetQueryAction->execute($request)->with('creator');

        // Response
        $data = DataTables::of($targets)
            ->addColumn('created_at', function ($target) {
                return $target->created_at->format('M j, Y | h:i A');
            })
            ->make(true)->original;

        return $this->successResponse(__("main.records_has_been_retrieved_successfully"), $data);
    }

    public function store(StoreTargetRequest $request)
    {
        // Data Setup
        $data = $this->unsetNullValues($request->all());

        // Store
        $target = $this->storeTargetAction->execute($data);

        $record = Str::plural('record', $target);

        // Response
        return $this->successResponse(__("main.{$record}_has_been_created_successfully"), $target);
    }

    public function show(GetTargetByIdRequest $request, $id)
    {
        // Get It
        $target = $this->getTargetByIdAction->execute($request->id);

        // response
        return $this->successResponse(__("main.record_has_been_retrieved_successfully"), $target);
    }

    public function update(UpdateTargetRequest $request, $id)
    {
        // Data Setup
        $data = $this->unsetNullValues($request->all());

        // Update
        $target = $this->updateTargetAction->execute($data);

        // Response
        return $this->successResponse(__("main.record_has_been_updated_successfully"), $target);
    }

    public function destroy(GetTargetByIdRequest $request, $id)
    {
        $this->destroyTargetAction->execute($request->id);

        // Response
        return $this->successResponse(__('main.record_has_been_deleted_successfully'), null);
    }
}