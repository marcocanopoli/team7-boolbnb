<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_service', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('house_id')->nullable();
            $table->foreign('house_id')
                ->references('id')
                ->on('houses')
                ->onDelete('CASCADE');
            $table->unsignedBigInteger('service_id')->nullable();
            $table->foreign('service_id')
                ->references('id')
                ->on('services')
                ->onDelete('CASCADE');
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
        Schema::dropIfExists('house_service');
    }
}
