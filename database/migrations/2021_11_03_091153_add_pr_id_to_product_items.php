<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrIdToProductItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_items', function (Blueprint $table) {
            $table->integer('pr_id')->nullable()->afrer('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_items', function (Blueprint $table) {
                $table->dropColumn('pr_id');
        });
    }
}
