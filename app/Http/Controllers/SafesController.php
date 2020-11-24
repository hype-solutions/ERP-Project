<?php

namespace App\Http\Controllers;

use App\Models\Branches;
use Illuminate\Http\Request;

use App\Models\Safes;

class SafesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validatePostRequest()
    {
        return request()->validate([
            'safe_name' => 'unique:safes',
            'safe_balance' => '',
            'branch_id' => '',

        ],
        [
            'safe_name.unique' => 'توجد خزنة مسبقة بنفس هذا الاسم',
        ]
    );
    }
    protected function validateUpdateRequest()
    {
        return request()->validate([
            'safe_name' => '',
            'safe_balance' => '',
            'branch_id' => '',
        ]
    );
    }


    public function add()
    {
        return view('safes.add');
    }

    public function store()
    {
        Safes::create($this->validatePostRequest());
        return back()->with('success', 'safe Added');
    }

    public function view(Safes $safe)
    {
        $safe = Safes::find($safe);
        $safe_id = $safe[0]->id;
        $branch = Branches::where('id',$safe_id)->get();
        return view('safes.profile',compact('safe','branch'));
    }
    public function edit(Safes $safe){
        $safe = Safes::find($safe);
        return view('safes.edit',compact('safe'));
    }

    public function update(Safes $safe)
    {
        $safe->update($this->validateUpdateRequest());
        return back()->with('success', 'safe Updated');
    }

    public function delete(Safes $safe)
    {
        Safes::destroy($safe->id);
        return redirect('/safes')->with('success', 'safe Deleted');
    }

    public function safesList()
    {
        $safes = Safes::all();
        return view('safes.list',compact('safes'));
    }
}
