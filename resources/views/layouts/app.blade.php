<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'E-Commerce')</title>
    <link href="{{ asset('bootstrap/css/styles.css') }}" rel="stylesheet" />
</head>
<body>

<!-- Header -->
<header class="bg-primary text-white text-center py-5 rounded shadow-sm mb-4">
    <h1 class="mb-0">🛍️ Ma Boutique en Ligne 🛒</h1>
    <p class="mb-0">Explorez nos produits de qualité au meilleur prix</p>
</header>
    <!-- NAVBAR -->
    <nav class="mt-3 container">
        <ul class="nav nav-pills nav-fill gap-2 p-1 small bg-primary rounded-5 shadow-sm"
            id="pillNav2" role="tablist"
            style="--bs-nav-link-color: var(--bs-white); 
                   --bs-nav-pills-link-active-color: var(--bs-primary); 
                   --bs-nav-pills-link-active-bg: var(--bs-white);">
    
            <li class="nav-item" role="presentation">
                <a href="{{ route('home') }}" class="nav-link rounded-5 {{ request()->routeIs('home') ? 'active' : '' }}">Accueil</a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="{{ route('products.index') }}" class="nav-link rounded-5 {{ request()->routeIs('products.index') ? 'active' : '' }}">Produits</a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="{{ route('cart') }}" class="nav-link rounded-5 {{ request()->routeIs('cart') ? 'active' : '' }}">Panier</a>
            </li>
          <!--  <li class="nav-item" role="presentation">
                <a href="{{ route('checkout') }}" class="nav-link rounded-5 {{ request()->routeIs('checkout') ? 'active' : '' }}">Paiement</a>
            </li>  -->
        </ul>
    </nav>

    <!-- CONTENU PRINCIPAL -->
    <main class="container my-4">
        @yield('content')
    </main>

    <!-- ALERTES -->
    @if(session('success'))
    <div id="success-alert" style="
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #d4edda;
        color: #155724;
        padding: 15px 25px;
        border: 1px solid #c3e6cb;
        border-radius: 5px;
        z-index: 9999;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    ">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(function() {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        }, 5000);
    </script>
    @endif

    <!-- FOOTER -->
    <footer class="bg-light text-center text-muted py-3 mt-5 border-top">
        &copy; {{ date('Y') }} Ma Boutique 🛍️. Tous droits réservés.
    </footer>

    <!-- SCRIPTS -->
    <script src="{{ asset('bootstrap/js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
