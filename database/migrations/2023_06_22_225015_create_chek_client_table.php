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
        Schema::create('check_client', function (Blueprint $table) {
            $table->id();
            $table->string('nationalty_number');
            $table->unsignedBigInteger("owner_id");
            $table->foreign('nationalty_number')
                  ->references('nationalty_number')
                  ->on('clients')
                  ->onDelete('cascade');
            $table->foreign('owner_id')
                  ->references('id')
                  ->on('clients')
                  ->onDelete('cascade');
                  $table->integer('check_status')->default(0);

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
        Schema::dropIfExists('chek_client');
    }
};
