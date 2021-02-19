<?php

namespace App\Traits\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait UsersTrait {

    public function allUsers(){
        return User::all();
    }

    public function loggedInUserId(){
        return Auth::id();
    }
}
