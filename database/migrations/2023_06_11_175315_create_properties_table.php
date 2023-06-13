<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->enum('section', ['Rent', 'Sale']);
            $table->string('sub_section');
            $table->string('room_number');
            $table->string('bath_number');
            $table->string('building_area');
            $table->unsignedTinyInteger('floor')->nullable();
            $table->string('construction_age');
            $table->enum('furnished', ['Yes', 'No']);
            $table->json('features');
            $table->string('price');
            $table->string('ad_title');
            $table->text('ad_details');
            $table->text('address');
            $table->enum('status', [0, 1, 2]);
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('clients');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
