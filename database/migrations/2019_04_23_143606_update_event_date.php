<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEventDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->date('date_to');
            DB::statement('ALTER TABLE events MODIFY COLUMN events.date DATE');
            $table->renameColumn('date', 'date_from');
	
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('date_to');
            DB::statement('ALTER TABLE events MODIFY COLUMN events.date DATETIME');
            $table->renameColumn('date_from', 'date');
        });
        
    }
}
