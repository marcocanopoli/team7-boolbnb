<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousePromotionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_promotion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('house_id')->nullable();
            $table->foreign('house_id')
                ->references('id')
                ->on('houses')
                ->onDelete('CASCADE');
            $table->unsignedBigInteger('promotion_id')->nullable();
            $table->foreign('promotion_id')
                ->references('id')
                ->on('promotions')
                ->onDelete('CASCADE');
            $table->dateTime('start_date');    
            $table->dateTime('end_date'); 
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
        Schema::dropIfExists('house_promotion');
    }
}
