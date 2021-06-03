<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageIdAndDescToHistoryPeople extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('history_people', function (Blueprint $table) {
            $table->text('description')->after('name');
            $table->string('full_name')->after('name');
            $table->foreignId('image_id')->after('birthday')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('deathday')->after('birthday');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('history_people', function (Blueprint $table) {
            $table->dropForeign(['image_id']);
            $table->dropColumn('description');
            $table->dropColumn('deathday');
            $table->dropColumn('full_name');
        });
    }
}
