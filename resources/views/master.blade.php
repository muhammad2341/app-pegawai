<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'App Pegawai')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

  <!-- Header / Navbar -->
  <header class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-6 py-4 flex flex-col md:flex-row items-center justify-between">
      <h1 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Aplikasi Pegawai')</h1>
      <nav class="mt-3 md:mt-0 flex flex-wrap items-center gap-4">
        <a href="{{ route('home') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-blue-600 hover:text-white transition">
          <i class="fas fa-house text-lg"></i> Home
        </a>
        <a href="{{ route('employees.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-blue-600 hover:text-white transition">
          <i class="fas fa-users text-lg"></i> Employees
        </a>
        <a href="{{ route('departments.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-green-600 hover:text-white transition">
          <i class="fas fa-building text-lg"></i> Departments
        </a>
        <a href="{{ route('positions.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-yellow-600 hover:text-white transition">
          <i class="fas fa-briefcase text-lg"></i> Positions
        </a>
        <a href="{{ route('salaries.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-purple-600 hover:text-white transition">
          <i class="fas fa-dollar-sign text-lg"></i> Salaries
        </a>
        <a href="{{ route('attendances.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-pink-600 hover:text-white transition">
          <i class="fas fa-calendar-check text-lg"></i> Attendance
        </a>
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <main class="flex-grow container mx-auto px-4 py-8">
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white py-4 text-center mt-6">
    <p>&copy; {{ date('Y') }} Aplikasi Pegawai. All rights reserved.</p>
  </footer>

</body>
</html>
