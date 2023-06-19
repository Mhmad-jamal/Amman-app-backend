<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('owner_id');
            $table->string('client_name');

            $table->string('client_phone');


            $table->string('user_national_number');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('clause');
            
            $table->integer('discount')->nullable();
            $table->integer('price');
            $table->json('due_dates');
            $table->string('image')->nullable();

            $table->unsignedTinyInteger('status')->default(1)->nullable(); // Updated code

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('property_id')->references('id')->on('properties');
            $table->foreign('owner_id')->references('id')->on('clients');
            $table->foreign('user_national_number')->references('nationalty_number')->on('clients');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contract');
    }
};
