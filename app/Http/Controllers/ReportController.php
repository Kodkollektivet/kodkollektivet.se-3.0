<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use App\Http\Controllers\ItemController;


class ReportController extends Controller
{
    public function index(User $user, bool $resolved = false) {

        if (isset($user->position_id)) {
            $reports = !$resolved ? Report::where('resolved', 0)->orderBy('id', 'desc')->get() : Report::where('resolved', 1)->orderBy('id', 'desc')->paginate(12);

            foreach ($reports as &$report) {
                $report->item = ReportController::getItem($report);
            }

            return view('common.reports')->with(['reports' => $reports, 'type' => $resolved ? 'resolved' : 'pending', 'footer' => \App\View\Components\CommonLayout::footer()]);

        } else {
            return redirect('/');
        }
    }

    public function toggleResolved(User $user, Request $request) {

        if (isset($user->position_id)) {
            $report = Report::find($request->id);

            if (isset($report)) {
                $report->resolved = !$report->resolved;
                $report->save();

                return response()->json(['success' => true]);
            }

        }
    }

    public function report(User $user, \App\Http\Requests\ReportRequest $request, string $type) {

        $model  = ItemController::getModel($type);
        $target = isset($model) ? $model::find($request->item_id) : null;

        if (isset($target)) {
            Report::create(['user_id' => $user->id, 'item_id' => $target->id, 'item_type' => $type, 'type' => $request->type, 'content' => $request->content]);

            return response()->json(['message' => 'Thanks. We\'ll look into this.']);
        }

        return response()->json(['message' => 'Report failed!'], 403);
    }

    private function getItem(Report $report) {
        
        $item = ItemController::getModel($report->item_type)::find($report->item_id);

        $report->item_type == 'comment' && isset($item) ? $item->actual = ($item->item_type != 'comment' ? ItemController::getModel($item->item_type)::find($item->item_id)
            : ItemController::getModel($item->threadStart->item_type)::find($item->threadStart->item_id)
        ) : null;

        isset($item->actual) ? $item->actual->link = ItemController::prepareLink($item->actual->name) : (
            isset($item) ? $item->link = ItemController::prepareLink($item->name) : null
        );

        return $item;
    }
}
