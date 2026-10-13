@php
    $editing = (bool) $post;
    $editorHtml = $bodyHtml ?? '<p>Start writing here...</p>';
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex, nofollow">
<title>{{ $editing ? 'Edit Post' : 'New Post' }} | Austin Optics Admin</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
#rich-editor:empty:before { content: 'Start writing here...'; color: #94a3b8; }
#rich-editor { min-height: 320px; }
#rich-editor:focus { outline: none; }
#rich-editor h2 { font-size: 1.5rem; font-weight: 800; margin: 1.2em 0 .5em; }
#rich-editor h3 { font-size: 1.25rem; font-weight: 700; margin: 1.1em 0 .5em; }
#rich-editor p { margin: .7em 0; line-height: 1.75; }
#rich-editor blockquote { border-left: 4px solid #2563eb; padding-left: 1rem; color: #475569; font-style: italic; margin: 1em 0; }
#rich-editor ul, #rich-editor ol { margin: .7em 0; padding-left: 1.5rem; }
#rich-editor ul { list-style: disc; } #rich-editor ol { list-style: decimal; }
#rich-editor img { max-width: 100%; border-radius: .75rem; margin: 1em 0; }
#rich-editor a { color: #2563eb; text-decoration: underline; }
.tool-btn { padding: .4rem .6rem; border-radius: .5rem; font-size: .8rem; font-weight: 700; color: #334155; }
.tool-btn:hover { background: #e2e8f0; }
.tab-btn[data-active="true"] { background: #1e293b; color: #fff; }
</style>
</head>
<body class="min-h-screen bg-slate-100 p-6">
<div class="max-w-6xl mx-auto" data-blog-root>
<div class="mb-6 flex flex-wrap items-center justify-between gap-4">
<div>
<h1 class="text-2xl font-bold">{{ $editing ? 'Edit Blog Post' : 'New Blog Post' }}</h1>
<p class="text-sm text-slate-500">Rich editor — headings, quotes, lists, links, images. No length limits.</p>
</div>
<div class="flex items-center gap-3">
<a href="{{ route('admin.blog.index') }}" class="rounded-lg border px-4 py-2 text-sm font-semibold">Back</a>
<button form="blog-form" class="rounded-lg bg-blue-600 px-5 py-2 text-sm font-bold text-white">Save</button>
</div>
</div>
@if($errors->any())
<div class="mb-4 rounded bg-red-50 text-red-700 text-sm p-3">{{ $errors->first() }}</div>
@endif
<form method="POST" action="{{ $editing ? route('admin.blog.update', $post) : route('admin.blog.store') }}" id="blog-form">
@csrf @if($editing) @method('PUT') @endif
<div class="grid gap-6 xl:grid-cols-[minmax(0,1fr)_320px]">
<div class="min-w-0 space-y-5">
<section class="rounded-2xl bg-white p-6 shadow">
<h2 class="font-bold text-lg">Editorial Details</h2>
<div class="mt-4 space-y-4">
<label class="block text-sm font-semibold">Title
<input name="title" value="{{ old('title', $post->title ?? '') }}" required data-title class="mt-1 w-full border rounded-lg px-3 py-2">
</label>
<label class="block text-sm font-semibold">Slug
<div class="mt-1 flex gap-2">
<input name="slug" value="{{ old('slug', $post->slug ?? '') }}" data-slug placeholder="auto-from-title" class="flex-1 border rounded-lg px-3 py-2 font-mono text-sm">
<button type="button" data-auto-slug class="rounded-lg border px-3 text-xs font-bold">AUTO</button>
</div>
</label>
<label class="block text-sm font-semibold">Excerpt
<textarea name="excerpt" rows="3" class="mt-1 w-full border rounded-lg px-3 py-2">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
</label>
</div>
</section>

<section class="rounded-2xl bg-white p-6 shadow">
<div class="flex gap-2 mb-4">
<button type="button" class="tab-btn rounded-full bg-slate-100 px-4 py-1.5 text-xs font-bold" data-tab="content" data-active="true">CONTENT</button>
<button type="button" class="tab-btn rounded-full bg-slate-100 px-4 py-1.5 text-xs font-bold" data-tab="seo" data-active="false">SEO</button>
<button type="button" class="tab-btn rounded-full bg-slate-100 px-4 py-1.5 text-xs font-bold" data-tab="preview" data-active="false">PREVIEW</button>
</div>

<div data-panel="content">
<div class="flex flex-wrap items-center gap-1 rounded-lg bg-slate-100 p-2" id="toolbar">
<button type="button" class="tool-btn" data-block="h2">H2</button>
<button type="button" class="tool-btn" data-block="h3">H3</button>
<button type="button" class="tool-btn" data-block="p">¶</button>
<button type="button" class="tool-btn" data-block="blockquote">❝</button>
<button type="button" class="tool-btn" data-cmd="bold"><b>B</b></button>
<button type="button" class="tool-btn" data-cmd="italic"><i>I</i></button>
<button type="button" class="tool-btn" data-cmd="underline"><u>U</u></button>
<button type="button" class="tool-btn" data-cmd="insertUnorderedList">• List</button>
<button type="button" class="tool-btn" data-cmd="insertOrderedList">1. List</button>
<button type="button" class="tool-btn" data-link>Link</button>
<button type="button" class="tool-btn" data-cmd="unlink">Unlink</button>
<button type="button" class="tool-btn" data-image>Image</button>
<button type="button" class="tool-btn" data-cmd="removeFormat">Clear</button>
<input type="file" data-image-file accept=".jpg,.jpeg,.png,.webp" class="hidden">
</div>
<div id="rich-editor" contenteditable="true" class="mt-3 rounded-lg border px-4 py-3 prose max-w-none">{!! $editorHtml !!}</div>
<textarea name="body_html" data-body class="hidden" required>{{ $editorHtml }}</textarea>
</div>

<div data-panel="seo" hidden class="space-y-4">
<label class="block text-sm font-semibold">SEO Title
<input name="seo_title" value="{{ old('seo_title', $post->seo_title ?? '') }}" class="mt-1 w-full border rounded-lg px-3 py-2">
</label>
<label class="block text-sm font-semibold">SEO Description
<textarea name="seo_description" rows="4" class="mt-1 w-full border rounded-lg px-3 py-2">{{ old('seo_description', $post->seo_description ?? '') }}</textarea>
</label>
<p class="text-xs text-slate-400">Blank = falls back to title + excerpt. Also editable per-post under Admin → SEO.</p>
</div>

<div data-panel="preview" hidden>
<div class="rounded-xl border p-6 bg-white">
<h2 data-preview-title class="text-2xl font-extrabold"></h2>
<p data-preview-slug class="text-sm text-blue-600 font-semibold"></p>
<div data-preview-body class="mt-4 leading-7"></div>
</div>
</div>
</section>
</div>

<aside class="space-y-4 rounded-2xl bg-white p-6 shadow h-fit">
<h2 class="font-bold text-lg">Publishing</h2>
<label class="block text-sm font-semibold">Category
<input name="category" value="{{ old('category', $post->category ?? 'Eye Care & Vision') }}" class="mt-1 w-full border rounded-lg px-3 py-2">
</label>
<label class="block text-sm font-semibold">Date label
<input name="date_label" value="{{ old('date_label', $post->date_label ?? '') }}" placeholder="July 2026" class="mt-1 w-full border rounded-lg px-3 py-2">
</label>
<label class="block text-sm font-semibold">Published at
<input name="published_at" type="datetime-local" value="{{ old('published_at', $post && $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}" class="mt-1 w-full border rounded-lg px-3 py-2">
</label>
<label class="block text-sm font-semibold">Cover image
<div class="mt-1 flex gap-2">
<input name="image" value="{{ old('image', $post->image ?? '') }}" data-cover class="flex-1 min-w-0 border rounded-lg px-3 py-2 text-sm" placeholder="/blog/… or https://…">
<label class="cursor-pointer rounded-lg border px-3 py-2 text-xs font-bold">UPLOAD<input type="file" data-cover-file accept=".jpg,.jpeg,.png,.webp" class="hidden"></label>
</div>
<img data-cover-preview src="{{ old('image', $post->image ?? '') }}" class="mt-2 max-h-32 rounded-lg border object-cover {{ filled(old('image', $post->image ?? '')) ? '' : 'hidden' }}">
</label>
<label class="block text-sm font-semibold">Cover alt
<input name="image_alt" value="{{ old('image_alt', $post->image_alt ?? '') }}" class="mt-1 w-full border rounded-lg px-3 py-2">
</label>
<input type="hidden" name="is_public" value="0">
<label class="flex items-center gap-2 text-sm font-semibold">
<input type="checkbox" name="is_public" value="1" @checked(old('is_public', $post ? $post->is_public : true)) class="h-4 w-4"> Publicly visible
</label>
<button class="w-full rounded-lg bg-blue-600 px-5 py-2 text-sm font-bold text-white">Save</button>
</aside>
</div>
</form>
</div>
<script>
(function () {
  const root = document.querySelector('[data-blog-root]');
  const editor = document.getElementById('rich-editor');
  const bodyField = root.querySelector('[data-body]');
  const form = document.getElementById('blog-form');
  const csrf = '{{ csrf_token() }}';

  // Tabs
  root.querySelectorAll('[data-tab]').forEach(btn => btn.addEventListener('click', () => {
    root.querySelectorAll('[data-tab]').forEach(b => b.dataset.active = 'false');
    btn.dataset.active = 'true';
    root.querySelectorAll('[data-panel]').forEach(p => p.hidden = p.dataset.panel !== btn.dataset.tab);
    if (btn.dataset.tab === 'preview') syncPreview();
  }));

  // Toolbar: block styles
  root.querySelectorAll('[data-block]').forEach(btn => btn.addEventListener('click', () => {
    editor.focus();
    document.execCommand('formatBlock', false, btn.dataset.block);
    sync();
  }));
  // Toolbar: inline commands
  root.querySelectorAll('[data-cmd]').forEach(btn => btn.addEventListener('click', () => {
    editor.focus();
    document.execCommand(btn.dataset.cmd, false, null);
    sync();
  }));
  // Link
  root.querySelector('[data-link]').addEventListener('click', () => {
    const url = prompt('Link URL (https://…)');
    if (!url) return;
    editor.focus();
    document.execCommand('createLink', false, url);
    sync();
  });

  // Image upload -> insert at cursor
  const imgFile = root.querySelector('[data-image-file]');
  root.querySelector('[data-image]').addEventListener('click', () => imgFile.click());
  imgFile.addEventListener('change', async () => {
    if (!imgFile.files.length) return;
    const fd = new FormData();
    fd.append('image', imgFile.files[0]);
    const res = await fetch('{{ route('admin.blog.upload-image') }}', {
      method: 'POST', headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }, body: fd
    });
    const json = await res.json();
    if (json.url) {
      editor.focus();
      document.execCommand('insertImage', false, json.url);
      sync();
    } else { alert(json.message || 'Upload failed'); }
    imgFile.value = '';
  });

  // Cover upload
  const coverFile = root.querySelector('[data-cover-file]');
  const coverInput = root.querySelector('[data-cover]');
  const coverPreview = root.querySelector('[data-cover-preview]');
  coverFile.addEventListener('change', async () => {
    if (!coverFile.files.length) return;
    const fd = new FormData();
    fd.append('image', coverFile.files[0]);
    const res = await fetch('{{ route('admin.blog.upload-image') }}', {
      method: 'POST', headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }, body: fd
    });
    const json = await res.json();
    if (json.url) {
      coverInput.value = json.url;
      coverPreview.src = json.url;
      coverPreview.classList.remove('hidden');
    } else { alert(json.message || 'Upload failed'); }
    coverFile.value = '';
  });

  // Slug auto-generate
  const titleInput = root.querySelector('[data-title]');
  const slugInput = root.querySelector('[data-slug]');
  const slugify = s => (s || '').toLowerCase().trim().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
  titleInput.addEventListener('input', () => { if (!slugInput.dataset.touched) slugInput.value = slugify(titleInput.value); });
  slugInput.addEventListener('input', () => slugInput.dataset.touched = '1');
  root.querySelector('[data-auto-slug]').addEventListener('click', () => slugInput.value = slugify(titleInput.value));

  function sync() { bodyField.value = editor.innerHTML; syncPreviewLight(); }
  editor.addEventListener('input', sync);
  function syncPreviewLight() {
    const pv = root.querySelector('[data-preview-body]');
    if (pv && !root.querySelector('[data-panel="preview"]').hidden) syncPreview();
  }
  function syncPreview() {
    root.querySelector('[data-preview-title]').textContent = titleInput.value || 'Untitled';
    root.querySelector('[data-preview-slug]').textContent = '/' + (slugInput.value || 'slug') + '/';
    root.querySelector('[data-preview-body]').innerHTML = editor.innerHTML;
  }
  form.addEventListener('submit', () => { bodyField.value = editor.innerHTML; });
  syncPreview();
})();
</script>
</body>
</html>
