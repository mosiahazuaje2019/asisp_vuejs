<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name',120);
            $table->string('last_name', 120);
            $table->enum('type_document', ['CC','CE','PEP','TI']);
            $table->string('identification')->unique();
            $table->string('phone',20);
            $table->string('email',60)->unique();
            $table->enum('sex',['F','M']);
            $table->unsignedBigInteger('city_id');
            $table->date('birthday');
            $table->longText('address');
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
        Schema::dropIfExists('patients');
    }
}
