<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    public function up()
    {
        Schema::create('Order', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name');

            $table->longText('description');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('client_id');
            $table->integer('status')->default(0); // Set default value to 0

            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('Order');
    }
}
