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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('assignee')->nullable();
            $table->string('assigned_by');
            $table->enum('status', ['Back Log', 'In Progress', 'In Review', 'Closed'])->nullable()->default('Back Log');
            $table->enum('priority', ['Normal', 'High', 'Urgent'])->nullable()->default('Normal');
            $table->date('due_date')->nullable()->default(now());
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
