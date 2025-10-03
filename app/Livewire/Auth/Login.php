<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserLog;

class Login extends Component
{
    public $email, $password;

    public function login()
    {
        $user = User::where('email', $this->email)->first();

        if (! $user) {
            $this->addError('email', 'Email not found.');
            return;
        }

        $ip = request()->ip();
        $blocked = UserLog::where('ip_address', $ip)->where('blocked', true)->exists();

        if ($blocked) {
            $this->addError('email', 'Login blocked from this IP.');
            return;
        }

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $this->addError('password', 'Incorrect password.');
            return;
        }

        UserLog::create([
            'user_id' => $user->id,
            'ip_address' => $ip,
            'user_agent' => request()->userAgent(),
            'logged_in_at' => now(),
        ]);

        session()->regenerate();
        return redirect()->intended('dashboard');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}