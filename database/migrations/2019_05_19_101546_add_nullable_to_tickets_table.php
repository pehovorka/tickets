<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableToTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('description')->nullable()->change();
            $table->dateTime('sell_from')->nullable()->change();
            $table->dateTime('sell_to')->nullable()->change();
            $table->integer('quantity')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('description')->nullable(false)->change();
            $table->dateTime('sell_from')->nullable(false)->change();
            $table->dateTime('sell_to')->nullable(false)->change();
            $table->integer('quantity')->nullable(false)->change();
        });
    }
}
