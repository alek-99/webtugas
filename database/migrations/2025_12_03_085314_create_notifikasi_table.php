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
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id();
             $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('tugas_id')
                ->constrained('tugass')
                ->onDelete('cascade');
            $table->string('target_number');
            $table->string('message');
            $table->enum('status', ['pending', 'scheduled', 'sent', 'failed'])->default('pending');
            $table->string('response_code')->nullable();
            $table->text('response_message')->nullable();
            $table->dateTime('scheduled_at')->nullable()->after('message');
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};
