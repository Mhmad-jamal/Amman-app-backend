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
            $table->integer('room_number');
            $table->integer('bath_number');
            $table->integer('building_area');
            $table->unsignedTinyInteger('floor')->nullable();
            $table->integer('construction_age');
            $table->enum('furnished', ['Yes', 'No']);
            $table->json('features');
            $table->integer('price');
            $table->string('ad_title');
            $table->text('ad_details');
            $table->text('address');
            $table->enum('status', [0, 1, 2]);
            $table->unsignedBigInteger('owner');
            $table->foreign('owner')->references('id')->on('clients');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
