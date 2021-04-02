<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Jenssegers\Agent\Agent;

use Livewire\Component;

class SessionsComponent extends Component
{
    public $ip;
    public $browser;
    public $platform;
    public $desktop;
    public $session;
    public $agent = [];

    public function mount($session)
    {
        $this->session = $session;
        $ag = new Agent();
        $ag->setUserAgent($session->user_agent);
        $this->desktop = $ag->isDesktop();
        $this->browser = $session->browser;
        $this->platform = $session->platform;
        $this->ip = $session->ip;
        // $this->desktop = $ag->isDesktop();
        // $this->browser = $ag->browser();
        // $p = $ag->platform();
        // $this->platform = $ag->platform() ." ". $ag->version($p);
        // $this->ip = request()->ip();
    }

    public function session_end($id)
    {
        $this->session->status = "end";
        $this->session->end = now()->toDateTimeString();
        $this->emitUp('session_end', $id);
    }

    public function render()
    {
        return view('livewire.sessions-component');
    }
}
