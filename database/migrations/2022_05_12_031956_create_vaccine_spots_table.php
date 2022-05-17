<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccineSpotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccine_spots', function (Blueprint $table) {
            $table->id();
            $table->foreignId("region_id");
            $table->date("date");
            $table->string("name");
            $table->text("address");
            $table->enum("serve", [1,2,3]);
            $table->integer("capacity");
            $table->string("available_vaccines");
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
        Schema::dropIfExists('vaccine_spots');
    }
}
