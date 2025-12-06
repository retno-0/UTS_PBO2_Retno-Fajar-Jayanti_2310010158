<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="#">🍎Apple & Co🍎</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('donat.index') }}">Donat</a></li>
                <li class="nav-item"><a class="nav-link" href="/transaksi">Transaksi</a></li>
                <li class="nav-item">
                    <a class="nav-link position-relative" href="{{ route('cart.index') }}">Cart
                        @php
                            $cart = session()->get('cart', []);
                            $totalItems = array_sum(array_column($cart, 'quantity'));
                        @endphp
                        @if($totalItems > 0)
                            <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                                {{ $totalItems }}
                            </span>
                        @endif
                    </a>
                </li>
            </ul>

            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn logout-btn text-white px-3 py-1">Logout</button>
            </form>
        </div>
    </div>
</nav>
