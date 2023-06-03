<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
           $table->id();
            $table->string('applicationId')->unique();
            $table->string('name')->nullable();
             $table->string('ApplicantName')->nullable();
            $table->string('FatherName')->nullable();
            $table->string('MotherName')->nullable();
            $table->string('SpouseName')->nullable();
            $table->string('nid')->nullable();
            $table->string('passport')->nullable();
            $table->string('bid')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('birthdate')->nullable();
            $table->string('resident')->nullable();
            $table->string('service')->nullable();
            $table->boolean('bn')->default(false);
            $table->string('presentHoldingNumber')->nullable();
            $table->string('presentVillage')->nullable();
            $table->string('presentPostOffice')->nullable();
            $table->string('presentPoliceStation')->nullable();
            $table->string('presentDistrict')->nullable();
            $table->string('permanentHoldingNumber')->nullable();
            $table->string('permanentVillage')->nullable();
            $table->string('permanentPostOffice')->nullable();
            $table->string('permanentPoliceStation')->nullable();
            $table->string('permanentDistrict')->nullable();
            $table->string('userImage')->nullable();
            $table->string('idVerificationImage')->nullable();
            $table->string('homeVerificationimage')->nullable();
            $table->string('deathVerificationimage')->nullable();  
            $table->string('comment')->nullable();          
            $table->string('status')->default('pending');
            $table->string('certificate_id')->nullable();
            $table->json('nominee')->nullable();
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
        Schema::dropIfExists('applications');
    }
}
