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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
 
            $table->string('title');
            $table->string('slug')->unique();
            $table->mediumText('content');
    
            $table->boolean('published')->default(true);
    
            $table
                ->foreignId('category_id')
                ->index()->constrained()->cascadeOnDelete();
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
