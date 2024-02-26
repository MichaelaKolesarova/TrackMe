<?php

use App\Helpers\DataStructures\TaskActivitiesEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('task_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task');
            $table->foreign('task')->references('id')->on('tasks')->cascadeOnDelete();
            $table->unsignedBigInteger('who');
            $table->foreign('who')->references('id')->on('users')->cascadeOnDelete();
            $table->enum('changedWhat', TaskActivitiesEnum::values())->nullable();
            $table->unsignedBigInteger('toWhat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_logs');
    }
};
