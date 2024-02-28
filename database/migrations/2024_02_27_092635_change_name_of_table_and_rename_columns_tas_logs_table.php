<?php

use App\Helpers\DataStructures\EntitiesEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('task_logs', 'logs');

        Schema::table('logs', function (Blueprint $table) {
            $table->renameColumn('task', 'entity_id');
            $table->enum('entity_type', EntitiesEnum::values());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('logs', function (Blueprint $table) {
            $table->renameColumn('entity_id', 'task');
            $table->dropColumn('entity_type');
        });

        Schema::rename('logs', 'task_logs');
    }
};
