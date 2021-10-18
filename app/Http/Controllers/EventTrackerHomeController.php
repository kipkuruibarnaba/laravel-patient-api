<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventTrackerHomeController extends Controller
{
    public function getEvents()
    {
        $events =Event::all();
        $programStartTime= Event::first();
        return $events;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getReport()
    {
        $report =Event::all();
        $programStartTime= Event::first();
        return $report;
    }

    public function start_task(Request $request, $timeseconds)
    {
        $calculatedTime= $timeseconds;
        $hour = (int)floor($calculatedTime/3600);
        $minute = (int)floor(($calculatedTime-($hour*3600))/60) ;
        $second = $calculatedTime - (($hour*3600) + ($minute*60));
        $hour =12 + $hour;
        $minute =00 + $minute;
        $second =00 + $second;
        $programmeDate = Carbon::createFromTime($hour, $minute, $second);
        $startLowestint = rand(10, 20);
        $event = new Event;
        $event->program_time = $programmeDate;
        $event->servers = $startLowestint;
        $event->status = 1;
        $data =$event->save();
        $reports =Event::all();
        return $reports;
    }

    public function stop_task(Request $request, $timeseconds)
    {
        $calculatedTime= $timeseconds;
        $hour = (int)floor($calculatedTime/3600);
        $minute = (int)floor(($calculatedTime-($hour*3600))/60) ;
        $second = $calculatedTime - (($hour*3600) + ($minute*60));
        $hour =12 + $hour;
        $minute =00 + $minute;
        $second =00 + $second;
        $programmeDate = Carbon::createFromTime($hour, $minute, $second);
        $totalServersRunning = Event::where(['status'=> 1])->pluck('servers')->sum();
        $stopRandom = rand(5, $totalServersRunning);
        $event = new Event;
        $event->program_time = $programmeDate;
        $event->servers = $stopRandom;
        $event->status = 2;
        $data =$event->save();
        $reports =Event::all();
        return $reports;
    }

    public function report_task(Request $request, $timeseconds)
    {
        $calculatedTime= $timeseconds;
        $hour = (int)floor($calculatedTime/3600);
        $minute = (int)floor(($calculatedTime-($hour*3600))/60) ;
        $second = $calculatedTime - (($hour*3600) + ($minute*60));
        $hour =12 + $hour;
        $minute =00 + $minute;
        $second =00 + $second;
        $programmeDate = Carbon::createFromTime($hour, $minute, $second);
        $totalServersRunning=Event::where(['status'=> 1])->pluck('servers')->sum();
        $totalServersStopped=Event::where(['status'=> 2])->pluck('servers')->sum();
        $event = new Event;
        $event->program_time = $programmeDate;
        $event->servers = $totalServersRunning-$totalServersStopped;
        $event->status = 3;
        $data =$event->save();
        $reports =Event::all();
        return $reports;
    }
    public function run_tasks(Request $request, $timeseconds)
    {
        $calculatedTime= $timeseconds;
        $hour = (int)floor($calculatedTime/3600);
        $minute = (int)floor(($calculatedTime-($hour*3600))/60) ;
        $second = $calculatedTime - (($hour*3600) + ($minute*60));
        $hour =12 + $hour;
        $minute =00 + $minute;
        $second =00 + $second;
        $programmeDate = Carbon::createFromTime($hour, $minute, $second);

        if($calculatedTime%30 == 0 ) {
            $startLowestint = rand(10, 20);
            $event = new Event;
            $event->program_time = $programmeDate;
            $event->servers = $startLowestint;
            $event->status = 1;
            $data =$event->save();
            $reports =Event::all();
            return $reports;
        }

        if($calculatedTime%40 == 0){
            $totalServersRunning = Event::where(['status'=> 1])->pluck('servers')->sum();
            $stopRandom = rand(5, $totalServersRunning);
            $event = new Event;
            $event->program_time = $programmeDate;
            $event->servers = $stopRandom;
            $event->status = 2;
            $data =$event->save();
            $reports =Event::all();
            return $reports;

        }

        if($calculatedTime%50 == 0){
            $totalServersRunning=Event::where(['status'=> 1])->pluck('servers')->sum();
            $totalServersStopped=Event::where(['status'=> 2])->pluck('servers')->sum();
            $event = new Event;
            $event->program_time = $programmeDate;
            $event->servers = $totalServersRunning-$totalServersStopped;
            $event->status = 3;
            $data =$event->save();
            $reports =Event::all();
            return $reports;
        }

    }
}
