<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('title', 20);
            $table->text('description')->nullable();
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('sub_category_id');
            $table->unsignedInteger('sub_sub_category_id')->nullable();
            $table->unsignedBigInteger('start_price')->default(0);
            $table->unsignedBigInteger('reserve_price')->nullable();
            $table->unsignedBigInteger('current_price')->nullable();
            $table->unsignedBigInteger('buy_now_price')->nullable();
            $table->unsignedInteger('increment_price')->nullable();
            $table->string('currency', 10);
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('city_id');
            $table->dateTime('end_date');
            $table->unsignedInteger('status')->default(2);
            $table->string('slug', 40);
            $table->softDeletes();
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
        Schema::dropIfExists('auctions');
    }
}
