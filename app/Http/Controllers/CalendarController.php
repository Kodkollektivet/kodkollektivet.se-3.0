<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\event;


class CalendarController extends Controller
{
    public function index(string $start = 'midnight first day of this month')
    {
        $month_start = strtotime($start);
        $events      = array();

        foreach (event::where('date', '>=', date('Y-m-d', $month_start))->get() as &$event)
        {
            $event->link = \App\Http\Controllers\ItemController::prepareLink($event->name);
            $events[strtotime(substr($event->date, 0, strpos($event->date, 'T')))] = $event;
        }

        return (object) [
            'dow'         => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            'month_start' => $month_start,
            'today'       => strtotime('today'),
            'events'      => $events
        ];
    }

    public function year()
    {
        return view('common.calendar')->with([
            'footer'   => \App\View\Components\CommonLayout::footer(),
            'calendar' => CalendarController::index('first day of January '.date('Y')),
            'links'    => \App\Http\Controllers\EventController::$links,
            'uri'      => 'event-calendar'
        ]);
    }

    public function export() {
        $calendar = CalendarController::index('first day of January '.date('Y'));
    }
}
