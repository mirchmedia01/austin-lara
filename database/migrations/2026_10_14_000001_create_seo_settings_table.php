<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo_settings', function (Blueprint $table) {
            $table->id();
            // Page key: home, about-us, meet-the-team, awards, best-of-boro,
            // services, contact-lens-exams, eye-vision-exams, hard-to-fit-contact,
            // sunglasses, computer-vision, lenses, insurances, frame-selection,
            // contact-us, blog, __global__, or a blog post slug.
            $table->string('page_key')->unique();
            $table->string('label');
            // No char limits (matches ETCPA's schemaless Mongo SEO): TEXT on MySQL.
            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('og_image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_settings');
    }
};
