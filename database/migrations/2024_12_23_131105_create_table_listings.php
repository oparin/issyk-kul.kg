<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->double('price')->nullable();
            $table->string('currency')->nullable();
            $table->string('price_type')->nullable();
            $table->foreignId('city_id')->nullable()->constrained('cities')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreignId('resort_id')->nullable()->constrained('resorts')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->string('phone')->nullable();
            $table->boolean('has_whatsapp')->default(false);
            $table->boolean('has_telegram')->default(false);
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('status')->default('moderate');
            $table->dateTime('expires_at')->nullable();
            $table->integer('views')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
