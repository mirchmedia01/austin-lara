<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex, nofollow">
<title>SEO Settings | Austin Optics Admin</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 p-6">
<div class="max-w-5xl mx-auto">
<div class="flex items-center justify-between">
<h1 class="text-2xl font-bold">SEO / Titles (MySQL)</h1>
<div class="flex items-center gap-3">
<a href="{{ route('admin.blog.index') }}" class="text-sm text-blue-600 underline">Blog</a>
<form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="text-sm text-slate-500 underline">Logout</button></form>
</div>
</div>
@if(session('status'))
<div class="mt-4 rounded bg-green-50 text-green-700 text-sm p-3">{{ session('status') }}</div>
@endif
<div class="mt-6 bg-white rounded-2xl shadow overflow-hidden">
<table class="w-full text-sm">
<thead class="bg-slate-50 text-left"><tr><th class="p-3">Page</th><th class="p-3">SEO Title</th><th class="p-3">Description</th><th class="p-3"></th></tr></thead>
<tbody>
@foreach($rows as $row)
<tr class="border-t">
<td class="p-3 font-semibold">{{ $row->label }}<div class="text-xs text-slate-400 font-normal">{{ $row->page_key }}</div></td>
<td class="p-3">{{ $row->seo_title }}</td>
<td class="p-3 text-slate-500">{{ \Illuminate\Support\Str::limit($row->seo_description, 90) }}</td>
<td class="p-3"><a href="{{ route('admin.seo.edit', $row) }}" class="text-blue-600 underline">Edit</a></td>
</tr>
@endforeach
</tbody>
</table>
</div>
<p class="mt-4 text-xs text-slate-400">Values come from the <code>seo_settings</code> MySQL table on Railway. Empty = falls back to hardcoded default.</p>
</div>
</body>
</html>
