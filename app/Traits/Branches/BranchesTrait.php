<?php

namespace App\Traits\Branches;

use App\Models\Branches\Branches;

trait BranchesTrait {

    public function allBranches(){
        return Branches::all();
    }
}
