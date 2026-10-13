<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use App\Support\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class SeoController extends Controller
{
    public function index(): View
    {
        // Ensure every known page has a row (seed-on-first-visit, works on Railway MySQL).
        foreach (Seo::defaults() as $default) {
            SeoSetting::firstOrCreate(
                ['page_key' => $default['page_key']],
                $default,
            );
        }

        $rows = SeoSetting::query()->orderBy('label')->get();

        return view('admin.seo.index', [
            'rows' => $rows,
            'seoTitle' => 'SEO Settings | Austin Optics Admin',
            'seoDescription' => 'Manage page titles and meta descriptions.',
        ]);
    }

    public function edit(SeoSetting $seo): View
    {
        return view('admin.seo.edit', [
            'seo' => $seo,
            'seoTitle' => 'Edit SEO: '.$seo->label,
            'seoDescription' => 'Edit SEO setting.',
        ]);
    }

    public function update(Request $request, SeoSetting $seo)
    {
        // No max lengths (matches ETCPA: trim only, Google picks the snippet).
        $data = $request->validate([
            'seo_title' => ['nullable', 'string'],
            'seo_description' => ['nullable', 'string'],
            'og_image' => ['nullable', 'string'],
        ]);

        $seo->update($data);
        Cache::forget("seo.{$seo->page_key}");

        return redirect()->route('admin.seo.index')->with('status', "Saved: {$seo->label}");
    }
}
