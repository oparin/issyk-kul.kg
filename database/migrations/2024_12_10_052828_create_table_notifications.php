<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('channel'); // (email, sms, phone, push, telegram)
            $table->text('content');
            $table->string('status')->default('pending'); // (pending, sent, error)
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
