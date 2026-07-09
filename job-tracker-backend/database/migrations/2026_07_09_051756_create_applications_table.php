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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            $table->string('company_name')->index();
            $table->string('position');
            $table->enum('work_type', ['remote', 'hybrid', 'on-site']);
            $table->string('salary_range')->nullable();
            $table->text('job_url')->nullable();
            
            $table->enum('status', ['wishlist', 'applied', 'assessment', 'interview', 'offered', 'rejected'])->index();
            $table->string('lexorank')->index(); 
            
            $table->string('notion_page_id')->nullable(); 
            
            $table->timestamp('applied_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
