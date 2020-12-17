<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('gm_user_id')->constrained('gm_users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('role_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('character_class_id')->constrained('character_classes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('guild_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('guild_role_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('faction_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('server_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('characters');
    }
}
