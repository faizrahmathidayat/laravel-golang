<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FamilyList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_lists', function (Blueprint $table) {
            $table->bigIncrements('fl_id');
            $table->bigInteger('cst_id');
            $table->string('fl_relation',50);
            $table->string('fl_name',50);
            $table->date('fl_dob');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('family_lists');
    }
}
