<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Stock Manager') — Stock Manager</title>

    {{-- Bootstrap 5 CSS --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        /* Barre de navigation */
        .navbar-brand {
            font-weight: 700;
            letter-spacing: -0.3px;
        }

        /* Pied de page */
        footer {
            font-size: .85rem;
        }
    </style>

    {{-- Styles supplémentaires injectés par les vues enfants --}}
    @stack('styles')
</head>
<body>

    {{-- ====== Navigation ====== --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="bi bi-boxes me-2"></i>Stock Manager
            </a>

            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}"
                           href="{{ route('products.index') }}">
                            <i class="bi bi-box-seam me-1"></i>Produits
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- ====== Contenu principal ====== --}}
    <main>
        {{-- @yield('content') est remplacé par le @section('content') de chaque vue --}}
        @yield('content')
    </main>

    {{-- ====== Pied de page ====== --}}
    <footer class="text-center text-muted py-4 mt-5 border-top bg-white">
        <div class="container">
            &copy; {{ date('Y') }} Stock Manager
        </div>
    </footer>

    {{-- Bootstrap 5 JS (bundle inclut Popper) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Scripts supplémentaires injectés par les vues enfants via @push('scripts') --}}
    @stack('scripts')

</body>
</html>