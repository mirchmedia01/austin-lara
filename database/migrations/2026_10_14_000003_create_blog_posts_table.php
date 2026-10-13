<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            // No char limits (matches ETCPA): TEXT/MEDIUMTEXT throughout.
            $table->text('title');
            $table->text('excerpt')->nullable();
            $table->string('category', 120)->default('Eye Care & Vision');
            $table->string('date_label', 60)->nullable();
            $table->text('image')->nullable();
            $table->text('image_alt')->nullable();
            // Rich-editor HTML body. Null + body_view set = render legacy Blade view.
            $table->mediumText('body_html')->nullable();
            $table->string('body_view', 160)->nullable();
            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->boolean('is_public')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
