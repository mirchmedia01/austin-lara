<?php

namespace App\Support;

use App\Models\SeoSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

/**
 * DB-driven SEO with safe fallback to hardcoded values.
 *
 * Titles/descriptions live in the `seo_settings` MySQL table on Railway.
 * If the DB is unavailable (or no row exists), the passed fallback is used,
 * so the site never breaks.
 *
 * NOTE: only plain arrays are cached — never Eloquent models. Cached models
 * can unserialize to __PHP_Incomplete_Class on production and break every
 * read until TTL expiry.
 */
class Seo
{
    /**
     * Resolve [title, description, ogImage] for a page key.
     *
     * @return array{0: ?string, 1: ?string, 2: ?string}
     */
    public static function forPage(string $pageKey, ?string $fallbackTitle = null, ?string $fallbackDescription = null, ?string $fallbackImage = null): array
    {
        try {
            if (! Schema::hasTable('seo_settings')) {
                return [$fallbackTitle, $fallbackDescription, $fallbackImage];
            }

            $row = Cache::remember(
                "seo.{$pageKey}",
                60,
                fn () => SeoSetting::query()->where('page_key', $pageKey)->first()?->only(['seo_title', 'seo_description', 'og_image'])
            );

            if (! is_array($row)) {
                return [$fallbackTitle, $fallbackDescription, $fallbackImage];
            }

            return [
                $row['seo_title'] ?: $fallbackTitle,
                $row['seo_description'] ?: $fallbackDescription,
                $row['og_image'] ?: $fallbackImage,
            ];
        } catch (\Throwable) {
            return [$fallbackTitle, $fallbackDescription, $fallbackImage];
        }
    }

    /** Write-through cache so admin edits are live on the very next request. */
    public static function refresh(string $pageKey): void
    {
        try {
            $row = SeoSetting::query()->where('page_key', $pageKey)->first()?->only(['seo_title', 'seo_description', 'og_image']);
            if (is_array($row)) {
                Cache::put("seo.{$pageKey}", $row, 60);
            } else {
                Cache::forget("seo.{$pageKey}");
            }
        } catch (\Throwable) {
        }
    }

    public static function defaults(): array
    {
        return [
            ['page_key' => '__global__', 'label' => 'Global fallback', 'seo_title' => 'Home - Austin Optics', 'seo_description' => 'The Optometrist Forest Hills Has Trusted Since 1999. Iris Alvarez has spent 30 years fitting glasses for New York\'s most particular patients. Expert eye care, contact lens exams, premium eyewear in Forest Hills, Queens NY.', 'og_image' => null],
            ['page_key' => 'home', 'label' => 'Home', 'seo_title' => 'Home - Austin Optics', 'seo_description' => 'The Optometrist Forest Hills Has Trusted Since 1999. Iris Alvarez has spent 30 years fitting glasses for New York\'s most particular patients. Expert eye care, contact lens exams, and premium eyewear in Forest Hills, Queens NY.', 'og_image' => null],
            ['page_key' => 'about-us', 'label' => 'About Us', 'seo_title' => 'About Austin Optics Eye Care Experts in Forest Hills, Queens NY', 'seo_description' => 'Austin Optics in Forest Hills, Queens offers eye exams, contact lens fittings and premium eyewear for families. Meet our team.', 'og_image' => null],
            ['page_key' => 'meet-the-team', 'label' => 'Meet The Team', 'seo_title' => null, 'seo_description' => null, 'og_image' => null],
            ['page_key' => 'awards', 'label' => 'Awards', 'seo_title' => 'Awards & Recognition | Austin Optics | Forest Hills, Queens NY', 'seo_description' => 'Austin Optics has earned recognition as one of Forest Hills and Queens\' premier eye care practices. See our awards and what they mean for our patients.', 'og_image' => null],
            ['page_key' => 'best-of-boro', 'label' => 'Best Of Boro', 'seo_title' => null, 'seo_description' => null, 'og_image' => null],
            ['page_key' => 'services', 'label' => 'Services', 'seo_title' => 'Eye Care Services | Austin Optics Forest Hills Queens', 'seo_description' => 'Everything your eyes need under one roof. From a full eye health exam to contact lenses for the cases other opticians pass on. Austin Optics, Forest Hills Queens.', 'og_image' => null],
            ['page_key' => 'contact-lens-exams', 'label' => 'Contact Lens Exams', 'seo_title' => null, 'seo_description' => null, 'og_image' => null],
            ['page_key' => 'eye-vision-exams', 'label' => 'Eye / Vision Exams', 'seo_title' => null, 'seo_description' => null, 'og_image' => null],
            ['page_key' => 'hard-to-fit-contact', 'label' => 'Hard To Fit Contacts', 'seo_title' => null, 'seo_description' => null, 'og_image' => null],
            ['page_key' => 'sunglasses', 'label' => 'Sunglasses', 'seo_title' => null, 'seo_description' => null, 'og_image' => null],
            ['page_key' => 'computer-vision', 'label' => 'Computer Vision', 'seo_title' => null, 'seo_description' => null, 'og_image' => null],
            ['page_key' => 'lenses', 'label' => 'Lenses', 'seo_title' => null, 'seo_description' => null, 'og_image' => null],
            ['page_key' => 'insurances', 'label' => 'Insurances', 'seo_title' => null, 'seo_description' => null, 'og_image' => null],
            ['page_key' => 'frame-selection', 'label' => 'Frame Selection', 'seo_title' => null, 'seo_description' => null, 'og_image' => null],
            ['page_key' => 'contact-us', 'label' => 'Contact Us', 'seo_title' => null, 'seo_description' => null, 'og_image' => null],
            ['page_key' => 'blog', 'label' => 'Blog index', 'seo_title' => 'Eye Care Blog | Vision Tips & Guides for Forest Hills & Queens | Austin Optics', 'seo_description' => 'Read the Austin Optics blog for expert eye care tips, lens guides, contact lens advice, and vision health news for Forest Hills and Queens, NY patients.', 'og_image' => null],
        ];
    }
}
