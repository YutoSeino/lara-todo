<?php

namespace App\Http\Controllers;
use App\Models\Calendar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CalendarController extends Controller
{
    public function show(){
        return view('calendars.show');
    }

    public function EventGet() {
        $add_month = new Carbon('next month');
        $sub_month = new Carbon('last month');
       
        return Calendar::query()
            ->select(
                // FullCalendarの形式に合わせる
                'event_name as title',
                'start_date as start',
                'end_date as end',
            )
            // FullCalendarの表示範囲のみ表示
            ->where('start_date', '>', $sub_month)
            ->where('end_date', '<', $add_month)
            ->get()->toArray();
    }
}
