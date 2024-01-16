<?php

use App\Helpers\DataStructures\PriorityEnum;
use App\Helpers\DataStructures\TaskStatusEnum;
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table-> unsignedBigInteger('author');
            $table-> foreign('author')->references('id')->on('users')->onDelete('cascade');
            $table-> unsignedBigInteger('assignee')->unsigned();
            $table-> foreign('assignee')->references('id')->on('users')->onDelete('cascade');
            $table->date('dueDate')->nullable();
            $table->enum('priority', PriorityEnum::values());
            $table->enum('taskStatus', TaskStatusEnum::values());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
