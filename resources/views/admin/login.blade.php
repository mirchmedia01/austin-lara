<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex, nofollow">
<title>Austin Optics Admin Login</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 flex items-center justify-center p-6">
<div class="w-full max-w-md bg-white rounded-2xl shadow p-8">
<h1 class="text-2xl font-bold">Austin Optics Admin</h1>
<p class="mt-1 text-sm text-slate-500">Use the email in <code>ADMIN_EMAILS</code>.</p>
@if($errors->any())
<div class="mt-4 rounded bg-red-50 text-red-700 text-sm p-3">{{ $errors->first() }}</div>
@endif
<form method="POST" action="{{ route('admin.login.store') }}" class="mt-6 space-y-4">
@csrf
<div>
<label class="text-sm font-semibold">Email</label>
<input type="email" name="email" value="{{ old('email') }}" required class="mt-1 w-full border rounded-lg px-3 py-2">
</div>
<div>
<label class="text-sm font-semibold">Password</label>
<input type="password" name="password" required class="mt-1 w-full border rounded-lg px-3 py-2">
</div>
<button class="w-full bg-blue-600 text-white rounded-lg py-2 font-semibold">Login</button>
</form>
</div>
</body>
</html>
