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
        Schema::create('user_role', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
        
            $table->string('role'); // JSON column for role
            $table->json('Permission'); // JSON column for role
        
            $table->timestamps();
        
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade'); // Add onDelete('cascade') to enable cascade deletion
        
            // Define the foreign key relationship
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_role');
    }
};
