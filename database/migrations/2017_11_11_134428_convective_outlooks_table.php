<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConvectiveOutlooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convective_outlooks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('aeris_id');
            $table->boolean('check_properties')->default(0);
            $table->string('days_to_event');
            $table->string('min_date_time_iso');
            $table->string('max_date_time_iso');
            $table->string('issued_date_time_iso');
            $table->string('risk_type')->nullable()->default(null);
            $table->string('risk_name')->nullable()->default(null);
            $table->string('risk_code')->nullable()->default(null);
            $table->multipolygon('geo_poly')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('convective_outlooks');
    }
}
