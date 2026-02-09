<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('customer_credit_cards', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->date('dob')->nullable();
            $table->string('pan_number')->nullable();
            $table->string('mother_name')->nullable();
            $table->text('resi_address')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('email')->nullable();
            $table->string('company_name')->nullable();
            $table->string('designation')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_credit_cards');
    }
};