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
        Schema::create('note_comments', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id');
            $table->foreignId('note_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('parent_id')->nullable()->constrained('note_comments');
            $table->text('content');
            $table->integer('total_children')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index('public_id');
            $table->index('note_id');
            $table->index('user_id');
            $table->index('parent_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('note_comments');
    }
};
