<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $this->addError('password', 'Incorrect password.');
            return;
        }

        // Success
        session()->regenerate();
        return redirect()->intended('dashboard');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
