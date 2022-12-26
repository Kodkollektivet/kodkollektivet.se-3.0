<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\event;


class CalendarController extends Controller
{
    public function index()
    {
        $month_start = strtotime('midnight first day of this month');
        $events      = array();

        foreach (event::where('date', '>=', date('Y-m-d', $month_start))->get() as &$event)
        {
            $event->link = \App\Http\Controllers\ItemController::prepareLink($event->name);
            $events[strtotime(substr($event->date, 0, strpos($event->date, 'T')))] = $event;
        }

        return (object) [
            'dow'         => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            'month_start' => $month_start,
            'count_days'  => cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')),
            'today'       => strtotime('today'),
            'events'      => $events
        ];
    }
}
