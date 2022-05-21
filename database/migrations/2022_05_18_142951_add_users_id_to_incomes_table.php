<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('incomes', function (Blueprint $table) {
            // $table->foreignId('user_id');
            
            $table->foreignId('user_id')->after('id')->constrained();
            $table->foreignId('income_side_id')->after('user_id')->constrained();


            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('incomes', function (Blueprint $table) {

            $table->dropForeign('incomes_user_id_foreign');
            $table->dropColumn('user_id');

            $table->dropForeign('incomes_income_side_id_foreign');
            $table->dropColumn('income_side_id');
            //
        });
    }
};
