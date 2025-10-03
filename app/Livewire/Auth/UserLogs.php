<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\UserLog;

class UserLogs extends Component
{
    use WithPagination;

    public function block($logId)
    {
        $log = UserLog::findOrFail($logId);
        $log->blocked = true;
        $log->save();
    }

    public function unblock($logId)
    {
        $log = UserLog::findOrFail($logId);
        $log->blocked = false;
        $log->save();
    }

    public function delete($logId)
    {
        $log = UserLog::findOrFail($logId);
        $log->delete();
    }

    public function render()
    {
        return view('livewire.auth.user-logs', [
            'logs' => UserLog::with('user')
                ->latest('logged_in_at')
                ->paginate(10),
        ]);
    }
}