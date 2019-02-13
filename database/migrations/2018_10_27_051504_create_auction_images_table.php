<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuctionImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auction_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image_path');
            $table->unsignedBigInteger('auction_id');
            $table->softDeletes();
            $table->timestamps();

            //$table->foreign('auction_id')->references('id')->on('auctions')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auction_images');
    }
}
