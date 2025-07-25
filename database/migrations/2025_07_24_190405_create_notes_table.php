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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id');
            $table->string('title');
            $table->text('content');
            $table->foreignId('author_id')->constrained('users');
            $table->boolean('is_public')->default(false);
            $table->integer('total_comments')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index('public_id');
            $table->index('author_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
