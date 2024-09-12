<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->integer("id")->unique();
            $table->string("address_street")->nullable();
            $table->string("address_street_extra")->nullable();
            $table->string("address_city")->nullable();
            $table->string("address_zip")->nullable();
            $table->string("address_country")->nullable();
            $table->string("address_state")->nullable();
            $table->string("label")->nullable();

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
        Schema::dropIfExists('addresses');
    }
}
