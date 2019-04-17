<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets_content', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ticket');
            $table->string('product', 100)->default('');
            $table->integer('quantity')->default(0);
            $table->float('price', 8, 2)->default(0);
            $table->integer('user')->default(0);
            $table->date('expiry');
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
        Schema::dropIfExists('tickets_content');
    }
}
