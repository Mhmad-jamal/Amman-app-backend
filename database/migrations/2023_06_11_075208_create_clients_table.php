<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('country_code');
            $table->string('phone');
            $table->string('nationalty_number')->unique();
            $table->string('email')->unique();
            $table->enum('customer_type', ['owner', 'user']);
            $table->string('password');
            $table->integer('active')->default(DB::raw('(CASE WHEN customer_type = "owner" THEN 0 ELSE 1 END)'));
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
        Schema::dropIfExists('clients');
    }
};
