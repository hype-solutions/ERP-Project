<?php

namespace App\Http\Controllers;

use App\Models\Customers\Customers;
use App\Models\Projects\Projects;
use App\Models\Projects\ProjectsContractFiles;
use App\Models\Projects\ProjectsPreviewFiles;
use App\Models\Projects\ProjectsAttachmentFiles;
use App\Models\Projects\ProjectsPriceQuotationsProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('installed');
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
        $user = Auth::user();
        $user_id = $user->id;
        $customers = Customers::where('id','!=',$project->customer_id);
        $previewFiles = ProjectsPreviewFiles::where('project_id',$project->id)->get();
        $contractFiles = ProjectsContractFiles::where('project_id',$project->id)->get();
        $attachmentFiles = ProjectsAttachmentFiles::where('project_id',$project->id)->get();
        $priceQuotation = ProjectsPriceQuotationsProducts::where('project_id',$project->id)->get();
        return view('projects.edit',compact('project','customers','previewFiles','contractFiles','attachmentFiles','priceQuotation','user_id'));
    }

    public function update(Request $request, $project)
    {
        $eproject = Projects::find($project);
        $eproject->project_name = $request->project_name;
        $eproject->customer_id = $request->customer_id;
        $eproject->project_start_date = $request->project_start_date;
        $eproject->project_end_date = $request->project_end_date;
        $eproject->discount_percentage = $request->discount_percentage;
        $eproject->discount_amount = $request->discount_amount;
        $eproject->shipping_fees = $request->shipping_fees;
        $eproject->total = $request->total;
        $eproject->save();

        ProjectsPriceQuotationsProducts::where('project_id', $project)->delete();

        $product = $request->product;
        $customerId = $request->customer_id;
        //Save Items
        $listOfProducts = [];
        foreach ($product as $item) {
            $pro = new ProjectsPriceQuotationsProducts();
            $pro->project_id = $project;
            $pro->customer_id = $customerId;
            $pro->product_id = 0;
            $pro->product_temp = '';
            $pro->product_desc = $item['desc'];
            $pro->product_price = $item['price'];
            $pro->product_qty = $item['qty'];
            $pro->status = 'Pending';
            $pro->save();
            $listOfProducts[] = $pro;
        }

        return back()->with('success','1');


    }

    public function projectsList()
    {
        $projects = Projects::all();
        return view('projects.list', compact('projects'));
    }


}
