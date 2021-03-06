<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('CASCADE');

            $table->unsignedBigInteger('house_type_id')->nullable();
            $table->foreign('house_type_id')
                    ->references('id')
                    ->on('house_types')
                    ->onDelete('SET NULL');

            $table->string('title', 100);
            $table->string('slug')->unique();
            $table->unsignedTinyInteger('rooms');
            $table->unsignedTinyInteger('beds');
            $table->unsignedTinyInteger('bathrooms');
            $table->unsignedSmallInteger('square_meters');
            $table->string('city', 60);
            $table->string('address', 100);
            $table->string('zip_code', 10);
            $table->double('latitude');
            $table->double('longitude');
            $table->text('description');
            $table->decimal('price', 6, 2);
            $table->unsignedTinyInteger('guests');
            $table->boolean('visible');
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
        Schema::dropIfExists('houses');
    }
}
