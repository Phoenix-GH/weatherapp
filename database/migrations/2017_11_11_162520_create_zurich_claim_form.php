<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZurichClaimForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('create_zurich_claim_form', function(Blueprint $table){
        	$table->increments('id');
        	$table->integer('user_id')->unsigned()->index();
        	$table->integer('team_id')->unsigned()->index();
        	$table->integer('property_id')->unsigned()->index();
	        $table->string('insured_name')->nullable();
	        $table->string('parent_company_name')->nullable();
	        $table->string('policy_number')->nullable();
	        $table->string('site_code')->nullable();
	        $table->string('policy_address')->nullable();
	        $table->string('policy_zip')->nullable();
	        $table->string('policy_city')->nullable();
	        $table->string('policy_state')->nullable();
	        $table->string('policy_country')->nullable();
	        $table->string('reporter_name')->nullable();
	        $table->string('reporter_phone')->nullable();
	        $table->string('reporter_email')->nullable();
	        $table->string('relationship_to_claim')->nullable();
	        $table->string('contact_name')->nullable();
	        $table->string('contact_phone')->nullable();
	        $table->string('contact_email')->nullable();
	        $table->string('property_loss_type')->nullable();
	        $table->string('loss_date')->nullable();
	        $table->string('loss_time')->nullable();
	        $table->string('loss_location_address')->nullable();
	        $table->string('loss_location_city')->nullable();
	        $table->string('loss_location_state')->nullable();
	        $table->string('loss_location_zip')->nullable();
	        $table->string('loss_location_country')->nullable();
	        $table->text('loss_description')->nullable();
	        $table->enum('has_restoration_company_contacted',[
	        	'yes',
		        'no',
		        'unknown'
	        ])->nullable();;
	        $table->enum('has_business_interrupted_due_to_loss',[
	        	'yes',
		        'no',
		        'unknown'
	        ])->nullable();
	        $table->string('authorities_contacted')->nullable();
	        $table->enum('property_location',[
	        	'same_as_loss_location',
		        'same_as_insured_location',
		        'other'
	        ]);
	        $table->string('property_description')->nullable();
	        $table->string('damage_description')->nullable();
	        $table->string('damage_estimate')->nullable();
	        $table->string('additional_information')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists('create_zurich_claim_form');
    }
}
