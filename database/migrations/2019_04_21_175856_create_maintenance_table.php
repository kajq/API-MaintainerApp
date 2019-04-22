<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date');
            $table->integer('technician_id');
            $table->foreign('technician_id')->references('id')->on('users');
            $table->string('client');
            $table->integer('location_id');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->integer('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->integer('type');
            $table->string('observations');
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
        Schema::dropIfExists('maintenances');
    }
}
