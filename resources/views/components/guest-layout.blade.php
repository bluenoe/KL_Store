{{-- resources/views/components/guest-layout.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth | KL</title>

    {{-- Nếu bà đang dùng Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Nếu chưa xài Vite thì có thể đổi sang link CSS thường, tuỳ bà --}}
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center">
    <div class="w-full max-w-md mx-auto px-4">
        {{ $slot }}
    </div>
</body>
</html>
