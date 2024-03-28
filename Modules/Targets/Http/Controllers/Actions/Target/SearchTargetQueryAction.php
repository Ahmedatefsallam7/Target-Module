<?php

namespace Modules\Targets\Http\Controllers\Actions\Target;

use Modules\Targets\Entities\Target;

class SearchTargetQueryAction
{
    public function execute($request)
    {
        $targets = Target::query();

        $this->applyFilters($targets, $request);
        $this->applyOrdering($targets, $request);
        $this->applySearch($targets, $request);

        return $targets;
    }

    private function applyFilters($query, $request)
    {
        if ($request->has(['start_date', 'end_date'])) {
            $query->whereBetween('start_date', [$request->input('start_date'), $request->input('end_date')]);
        }
    }

    private function applyOrdering($query, $request)
    {
        if ($request->has(['order_by', 'order_direction'])) {
            $query->orderBy($request->input('order_by'), $request->input('order_direction'));
        }
    }

    private function applySearch($query, $request)
    {
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($query) use ($searchTerm) {
                $query->where('subject', 'like', "%$searchTerm%")
                    ->orWhere('description', 'like', "%$searchTerm%")
                    ->orWhere('type', 'like', "%$searchTerm%")
                    ->orWhere('duration', 'like', "%$searchTerm%")
                    ->orWhere('amount', 'like', "%$searchTerm%")
                    ->orWhere('start_date', 'like', "%$searchTerm%")
                    ->orWhere('end_date', 'like', "%$searchTerm%");
            });
        }
    }
}
