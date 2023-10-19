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
            $table->text('title');
            $table->longText('description');
            $table->unsignedBigInteger('assignee');
            $table->unsignedBigInteger('assign_to');
            $table->enum('status', ['inactive', 'start', 'finish', 'discard']);
            $table->dateTime('deadline');
            $table->timestamps();

            $table->foreign('assignee')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('assign_to')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
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
