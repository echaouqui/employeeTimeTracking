<?php

namespace App\Http\Livewire;

use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdminComponent extends Component
{
    public $sessions;

    public function mount()
    {
        $group_sessions = Attendance::select('day', 'user_id', DB::raw('count(*) as total'), DB::raw('sum(hours) as hs') , DB::raw('sum(minutes) as ms'), 'start', 'end')
        ->where('created_at', '>=', now()->subMonth()->toDateTimeString())
        ->orderBy('created_at', 'DESC')
        ->groupBy(DB::raw('Date(day)'), "user_id")
        ->get();

        $group_sessions->each(function($item) 
        {
            $min = Attendance::select('start')
                    ->where('day', $item->day )
                    ->where('user_id', $item->user_id )
                    ->orderBy('start', 'ASC')->first()->start;
            $max = Attendance::select('end')
                    ->where('day', $item->day )
                    ->where('user_id', $item->user_id )
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
        return view('livewire.admin-component');
    }
}
