<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration{
    public function up(){
        Schema::create('people',function (Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('height');
            $table->string('mass');
            $table->string('hair_color');
            $table->string('skin_color');
            $table->string('eye_color');
            $table->string('birth_year');
            $table->string('gender');
            $table->rememberToken();
            $table->timestamps();
        });
    }
    public function down(){
        Schema::dropIfExists('people');
    }
} 