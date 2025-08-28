<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('agri_tips', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->text('description')->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('category', 50);
            $table->timestamps();
            
            $table->index('category');
            $table->index('created_at');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('agri_tips');
    }
};
