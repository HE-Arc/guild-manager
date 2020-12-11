<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('date')->useCurrent();
            $table->timestamp('subscription_delay')->useCurrent();
            $table->unsignedMediumInteger('player_count');
            $table->boolean('auto_bench');
            $table->string('password');
            $table->foreignId('guild_id')->nullable()->constrained()->onUpdate('cascade');
            $table->foreignId('location_id')->nullable()->constrained()->onUpdate('cascade');
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
        Schema::dropIfExists('events');
    }
}
