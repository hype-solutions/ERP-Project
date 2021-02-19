<?php

namespace App\Traits\Safes;

use App\Models\Safes\Safes;

trait SafesTrait {

    public function allSafes(){
        return Safes::all();
    }

    public function getBranchLinkedSafeId($branchId){
        return Safes::where('branch_id', $branchId)->value('id');
    }
}
