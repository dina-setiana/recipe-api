<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->string('making_time', 100);
            $table->string('serves', 100);
            $table->string('ingredients', 300);
            $table->integer('cost');
            $table->timestamps();
        });
        DB::statement(
            "
            INSERT INTO recipes (
                id,
                title,
                making_time,
                serves,
                ingredients,
                cost,
                created_at,
                updated_at
            )
            VALUES (
                1,
                'Chicken Curry',
                '45 min',
                '4 people',
                'onion, chicken, seasoning',
                1000,
                '2016-01-10 12:10:12',
                '2016-01-10 12:10:12'

            ),
            (
                2,
                'Rice Omelette',
                '30 min',
                '2 people',
                'onion, egg, seasoning, soy sauce',
                700,
                '2016-01-11 13:10:12',
                '2016-01-11 13:10:12'
            );"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
}
