<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->foreignUuid('user_id')->index()->constrained('users')->cascadeOnDelete();
            $table->string('nis')->unique()->nullable();
            $table->string('last_education')->nullable();
            $table->string('degree')->nullable();
            $table->foreignUuid('classroom_id')->index()->constrained('classrooms')->cascadeOnDelete();
            $table->foreignUuid('batch_id')->index()->constrained('batchs')->cascadeOnDelete();
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
        Schema::dropIfExists('students');
    }
}
