<header class="container-fluid">
    <div class="row">
        <div class="col-9 mx-auto">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    @auth
                        @if(Auth::user()->role_as === 2 || Auth::user()->role_as === 0)
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <img src="{{ asset('img/header/logo.png') }}" alt="img-logo" class="img-fluid w-25">
                            </a>
                        @endif
                    @else
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{ asset('img/header/logo.png') }}" alt="img-logo" class="img-fluid w-25">
                        </a>
                    @endauth
                    
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
            
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
            
                        </ul>
            
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('user.home') }}">
                                                My Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endguest
                        </ul>
                    </div>
                    @auth
                        @if(Auth::user()->role_as === 0)
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-12">
                                    <div class="dropdown">
                                        <a href="{{ route('cart.index') }}" class="btn btn-primary" data-toggle="dropdown">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart
                                            <span class="badge badge-pill badge-danger">
                                                {{ array_sum(array_column((array) session('cart'), 'quantity')) }}
                                            </span>
                                        </a>
                    
                                                            
                                        <div class="dropdown-menu">
                                            <div class="row total-header-section">
                                                @php $total = 0 @endphp
                                                @foreach((array) session('cart') as $id => $details)
                                                    @php $total += $details['price'] * $details['quantity'] @endphp
                                                @endforeach
                                                <div class="col-lg-12 col-sm-12 col-12 total-section text-right">
                                                    <p>Total: <span class="text-info">$ {{ $total }}</span></p>
                                                </div>
                                            </div>
                                            @if(session('cart'))
                                                @foreach(session('cart') as $id => $details)
                                                    <div class="row cart-detail">
                                                        <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                                            <img src="{{ asset('img') }}/{{ $details['photo'] }}" />
                                                        </div>
                                                        <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                                            <p>{{ $details['product_name'] }}</p>
                                                            <span class="price text-info"> ${{ $details['price'] }}</span> <span class="count"> Quantity:{{ $details['quantity'] }}</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                            <div class="row">
                                                <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                                    <a href="{{ route('cart.index') }}" class="btn btn-primary btn-block">View all</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endauth
                    
                </div>
            </nav>
        </div>
    </div>
</header>
