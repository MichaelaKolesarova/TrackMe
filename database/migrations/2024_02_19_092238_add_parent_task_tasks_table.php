<?php

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
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_task')->nullable();
            $table->foreign('parent_task')->references('id')->on('tasks')->onDelete('set null');
            $table->unsignedBigInteger('project');
            $table->foreign('project')->references('id')->on('projects')->cascadeOnDelete();
            $table->unsignedBigInteger('team_assigned_to')->nullable();
            $table->foreign('team_assigned_to')->references('id')->on('teams')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
