<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('target_achievements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('achievable');
            $table->decimal('achieved_amount', 10, 2)->default(0);
            $table->integer('percentage')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        // add user_stamps
         Schema::table('target_achievements', function (Blueprint $table) {
            $table->bigInteger('created_by')->unsigned()->nullable()->index()->after('created_at');
            $table->foreign('created_by')->references('id')->on('users');
            $table->bigInteger('updated_by')->unsigned()->nullable()->index()->after('updated_at');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->bigInteger('deleted_by')->unsigned()->nullable()->index()->after('deleted_at');
            $table->foreign('deleted_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('target_achievements', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
            $table->dropForeign(['updated_by']);
            $table->dropColumn('updated_by');
            $table->dropForeign(['deleted_by']);
            $table->dropColumn('deleted_by');
        });
        Schema::dropIfExists('target_achievements');
    }
};
