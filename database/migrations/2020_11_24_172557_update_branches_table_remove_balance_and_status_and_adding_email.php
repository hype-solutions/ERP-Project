<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\RenameColumn;
use Illuminate\Support\Facades\Schema;

class UpdateBranchesTableRemoveBalanceAndStatusAndAddingEmail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->dropColumn('branch_balance');
            $table->RenameColumn('branch_status','branch_email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->integer('branch_balance');
            $table->renameColumn('branch_email','branch_status');
        });
    }
}
