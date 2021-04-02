<?php

namespace App\Http\Livewire;

use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LogsComponent extends Component
{

    public $sessions;

    public function mount()
    {
        $group_sessions = Attendance::select('day', DB::raw('count(*) as total'), DB::raw('sum(hours) as hs') , DB::raw('sum(minutes) as ms'), 'start', 'end')
        ->id()
        ->where('created_at', '>=', now()->subMonth()->toDateTimeString())
        ->orderBy('created_at', 'DESC')
        ->groupBy(DB::raw('Date(day)'))
        ->get();

        $group_sessions->each(function($item) 
        {
            $min = Attendance::select('start')
                    ->id()
                    ->where('day', $item->day )
                    ->orderBy('start', 'ASC')->first()->start;
            $max = Attendance::select('end')
                    ->id()
                    ->where('day', $item->day )
                    ->orderBy('end', 'DESC')->first()->end;

            $hours = $item->hs < 10 ? "0". $item->hs : $item->hs;
            $minutes = $item->ms < 10 ? "0". $item->ms : $item->ms;
            $hours = $hours .":". $minutes;

            $item->start = $min;
            $item->end = $max;
            $item->hours = $hours;
            
            return $item->session;
        });

        $this->sessions = $group_sessions;

    }
    public function render()
    {
        return view('livewire.logs-component');
    }
}
