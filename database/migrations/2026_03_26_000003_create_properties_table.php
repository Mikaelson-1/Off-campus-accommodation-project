<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('landlord_id')->constrained('landlords')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('type', ['single_room', 'self_contain', 'flat', 'mini_flat', 'duplex'])->default('single_room');
            $table->string('address');
            $table->string('area');          // e.g. Odo-Oja, Afon Lodge area, Temidire
            $table->string('city')->default('Ikere-Ekiti');
            $table->string('state')->default('Ekiti');
            $table->decimal('price_per_year', 10, 2);
            $table->unsignedSmallInteger('rooms_available')->default(1);
            $table->unsignedSmallInteger('total_rooms')->default(1);
            $table->enum('status', ['pending', 'approved', 'rejected', 'archived'])->default('pending');
            $table->boolean('has_electricity')->default(true);
            $table->boolean('has_water')->default(true);
            $table->boolean('has_security')->default(false);
            $table->boolean('is_furnished')->default(false);
            $table->boolean('allows_cooking')->default(true);
            $table->string('cover_image')->nullable();    // path to cover photo
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
