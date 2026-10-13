<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex, nofollow">
<title>Edit SEO: {{ $seo->label }}</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 p-6">
<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow p-8">
<h1 class="text-xl font-bold">Edit: {{ $seo->label }} <span class="text-sm font-normal text-slate-400">{{ $seo->page_key }}</span></h1>
<form method="POST" action="{{ route('admin.seo.update', $seo) }}" class="mt-6 space-y-4">
@csrf @method('PUT')
<div>
<label class="text-sm font-semibold">SEO Title</label>
<input type="text" name="seo_title" value="{{ old('seo_title', $seo->seo_title) }}" class="mt-1 w-full border rounded-lg px-3 py-2">
</div>
<div>
<label class="text-sm font-semibold">Meta description</label>
<textarea name="seo_description" rows="4" class="mt-1 w-full border rounded-lg px-3 py-2">{{ old('seo_description', $seo->seo_description) }}</textarea>
</div>
<div>
<label class="text-sm font-semibold">OG image (optional path)</label>
<input type="text" name="og_image" value="{{ old('og_image', $seo->og_image) }}" class="mt-1 w-full border rounded-lg px-3 py-2">
</div>
<div class="flex gap-3">
<button class="bg-blue-600 text-white rounded-lg px-5 py-2 font-semibold">Save</button>
<a href="{{ route('admin.seo.index') }}" class="px-5 py-2 underline text-slate-500">Cancel</a>
</div>
</form>
</div>
</body>
</html>
