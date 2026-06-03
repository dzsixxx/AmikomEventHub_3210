<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - AmikomEventHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-3xl shadow-xl w-full max-w-md border border-slate-100">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-indigo-600 text-white rounded-2xl flex items-center justify-center text-2xl font-black mx-auto mb-4">
                AH
            </div>
            <h1 class="text-2xl font-bold text-slate-800">Admin Login</h1>
            <p class="text-slate-500 text-sm">Masuk ke panel penyelenggara AmikomEventHub</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm font-medium border border-red-100">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                <input type="email" name="email" id="email" required 
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-600 focus:border-transparent outline-none transition"
                    placeholder="admin@amikom.ac.id">
            </div>

            <div>
                <label for="password" class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                <input type="password" name="password" id="password" required 
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-600 focus:border-transparent outline-none transition"
                    placeholder="••••••••">
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-xl transition shadow-lg shadow-indigo-200">
                Masuk ke Dashboard
            </button>
        </form>
    </div>

</body>
</html>