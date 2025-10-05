<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'App Pegawai')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <header class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <h1 class="text-2xl font-bold">@yield('page-title', 'App Pegawai')</h1>
            <nav class="mt-4">
                <ul class="flex flex-wrap space-x-6">
                    <li><a href="{{ url('/employee') }}" class="hover:text-blue-200 transition duration-200">Employee</a></li>
                    <li><a href="{{ url('/department') }}" class="hover:text-blue-200 transition duration-200">Department</a></li>
                    <li><a href="{{ url('/attendance') }}" class="hover:text-blue-200 transition duration-200">Attendance</a></li>
                    <li><a href="{{ url('/report') }}" class="hover:text-blue-200 transition duration-200">Report</a></li>
                    <li><a href="{{ url('/settings') }}" class="hover:text-blue-200 transition duration-200">Settings</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <main class="flex-grow container mx-auto px-4 py-8">
        @yield('content')
    </main>
    
    <footer class="bg-gray-800 text-white py-6 mt-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} App Pegawai. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>