<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    $types = ['money', 'calls', 'meetings', 'Technical_support_tickets'];
    $durations = ["daily", "urban", "every_3_months", "semi-annually", "annually"];

    Schema::create('targets', function (Blueprint $table) use ($types, $durations) {
        $table->bigIncrements('id');
        $table->morphs('targetable');
        $table->string('subject');
        $table->string('description');
        $table->enum('type', $types);
        $table->enum('duration', $durations);
        $table->decimal('amount', 10, 2)->default(0);
        $table->date('start_date');
        $table->date('end_date')->nullable();
        $table->softDeletes();
        $table->timestamps();
    });

     // add user_stamps
     Schema::table('targets', function (Blueprint $table) {
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
        Schema::table('targets', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
            $table->dropForeign(['updated_by']);
            $table->dropColumn('updated_by');
            $table->dropForeign(['deleted_by']);
            $table->dropColumn('deleted_by');
        });

        Schema::dropIfExists('targets');
    }
};
