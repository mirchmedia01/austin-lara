<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Match ETCPA: no char limits on SEO fields (Mongo is schemaless there).
     * SQLite ignores varchar lengths anyway; this only matters for MySQL.
     */
    public function up(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE `seo_settings` MODIFY `seo_title` TEXT NULL');
            DB::statement('ALTER TABLE `seo_settings` MODIFY `seo_description` TEXT NULL');
            DB::statement('ALTER TABLE `seo_settings` MODIFY `og_image` TEXT NULL');
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE `seo_settings` MODIFY `seo_title` VARCHAR(500) NULL');
            DB::statement('ALTER TABLE `seo_settings` MODIFY `seo_description` VARCHAR(1000) NULL');
            DB::statement('ALTER TABLE `seo_settings` MODIFY `og_image` VARCHAR(500) NULL');
        }
    }
};
