<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenericCertificateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generic_certificates', function (Blueprint $table) {
            $table->id();
            $table->string('certificateId')->nullable();
            $table->string('ApplicantName')->nullable();
            $table->string('name')->nullable();
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
            $table->boolean('bn')->default(true);
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
        Schema::dropIfExists('generic_certificates');
    }
}
