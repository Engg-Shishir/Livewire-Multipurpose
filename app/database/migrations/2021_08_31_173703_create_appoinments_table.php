<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppoinmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appoinments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->contrained();
            /* $table->unsignedBigInteger('client_id'); */
            $table->date('date');
            $table->time('time');
            $table->string('status');
            $table->text('note')->nullable();
            $table->timestamps();

            /* $table->forign('client_id')->references('id')->on('clients'); */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appoinments');
    }
}
