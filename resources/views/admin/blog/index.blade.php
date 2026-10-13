<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex, nofollow">
<title>Blog Posts | Austin Optics Admin</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 p-6">
<div class="max-w-6xl mx-auto">
<div class="flex flex-wrap items-center justify-between gap-3">
<div>
<h1 class="text-2xl font-bold">Blog Posts (MySQL)</h1>
<p class="text-sm text-slate-500">{{ $posts->count() }} in database · {{ $fallbackCount }} in legacy catalog</p>
</div>
<div class="flex items-center gap-3">
<a href="{{ route('admin.seo.index') }}" class="text-sm text-blue-600 underline">SEO</a>
<form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="text-sm text-slate-500 underline">Logout</button></form>
</div>
</div>
@if(session('status'))
<div class="mt-4 rounded bg-green-50 text-green-700 text-sm p-3">{{ session('status') }}</div>
@endif
@if($errors->any())
<div class="mt-4 rounded bg-red-50 text-red-700 text-sm p-3">{{ $errors->first() }}</div>
@endif
<div class="mt-4 flex flex-wrap gap-3">
<a href="{{ route('admin.blog.create') }}" class="bg-blue-600 text-white rounded-lg px-5 py-2 text-sm font-semibold">+ New Post</a>
@if($posts->isEmpty())
<form method="POST" action="{{ route('admin.blog.import') }}">@csrf<button class="rounded-lg border border-blue-600 text-blue-600 px-5 py-2 text-sm font-semibold">Import {{ $fallbackCount }} existing posts</button></form>
@endif
</div>
<div class="mt-6 bg-white rounded-2xl shadow overflow-hidden">
<table class="w-full text-sm">
<thead class="bg-slate-50 text-left"><tr><th class="p-3">Title</th><th class="p-3">Slug</th><th class="p-3">Status</th><th class="p-3"></th></tr></thead>
<tbody>
@forelse($posts as $p)
<tr class="border-t">
<td class="p-3 font-semibold">{{ $p->title }}</td>
<td class="p-3 font-mono text-xs text-slate-500">/{{ $p->slug }}/</td>
<td class="p-3">@if($p->is_public)<span class="text-green-600 font-semibold">Public</span>@else<span class="text-slate-400">Hidden</span>@endif</td>
<td class="p-3 whitespace-nowrap text-right">
<a href="{{ route('blog.post', $p->slug) }}" target="_blank" class="text-slate-500 underline mr-3">View</a>
<a href="{{ route('admin.blog.edit', $p) }}" class="text-blue-600 underline mr-3">Edit</a>
<form method="POST" action="{{ route('admin.blog.destroy', $p) }}" class="inline" onsubmit="return confirm('Hide this post from the public blog?')">@csrf @method('DELETE')<button class="text-red-500 underline">Hide</button></form>
</td>
</tr>
@empty
<tr class="border-t"><td colspan="4" class="p-6 text-center text-slate-400">No DB posts yet — import the existing catalog or write a new post. The public blog keeps showing the legacy articles until then.</td></tr>
@endforelse
</tbody>
</table>
</div>
</div>
</body>
</html>
