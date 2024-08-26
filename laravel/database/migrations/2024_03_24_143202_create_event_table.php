<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('club_id');
            $table->string('event_title');
            $table->text('event_description');
            $table->unsignedInteger('course_id');
            $table->string('event_venue');
            $table->integer('event_capacity');
            $table->boolean('event_payment');
            $table->float('event_price')->nullable();
            $table->string('event_qr')->nullable();
            $table->time('event_start_time');
            $table->time('event_end_time');
            $table->date('event_start_date');
            $table->date('event_end_date');
            $table->unsignedInteger('eventstatus_id');
            $table->unsignedInteger('eventcategory_id');
            $table->unsignedInteger('event_verification_code');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event');
    }
}
