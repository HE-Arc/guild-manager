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
            $table->boolean('finished');
            $table->string('password')->nullable();
            $table->foreignId('boss_id')->nullable()->constrained('bosses')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('gm_user_id')->constrained('gm_users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('guild_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('location_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
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
