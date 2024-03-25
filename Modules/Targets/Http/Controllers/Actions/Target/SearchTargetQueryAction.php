<?php

namespace Modules\Targets\Http\Controllers\Actions\Target;

use Modules\Targets\Entities\Target;

class SearchTargetQueryAction
{
    public function execute($request)
    {
        $targets = Target::query();

        // filter
        if ($request->input('start_date') && $request->input('end_date')) {
            $targets->whereBetween('start_date', [$request->input('start_date'), $request->input('end_date')]);
        }

        // order
        if ($request->input('order_by') && $request->input('order_direction')) {
            $targets->orderBy($request->input('order_by'), $request->input('order_direction'));
        }

        // search
        if ($request->input('search')) {
            $searchTerm = $request->input('search');
            $targets->where(function ($query) use ($searchTerm) {
                $query->where('subject', 'like', "%$searchTerm%")
                    ->orWhere('description', 'like', "%$searchTerm%")
                    ->orWhere('type', 'like', "%$searchTerm%")
                    ->orWhere('duration', 'like', "%$searchTerm%")
                    ->orWhere('amount', 'like', "%$searchTerm%")
                    ->orWhere('start_date', 'like', "%$searchTerm%")
                    ->orWhere('end_date', 'like', "%$searchTerm%");
            });
        }


        return $targets;
    }
}