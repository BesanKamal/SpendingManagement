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
        Schema::table('spendings', function (Blueprint $table) {
            $table->foreignId('user_id')->after('id')->constrained();
            $table->foreignId('operation_name_id')->after('user_id')->constrained();
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
        Schema::table('spendings', function (Blueprint $table) {
            $table->dropForeign('spendings_user_id_foreign');
            $table->dropColumn('user_id');

            $table->dropForeign('spendings_operation_name_id_foreign');
            $table->dropColumn('operation_name_id');
            //
        });
    }
};
