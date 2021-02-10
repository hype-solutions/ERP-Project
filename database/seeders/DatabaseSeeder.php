<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('branches')->get()->count() == 0){
          \App\Models\Branches\Branches::factory(1)->create();
        }
        if(DB::table('safes')->get()->count() == 0){
          \App\Models\Safes\Safes::factory(1)->create();
          }


        //create roles
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $admin = Role::firstOrCreate(['name' => 'مدير']);
        $accountant = Role::firstOrCreate(['name' => 'محاسب']);
        $inventory = Role::firstOrCreate(['name' => 'مسؤول مخازن']);
        $branchManager = Role::firstOrCreate(['name' => 'مدير فروع']);
        $sales = Role::firstOrCreate(['name' => 'مسؤول مبيعات']);

        //Create Permissions
        //Invoices Permissions
        $viewInvoice = Permission::firstOrCreate(['name' => 'View Invoices']);
        $addInvoice = Permission::firstOrCreate(['name' => 'Add Invoices']);
        $editInvoice = Permission::firstOrCreate(['name' => 'Edit Invoices']);
        $deleteInvoice = Permission::firstOrCreate(['name' => 'Delete Invoices']);
        $changePriceInvoice = Permission::firstOrCreate(['name' => 'Change Product Price in Invoice']);
        $PrintInvoice = Permission::firstOrCreate(['name' => 'Print Invoices']);
        //POS Permissions
        $viewPOS = Permission::firstOrCreate(['name' => 'View POS']);
        $sellPOS = Permission::firstOrCreate(['name' => 'Sell POS']);
        $discountPOS = Permission::firstOrCreate(['name' => 'Discount POS']);
        //Price Quotation Permissions
        $viewPQ = Permission::firstOrCreate(['name' => 'View PQ']);
        $addPQ = Permission::firstOrCreate(['name' => 'Add PQ']);
        $editPQ = Permission::firstOrCreate(['name' => 'Edit PQ']);
        $deletePQ = Permission::firstOrCreate(['name' => 'Delete PQ']);
        $PrintPQ = Permission::firstOrCreate(['name' => 'Print PQ']);
        $acceptPQ = Permission::firstOrCreate(['name' => 'Accept PQ']);
        $declinePQ = Permission::firstOrCreate(['name' => 'Decline PQ']);
        $convertPQ = Permission::firstOrCreate(['name' => 'Convert PQ']);
        $sendPQ = Permission::firstOrCreate(['name' => 'Send PQ']);
        $changePricePQ = Permission::firstOrCreate(['name' => 'Change Product Price in PQ']);
        //Projects Permissions
        $viewProjects = Permission::firstOrCreate(['name' => 'View Projects']);
        $addProjects = Permission::firstOrCreate(['name' => 'Add Projects']);
        $editProjects = Permission::firstOrCreate(['name' => 'Edit Projects']);
        $deleteProjects = Permission::firstOrCreate(['name' => 'Delete Projects']);
        //Customers Permissions
        $viewCustomers = Permission::firstOrCreate(['name' => 'View Customers']);
        $addCustomers = Permission::firstOrCreate(['name' => 'Add Customers']);
        $editCustomers = Permission::firstOrCreate(['name' => 'Edit Customers']);
        $deleteCustomers = Permission::firstOrCreate(['name' => 'Delete Customers']);
        //Suppliers Permissions
        $viewSuppliers = Permission::firstOrCreate(['name' => 'View Suppliers']);
        $addSuppliers = Permission::firstOrCreate(['name' => 'Add Suppliers']);
        $editSuppliers = Permission::firstOrCreate(['name' => 'Edit Suppliers']);
        $deleteSuppliers = Permission::firstOrCreate(['name' => 'Delete Suppliers']);
        //Expenses Permissions
        $viewExpenses = Permission::firstOrCreate(['name' => 'View Expenses']);
        $addExpenses = Permission::firstOrCreate(['name' => 'Add Expenses']);
        $viewExpensesCat = Permission::firstOrCreate(['name' => 'View Expenses Cat']);
        $addExpensesCat = Permission::firstOrCreate(['name' => 'Add Expenses Cat']);
        $viewExpensesEnt = Permission::firstOrCreate(['name' => 'View Expenses Ent']);
        $addExpensesEnt = Permission::firstOrCreate(['name' => 'Add Expenses Ent']);
        //Income Permissions
        $viewIncome = Permission::firstOrCreate(['name' => 'View Income']);
        $addIncome = Permission::firstOrCreate(['name' => 'Add Income']);
        $viewIncomeCat = Permission::firstOrCreate(['name' => 'View Income Cat']);
        $addIncomeCat = Permission::firstOrCreate(['name' => 'Add Income Cat']);
        //Branches Permissions
        $viewBranches = Permission::firstOrCreate(['name' => 'View Branches']);
        $addBranches = Permission::firstOrCreate(['name' => 'Add Branches']);
        $editBranches = Permission::firstOrCreate(['name' => 'Edit Branches']);
        $deleteBranches = Permission::firstOrCreate(['name' => 'Delete Branches']);
        //Safes Permissions
        $viewSafes = Permission::firstOrCreate(['name' => 'View Safes']);
        $addSafes = Permission::firstOrCreate(['name' => 'Add Safes']);
        $editSafes = Permission::firstOrCreate(['name' => 'Edit Safes']);
        $depositSafes = Permission::firstOrCreate(['name' => 'Deposit Safes']);
        $withdrawSafes = Permission::firstOrCreate(['name' => 'Withdraw Safes']);
        $transferSafes = Permission::firstOrCreate(['name' => 'Transfer Safes']);
        $deleteSafes = Permission::firstOrCreate(['name' => 'Delete Safes']);
        $acceptSafeTransfer = Permission::firstOrCreate(['name' => 'Accept Safes Transfers']);
        $acceptSafeDeposit = Permission::firstOrCreate(['name' => 'Accept Safes Deposit']);
        $acceptSafeWithdraw = Permission::firstOrCreate(['name' => 'Accept Safes Withdraw']);
        //Products Permissions
        $viewProducts = Permission::firstOrCreate(['name' => 'View Products']);
        $addProducts = Permission::firstOrCreate(['name' => 'Add Products']);
        $editProducts = Permission::firstOrCreate(['name' => 'Edit Products']);
        $deleteProducts = Permission::firstOrCreate(['name' => 'Delete Products']);
        $transferProducts = Permission::firstOrCreate(['name' => 'Transfer Products']);
        $acceptTransferProducts = Permission::firstOrCreate(['name' => 'Accept Products Transfer']);
        $declineTransferProducts = Permission::firstOrCreate(['name' => 'Decline Products Transfer']);
        $mainBranchTransferProducts = Permission::firstOrCreate(['name' => 'Main Branch Products Transfer']);
        //Purchases Orders Permissions
        $viewPO = Permission::firstOrCreate(['name' => 'View PO']);
        $addPO = Permission::firstOrCreate(['name' => 'Add PO']);
        $editPO = Permission::firstOrCreate(['name' => 'Edit PO']);
        $deletePO = Permission::firstOrCreate(['name' => 'Delete PO']);
        $acceptPO = Permission::firstOrCreate(['name' => 'Accept PO']);
        $importPO = Permission::firstOrCreate(['name' => 'Import PO']);
        //Settings Permissions
        $viewSettings = Permission::firstOrCreate(['name' => 'View Settings']);
        $viewGeneralSettings = Permission::firstOrCreate(['name' => 'View General Settings']);
        //Users Permissions
        $viewUsers = Permission::firstOrCreate(['name' => 'View Users']);
        $addUsers = Permission::firstOrCreate(['name' => 'Add Users']);
        $editUsers = Permission::firstOrCreate(['name' => 'Edit Users']);
        $deleteUsers = Permission::firstOrCreate(['name' => 'Delete Users']);
        //Roles Permissions
        $viewRoles = Permission::firstOrCreate(['name' => 'View Roles']);
        $viewRolesPermissions = Permission::firstOrCreate(['name' => 'View Roles Permissions']);
        $editRolesPermissions = Permission::firstOrCreate(['name' => 'Edit Roles Permissions']);


        //Reports Permissions
        $viewReports = Permission::firstOrCreate(['name' => 'View Reports']);

        //Assigning permissions to roles
        $superAdmin->syncPermissions(Permission::all());
        $admin->syncPermissions(Permission::all());
        $accountant->syncPermissions(
            $viewInvoice,$addInvoice,$PrintInvoice,
            $viewPOS,$sellPOS,$discountPOS,
            $viewPQ,$addPQ,$editPQ,$PrintPQ,
            $viewCustomers,$addCustomers,$editCustomers,$deleteCustomers,
            $viewSuppliers,$addSuppliers,$editSuppliers,$deleteSuppliers,
            $viewExpenses,$addExpenses,
            $viewIncome,$addIncome,
            $viewBranches,
            $viewSafes,$depositSafes,$transferSafes,$acceptSafeTransfer,$acceptSafeDeposit,$acceptSafeWithdraw,
            $viewProducts,$addProducts,$transferProducts,$acceptTransferProducts,$declineTransferProducts,$mainBranchTransferProducts,
            $viewPO,$acceptPO,
            $viewSettings,$viewGeneralSettings,
            $viewReports
        );
        $inventory->syncPermissions($viewProducts,$addProducts,$editProducts,$transferProducts,$mainBranchTransferProducts,$viewPO,$addPO,$importPO);
        $branchManager->syncPermissions($viewPOS,$sellPOS,$viewBranches,$viewProducts,$transferProducts,$viewPOS,$sellPOS);
        $sales->syncPermissions($viewPOS,$sellPOS);







    }
}
