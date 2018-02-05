<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmailToNotificationPreferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notification_preferences', function($table) {
            $table->string('email')->nullable();
            $table->string('sms')->nullable();
            $table->boolean('email_confirmed')->default(false);
            $table->boolean('sms_confirmed')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notification_preferences', function($table) {
            $table->dropColumn('email');
            $table->dropColumn('sms');
            $table->dropColumn('email_confirmed');
            $table->dropColumn('sms_confirmed');
        });
    }
}
