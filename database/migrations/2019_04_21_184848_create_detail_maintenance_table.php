<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailMaintenanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailmaintenances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('maintenance_id');
            $table->foreign('maintenance_id')->references('id')->on('maintenances');
            $table->integer('asset_id');
            $table->foreign('asset_id')->references('id')->on('assets');
            $table->string('type');
            $table->string('detail');
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
        Schema::dropIfExists('detailmaintenances');
    }
}
