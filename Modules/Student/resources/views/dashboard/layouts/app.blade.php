<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Student Dashboard') - Medical.pk</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        .sidebar-link.active {
            background: linear-gradient(135deg, #2563EB, #1D4ED8);
            color: white;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }
        .sidebar-link:hover:not(.active) {
            background: #F1F5F9;
            color: #1E293B;
        }
        .sidebar-link i {
            width: 20px;
            text-align: center;
        }
        .stat-card {
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -8px rgba(0, 0, 0, 0.1);
        }
        .course-card {
            transition: all 0.3s ease;
        }
        .course-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -8px rgba(0, 0, 0, 0.1);
        }
        .progress-bar {
            transition: width 1s ease;
        }
        .activity-item {
            transition: all 0.2s ease;
        }
        .activity-item:hover {
            background: #F8FAFC;
        }
        .mobile-nav a.active {
            color: #2563EB;
        }
        .mobile-nav a.active i {
            background: #2563EB;
            color: white;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-[#F8FAFC]">

    <!-- ===== SIDEBAR ===== -->
    @include('student::dashboard.includes.sidebar')

    <!-- ===== MAIN WRAPPER ===== -->
    <div class="md:ml-64 min-h-screen">

        <!-- ===== HEADER ===== -->
        @include('student::dashboard.includes.header')

        <!-- ===== MAIN CONTENT ===== -->
        <main class="p-4 md:p-6">
            @yield('content')
        </main>

        <!-- ===== FOOTER ===== -->
        @include('student::dashboard.includes.footer')

    </div>

    <!-- ===== MOBILE BOTTOM NAV ===== -->
    @include('student::dashboard.includes.mobile-nav')

    <script>
        // Mobile sidebar toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('mobileSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('translate-x-0');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        // Close sidebar when clicking outside
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('mobileSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const toggleBtn = document.getElementById('sidebarToggle');

            if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                if (!sidebar.classList.contains('-translate-x-full')) {
                    sidebar.classList.add('-translate-x-full');
                    sidebar.classList.remove('translate-x-0');
                    overlay.classList.add('hidden');
                }
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
