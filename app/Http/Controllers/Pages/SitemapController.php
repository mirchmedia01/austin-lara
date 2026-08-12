<?php

namespace App\Http\Controllers\Pages;

use App\Data\BlogPostRepository;
use Illuminate\Http\Response;

class SitemapController
{
    public function __construct(private readonly BlogPostRepository $posts) {}

    public function __invoke(): Response
    {
        $staticUrls = [
            '/' => ['priority' => '1.0', 'changefreq' => 'daily'],
            '/about-us' => ['priority' => '0.8', 'changefreq' => 'monthly'],
            '/meet-the-team' => ['priority' => '0.7', 'changefreq' => 'monthly'],
            '/awards' => ['priority' => '0.5', 'changefreq' => 'yearly'],
            '/best-of-boro' => ['priority' => '0.5', 'changefreq' => 'yearly'],
            '/services' => ['priority' => '0.9', 'changefreq' => 'weekly'],
            '/eye-vision-exams' => ['priority' => '0.8', 'changefreq' => 'monthly'],
            '/contact-lens-exams' => ['priority' => '0.8', 'changefreq' => 'monthly'],
            '/hard-to-fit-contact' => ['priority' => '0.7', 'changefreq' => 'monthly'],
            '/sunglasses' => ['priority' => '0.7', 'changefreq' => 'monthly'],
            '/computer-vision' => ['priority' => '0.7', 'changefreq' => 'monthly'],
            '/lenses' => ['priority' => '0.8', 'changefreq' => 'monthly'],
            '/insurances' => ['priority' => '0.7', 'changefreq' => 'monthly'],
            '/frame-selection' => ['priority' => '0.6', 'changefreq' => 'monthly'],
            '/contact-us' => ['priority' => '0.8', 'changefreq' => 'monthly'],
            '/blog' => ['priority' => '0.8', 'changefreq' => 'weekly'],
        ];

        $urls = '';

        foreach ($staticUrls as $path => $meta) {
            $urls .= $this->urlEntry(config('seo.base_url').$path, $meta['priority'], $meta['changefreq']);
        }

        foreach ($this->posts->allPosts() as $post) {
            $urls .= $this->urlEntry(
                config('seo.base_url').'/'.$post['slug'],
                '0.6',
                'monthly'
            );
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n"
            .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n"
            .$urls
            .'</urlset>'."\n";

        return response($xml, 200)
            ->header('Content-Type', 'application/xml');
    }

    private function urlEntry(string $loc, string $priority, string $changefreq): string
    {
        return '  <url>'."\n"
            .'    <loc>'.e($loc).'</loc>'."\n"
            .'    <changefreq>'.$changefreq.'</changefreq>'."\n"
            .'    <priority>'.$priority.'</priority>'."\n"
            .'  </url>'."\n";
    }
}
