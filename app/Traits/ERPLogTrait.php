<?php

namespace App\Traits;

use App\Models\ERPLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait ERPLogTrait {
    private function currentDate(){
        return Carbon::now();
    }

    private function currentUser(){
        return Auth::id();
    }

    public function addLogRecord($type, $action ,$customId) {
        ERPLog::create([
                'type' => $type,
                'action' => $action,
                'custom_id' => $customId,
                'user_id' => $this->currentUser(),
                'action_date' => $this->currentDate()
            ]);

    }

}
