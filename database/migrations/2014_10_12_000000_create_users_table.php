<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Extension\Table\Table;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId("regional_id");
            $table->string('name');
            $table->string("id_card_number");
            $table->date("born_date");
            $table->enum("gender", ['Male', 'Female']);
            $table->text("address");
            $table->string("role");
            $table->string('password');
            $table->integer('consultation_status')->default(0);
            $table->boolean('first_vaccination')->default(false);
            $table->boolean('second_vaccination')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
