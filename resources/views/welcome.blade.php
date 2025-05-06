<!-- resources/views/welcome.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ArchiveBox</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css') <!-- If using Laravel with Vite -->
</head>
<body class="bg-[#FDEEEF] text-gray-800 font-sans flex items-center justify-center min-h-screen">

    <div class="text-center">
        <img src="{{ asset('images/logo.png') }}" alt="Archive File Logo" class="w-32 mx-auto mb-6">
        <h1 class="text-4xl font-bold text-[#F06292] mb-4">Welcome to Archive File</h1>
        <p class="text-lg mb-6">Your secure and organized space to manage and archive important files.</p>

        <div class="flex justify-center space-x-4">
            <a href="{{ route('login') }}" class="px-6 py-2 bg-[#F06292] text-white rounded-lg hover:bg-pink-600">Login</a>
            <a href="{{ route('register') }}" class="px-6 py-2 border border-[#F06292] text-[#F06292] rounded-lg hover:bg-[#F06292] hover:text-white">Register</a>
        </div>
    </div>

</body>
</html>
