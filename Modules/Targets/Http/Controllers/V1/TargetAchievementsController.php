<?php

namespace Modules\Targets\Http\Controllers\V1;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Modules\Users\Traits\GeneralTrait;
use Modules\Targets\Http\Requests\TargetAchievement\UpdateTargetAchievementRequest;
use Modules\Targets\Http\Requests\TargetAchievement\GetTargetAchievementByIdRequest;
use Modules\Targets\Http\Controllers\Actions\TargetAchievement\UpdateTargetAchievementAction;
use Modules\Targets\Http\Controllers\Actions\TargetAchievement\DestroyTargetAchievementAction;
use Modules\Targets\Http\Controllers\Actions\TargetAchievement\GetTargetAchievementByIdAction;
use Modules\Targets\Http\Controllers\Actions\TargetAchievement\SearchTargetAchievementsQueryAction;

class TargetAchievementsController extends Controller
{
    use GeneralTrait;
    private $searchTargetAchievementsQueryAction;
    private $getTargetAchievementByIdAction;
    private $updateTargetAchievementAction;
    private $destroyTargetAchievementAction;

    public function __construct(
        SearchTargetAchievementsQueryAction $searchTargetAchievementsQueryAction,
        GetTargetAchievementByIdAction $getTargetAchievementByIdAction,
        UpdateTargetAchievementAction $updateTargetAchievementAction,
        DestroyTargetAchievementAction $destroyTargetAchievementAction
    ) {
        $this->searchTargetAchievementsQueryAction = $searchTargetAchievementsQueryAction;
        $this->getTargetAchievementByIdAction = $getTargetAchievementByIdAction;
        $this->updateTargetAchievementAction = $updateTargetAchievementAction;
        $this->destroyTargetAchievementAction = $destroyTargetAchievementAction;
    }


    public function index(Request $request)
    {
        // Search
        $achievements = $this->searchTargetAchievementsQueryAction->execute($request)->with('creator');

        // Response
        $data = DataTables::of($achievements)
            ->addColumn('created_at', function ($target) {
                return $target->created_at->format('M j, Y | h:i A');
            })
            ->make(true)->original;

        return $this->successResponse(__("main.records_has_been_retrieved_successfully"), $data);
    }

    public function show(GetTargetAchievementByIdRequest $request, $id)
    {
        // Get It
        $target_achievement = $this->getTargetAchievementByIdAction->execute($request->id);

        // response
        return $this->successResponse(__("main.record_has_been_retrieved_successfully"), $target_achievement);
    }

    public function update(UpdateTargetAchievementRequest $request, $id)
    {
        // Data Setup
        $data = $this->unsetNullValues($request->all());

        // Update
        $achievement = $this->updateTargetAchievementAction->execute($data);

        // Response
        return $this->successResponse(__("main.record_has_been_updated_successfully"), $achievement);
    }

    public function destroy(GetTargetAchievementByIdRequest $request, $id)
    {
        $this->destroyTargetAchievementAction->execute($request->id);

        // Response
        return $this->successResponse(__('main.record_has_been_deleted_successfully'), null);
    }
}