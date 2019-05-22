<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToTicketUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ticket_users', function (Blueprint $table) {
            $table->string('original_event_name');
            $table->string('original_venue_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ticket_users', function (Blueprint $table) {
            $table->dropColumn('original_event_name');
            $table->dropColumn('original_venue_name');
        });
    }
}
