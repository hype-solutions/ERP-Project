<?php

namespace App\Http\Controllers;

use App\Models\Customers\Customers;
use App\Models\Products\Products;
use App\Models\Projects\Projects;
use App\Models\Projects\ProjectsContractFiles;
use App\Models\Projects\ProjectsPreviewFiles;
use App\Models\Projects\ProjectsAttachmentFiles;
use App\Models\Projects\ProjectsPriceQuotationsPayments;
use App\Models\Projects\ProjectsPriceQuotationsProducts;
use App\Models\Projects\ProjectsPurchasesOrders;
use App\Models\Projects\ProjectsPurchasesOrdersProducts;
use App\Models\Safes\Safes;
use App\Models\Safes\SafesTransactions;
use App\Models\Suppliers\Suppliers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
        return view('projects.add', compact('customers'));
    }

    public function store(Request $request)
    {
        $project = new Projects();
        $project->project_name = $request->project_name;
        $project->customer_id = $request->customer_id;
        $project->project_start_date = $request->project_start_date;
        $project->project_end_date = $request->project_end_date;
        $project->save();

        return redirect()->route('projects.edit', $project->id);
    }

    public function edit(Projects $project)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $customers = Customers::where('id', '!=', $project->customer_id);
        $previewFiles = ProjectsPreviewFiles::where('project_id', $project->id)->get();
        $contractFiles = ProjectsContractFiles::where('project_id', $project->id)->get();
        $attachmentFiles = ProjectsAttachmentFiles::where('project_id', $project->id)->get();
        $priceQuotation = ProjectsPriceQuotationsProducts::where('project_id', $project->id)->get();
        $purchasesOrders = ProjectsPurchasesOrders::where('project_id', $project->id)->get();
        $key = 0;
        $products = Products::all();
        $suppliers = Suppliers::all();

        return view('projects.edit', compact('purchasesOrders', 'suppliers', 'products', 'key', 'project', 'customers', 'previewFiles', 'contractFiles', 'attachmentFiles', 'priceQuotation', 'user_id'));
    }

    public function update(Request $request, $project)
    {
        $safe_id = Safes::where('branch_id', 1)->value('id');
        //Data
        $eproject = Projects::find($project);
        $eproject->project_name = $request->project_name;
        $eproject->customer_id = $request->customer_id;
        $eproject->project_start_date = $request->project_start_date;
        $eproject->project_end_date = $request->project_end_date;
        $eproject->discount_percentage = $request->discount_percentage;
        $eproject->discount_amount = $request->discount_amount;
        $eproject->shipping_fees = $request->shipping_fees;
        $eproject->mo3ayna_details = $request->mo3ayna_details;
        $eproject->tax = $request->tax;
        $eproject->step = $request->step;
        $eproject->total = $request->total;
        $eproject->save();

        //Mo3ayna
        if ($request->hasFile('mo3ayna')) {
            $allowedfileExtension = ['pdf', 'jpg', 'png', 'docx'];
            $files = $request->file('mo3ayna');

            foreach ($files as $file) {

                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $folder = "projects-images/mo3ayna/" . $eproject->id;
                    if (!Storage::disk('erp')->exists($folder)) {
                        Storage::disk('erp')->makeDirectory($folder, 0775, true, true);
                    }
                    if (!empty($file)) {
                        Storage::disk('erp')->put($folder . '/' . $filename, File::get($file));
                        ProjectsPreviewFiles::create([
                            'project_id' => $eproject->id,
                            'file_name' => $filename,
                            'file_ext' => $extension,
                            'file_path' => $folder . '/' . $filename,
                        ]);
                    }
                }
            }
        }

        //Price Quotation
        $product = $request->product;
        if ($product) {
            ProjectsPriceQuotationsProducts::where('project_id', $eproject->id)->delete();
            //Save Items
            $listOfProducts = [];
            foreach ($product as $item) {
                $pro = new ProjectsPriceQuotationsProducts();
                $pro->project_id = $eproject->id;
                $pro->customer_id = $eproject->customer_id;
                if (ctype_digit($item['id'])) {
                    $pro->product_id = $item['id'];
                    $pro->product_temp = '';
                } else {
                    $pro->product_id = 0;
                    $pro->product_temp = $item['id'];
                }

                $pro->product_desc = $item['desc'];
                $pro->product_price = $item['price'];
                $pro->product_qty = $item['qty'];
                $pro->status = 'Pending';
                $pro->save();
                $listOfProducts[] = $pro;
            }
        }

        //Bnood
        if ($request->hasFile('bnood')) {
            $allowedfileExtension = ['pdf', 'jpg', 'png', 'docx'];
            $files = $request->file('bnood');

            foreach ($files as $file) {

                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $folder = "projects-images/bnood/" . $eproject->id;
                    if (!Storage::disk('erp')->exists($folder)) {
                        Storage::disk('erp')->makeDirectory($folder, 0775, true, true);
                    }
                    if (!empty($file)) {
                        Storage::disk('erp')->put($folder . '/' . $filename, File::get($file));
                        ProjectsContractFiles::create([
                            'project_id' => $eproject->id,
                            'file_name' => $filename,
                            'file_ext' => $extension,
                            'file_path' => $folder . '/' . $filename,
                        ]);
                    }
                }
            }
        }

        //Dof3at
        $date = $request->later;
        ProjectsPriceQuotationsPayments::where('project_id', $eproject->id)->delete();
        $listOfDates = [];
        foreach ($date as $item) {
            if ($item['amount'] > 0) {
                $da = new ProjectsPriceQuotationsPayments();
                $da->project_id = $eproject->id;
                $da->customer_id = $eproject->customer_id;
                $da->amount = $item['amount'];
                $da->date = $item['date'];
                $da->notes = $item['notes'];
                if (!empty($item['paynow'])) {
                    if (!empty($item['safe_payment_id'])) {
                        $da->paid = 'Yes';
                        $da->safe_payment_id = $item['safe_payment_id'];
                        $da->date = Carbon::now();
                        $da->safe_id = $safe_id;
                    } else {
                        $da->paid = 'Yes';
                        $payment = new SafesTransactions();
                        $payment->safe_id = $safe_id;
                        $payment->transaction_type = 2;
                        $payment->transaction_amount = $item['amount'];
                        $payment->transaction_datetime = Carbon::now();
                        $payment->done_by = Auth::user()->id;
                        $payment->authorized_by = Auth::user()->id;
                        $payment->transaction_notes = 'قسط على مشروع رقم' . $eproject->id;
                        $payment->save();
                        $payment_id = $payment->id;
                        $da->safe_id = $safe_id;
                        $da->safe_payment_id = $payment_id;
                        Safes::where('id', $safe_id)->decrement('safe_balance', $item['amount']);
                    }
                } else {
                    $da->paid = 'No';
                }
                $da->save();
                $listOfDates[] = $da;
            }
        }

        //Purchases Orders
        if ($request->new_supplier_name != '') {
            $supplier = new Suppliers();
            $supplier->supplier_name = $request->new_supplier_name;
            $supplier->supplier_mobile = $request->new_supplier_mobile;
            $supplier->save();
            $supplierId = $supplier->id;
        } else {
            $supplierId = $request->supplier_id;
        }

        $xxx_product = $request->xxx_product;
        if ($xxx_product) {
            ProjectsPurchasesOrders::create([
                'project_id' => $eproject->id,
                'supplier_id' => $supplierId,
                'purchase_date' => Carbon::now(),
                'discount_percentage' => $request->xxx_discount_percentage,
                'discount_amount' => $request->xxx_discount_amount,
                'shipping_fees' => $request->xxx_shipping_fees,
                'purchase_tax' => $request->xxx_tax,
                'purchase_total' => $request->xxx_total,
                'purchase_note' => $request->xxx_purchase_note,
                'already_paid' => 0,
                'payment_method' => 'none',
                'already_delivered' => 0,
                'added_by' => Auth::user()->id,
                'autherized_by' => Auth::user()->id,
            ]);
            $listOfProducts = [];
            foreach ($product as $item) {
                $pro = new ProjectsPurchasesOrdersProducts();
                $pro->project_id = $eproject->id;
                $pro->supplier_id = $supplierId;
                $pro->product_id = $item['id'];
                $pro->product_desc = $item['desc'];
                $pro->product_price = $item['price'];
                $pro->product_qty = $item['qty'];
                $pro->save();
                $listOfProducts[] = $pro;
            }
        }

        //Mol7kat
        if ($request->hasFile('mol7kat')) {
            $allowedfileExtension = ['pdf', 'jpg', 'png', 'docx'];
            $files = $request->file('mol7kat');

            foreach ($files as $file) {

                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $folder = "projects-images/mol7kat/" . $eproject->id;
                    if (!Storage::disk('erp')->exists($folder)) {
                        Storage::disk('erp')->makeDirectory($folder, 0775, true, true);
                    }
                    if (!empty($file)) {
                        Storage::disk('erp')->put($folder . '/' . $filename, File::get($file));
                        ProjectsAttachmentFiles::create([
                            'project_id' => $eproject->id,
                            'file_name' => $filename,
                            'file_ext' => $extension,
                            'file_path' => $folder . '/' . $filename,
                        ]);
                    }
                }
            }
        }


        //Redirect after save
        if ($request->returnHere == 0) {
            return redirect()->route('projects.list');
        } else {
            return back()->with('success', '1');
        }
    }

    public function projectsList()
    {
        $projects = Projects::all();
        return view('projects.list', compact('projects'));
    }
}
