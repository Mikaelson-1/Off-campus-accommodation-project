<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            // Distance from campus (text, e.g. "5 min walk", "500m")
            $table->string('distance_from_campus', 100)->nullable()->after('area');
            // JSON array of additional gallery image paths
            $table->json('gallery_images')->nullable()->after('cover_image');
            // Total number of gallery images uploaded
            $table->unsignedTinyInteger('gallery_count')->default(0)->after('gallery_images');
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn(['distance_from_campus', 'gallery_images', 'gallery_count']);
        });
    }
};
