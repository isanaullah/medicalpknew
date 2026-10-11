<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Verdant Academy')</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700;9..144,800&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='22' fill='%233D1225'/><path d='M26 70 L50 28 L74 70' stroke='%23D9A521' stroke-width='9' fill='none' stroke-linejoin='round'/></svg>">
  <link rel="stylesheet" href="{{ asset('css/verdant.css') }}">
  @stack('styles')
</head>
<body>
  @yield('content')

  <div class="modal-root" id="modalRoot"></div>
  <div class="toast-root" id="toastRoot"></div>

  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
  <script src="{{ asset('js/verdant.js') }}"></script>
  @stack('scripts')
</body>
</html>
