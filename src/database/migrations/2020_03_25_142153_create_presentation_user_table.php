<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresentationUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presentation_user', function (Blueprint $table) {
            $table->unsignedBigInteger('presentation_id');
            $table->unsignedBigInteger('user_id');
            $table->string('role');
            $table->dateTime('banned_until')->nullable();

            $table->primary(['presentation_id', 'user_id']);


            $table->foreign('presentation_id')
                ->references('id')
                ->on('presentations')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presentation_user');
    }
}
