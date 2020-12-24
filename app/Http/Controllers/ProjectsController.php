<?php

namespace App\Http\Controllers;

use App\Models\Customers\Customers;
use App\Models\Products\Products;
use App\Models\Projects\Projects;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add()
    {
        $customers = Customers::all();
        return view('projects.add',compact('customers'));
    }

    public function store(Request $request)
    {
        $project = new Projects();
        $project->project_name = $request->project_name;
        $project->customer_id = $request->customer_id;
        $project->project_start_date = $request->project_start_date;
        $project->project_end_date = $request->project_end_date;
        $project->save();

        return redirect()->route('projects.edit',$project->id);
    }

    public function edit(Projects $project)
    {
        // $customers = Customers::all();
        $customers = Customers::where('id','!=',$project->customer_id);
        return view('projects.edit',compact('project','customers'));
    }

    public function update(Request $request, $project)
    {



    }

    public function projectsList()
    {
        $projects = Projects::all();
        return view('projects.list', compact('projects'));
    }


}
