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
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title');
            $table->string('description');
            $table->enum('type', $types);
            $table->enum('duration', $durations);
            $table->double('amount')->default(0);
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('targets');
    }
};
