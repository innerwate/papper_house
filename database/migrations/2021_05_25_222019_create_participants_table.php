<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->nullable()->constrained('authors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('duel_id')->nullable()->constrained('duels')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('poem_id')->nullable()->constrained('poems')->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('is_winner')->default(0);
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
        Schema::dropIfExists('participants');
    }
}
