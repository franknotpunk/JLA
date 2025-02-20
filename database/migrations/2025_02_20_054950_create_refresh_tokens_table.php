<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('refresh_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('token')->unique(); // Сам refresh-токен
            $table->string('jti')->unique(); // Уникальный идентификатор токена (из payload)
            $table->timestamp('expires_at'); // Дата истечения токена
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('refresh_tokens');
    }
};
