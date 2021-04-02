<?php

namespace App\Http\Livewire;

use App\Models\Attendance;
use Carbon\Carbon;
use Livewire\Component;
use Jenssegers\Agent\Agent;

class DashboardComponent extends Component
{
    public $hours;
    public $sessions;
    public $stat = true;

    protected $listeners = ['session_end'];

    public function mount()
    {
        $this->sessions = Attendance::whereDate('created_at', today())->id()->get();
        // $sessions = Attendance::all();
        $hours = 0;
        $minutes = 0;
        foreach($this->sessions as $session)
        {
            $startTime = Carbon::parse($session->start);
            $finishTime = Carbon::parse($session->end ? $session->end : now() );
            $hours += $startTime->diff($finishTime)->format('%H') ;
            $minutes += $startTime->diff($finishTime)->format('%I') ;
            $this->stat = false;
            if($session->status == "end")
            {
                $this->stat = true;
            }
        }

        // $startTime = Carbon::parse('2021-03-26 09:26:43');
        // $finishTime = now();
        // $this->hours = $startTime->diff($finishTime)->format('%H:%I');
        $hours = $hours < 10 ? "0". $hours : $hours;
        $minutes = $minutes < 10 ? "0". $minutes : $minutes;
        $this->hours = $hours .":". $minutes;
    }

    public function session_start()
    {
        $ag = new Agent();

        $attendance = new Attendance;
        $attendance->ip = request()->ip();
        $attendance->user_id = auth()->id();
        $attendance->user_agent = request()->header('user-agent');
        $attendance->browser = $ag->browser();
        $p = $ag->platform();
        $attendance->platform = $ag->platform() ." ". $ag->version($p);
        $attendance->status = "start";
        $attendance->device = $ag->device();
        $attendance->start = now()->toDateTimeString();
        $attendance->day = now()->format("Y-m-d");
        $attendance->save();

        $this->stat = false;
        $this->sessions = Attendance::whereDate('created_at', today())->get();

    }
    public function session_end($id)
    {
        $attendance = Attendance::find($id);
        $attendance->end = now()->toDateTimeString();
        $attendance->status = "end";
        $startTime = Carbon::parse($attendance->start);
        $finishTime = Carbon::parse($attendance->end);
        $attendance->hours = $startTime->diff($finishTime)->format('%H') ;
        $attendance->minutes = $startTime->diff($finishTime)->format('%I') ;
        $attendance->save();

        $this->stat = true;
        $this->sessions = Attendance::whereDate('created_at', today())->get();
        
    }

    public function render()
    {
        return view('livewire.dashboard-component');
    }
}
