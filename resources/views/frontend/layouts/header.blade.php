<header class="header shop">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Top Left -->
                    <div class="top-left">
                        <ul class="list-main">
                            @php
                                $settings=DB::table('settings')->get();
                                
                            @endphp
                            <li><i class="ti-headphone-alt"></i>@foreach($settings as $data) {{$data->phone}} @endforeach</li>
                            <li><i class="ti-email"></i> @foreach($settings as $data) {{$data->email}} @endforeach</li>
                        </ul>
                    </div>
                    <!--/ End Top Left -->
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Top Right -->
                    <div class="right-content">
                        <ul class="list-main">
                        <li><i class="ti-location-pin"></i> <a href="{{route('order.track')}}">Track Order</a></li>
                            @auth 
                                @if(Auth::check() && Auth::user()->role->id == 1)
                                    <li><i class="ti-user"></i> <a href="{{route('admin')}}"  target="_blank">Dashboard</a></li>
                                @elseif(Auth::check() && Auth::user()->role->id == 2)
                                    <li><i class="ti-user"></i> <a href="{{route('manager')}}"  target="_blank">Dashboard</a></li>
                                @else 
                                    <li><i class="ti-user"></i> <a href="{{route('user')}}"  target="_blank">Dashboard</a></li>
                                @endif
                                <li><i class="ti-power-off"></i> <a href="{{route('user.logout')}}">Logout</a></li>

                            @else
                                <li><i class="ti-power-off"></i><a href="{{route('login.form')}}">Login /</a> <a href="{{route('register.form')}}">Register</a></li>
                            @endauth
                        </ul>
                    </div>
                    <!-- End Top Right -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-6">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">	
                                    <div class="nav-inner">	
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li class="{{Request::path()=='/' ? 'active' : ''}}"><a href="{{route('home')}}">Isure</a></li>
                                            <li class="@if(Request::path()=='product-grids'||Request::path()=='product-lists')  active  @endif"><a href="{{route('product-grids')}}">Products</a><span class="new">New</span></li>												
                                            {{Helper::getHeaderCategory()}}
                                            <li class="{{Request::path()=='blog' ? 'active' : ''}}"><a href="{{route('blog')}}">Blog</a></li>
                                            <li class="{{Request::path()=='blog' ? 'active' : ''}}"><a href="{{route('about-us')}}">About</a></li>	
                                            <li class="{{Request::path()=='contact' ? 'active' : ''}}"><a href="{{route('contact')}}">Contact Us</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <!--/ End Main Menu -->	
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-7 col-6 d-flex justify-content-end gap-4">
                        <div class="search-bar-top">
                            {{-- <div class="search-bar"> --}}
                                <form method="POST" action="{{route('product.search')}}">
                                    @csrf
                                    <div class="input-group">
                                        <input type="search" class="form-control p-2"  name="search" placeholder="Search Products Here">
                                        <button type="submit" value="submit" class="input-group-text"><i class="ti-search"></i></button>
                                    </div>
                                </form>
                            {{-- </div> --}}
                        </div>
                        <div class="right-bar">
                            <!-- Search Form -->
                            <div class="sinlge-bar shopping">
                                @php 
                                    $total_prod=0;
                                    $total_amount=0;
                                @endphp
                            @if(session('wishlist'))
                                    @foreach(session('wishlist') as $wishlist_items)
                                        @php
                                            $total_prod+=$wishlist_items['quantity'];
                                            $total_amount+=$wishlist_items['amount'];
                                        @endphp
                                    @endforeach
                            @endif
                                <a href="{{route('wishlist')}}" class="single-icon"><i class="fa fa-heart-o"></i> <span class="total-count">{{Helper::wishlistCount()}}</span></a>
                                <!-- Shopping Item -->
                                @auth
                                    <div class="shopping-item">
                                        <div class="dropdown-cart-header">
                                            <span>{{count(Helper::getAllProductFromWishlist())}} Items</span>
                                            <a href="{{route('wishlist')}}">View Wishlist</a>
                                        </div>
                                        <ul class="shopping-list">
                                            {{-- {{Helper::getAllProductFromCart()}} --}}
                                                @foreach(Helper::getAllProductFromWishlist() as $data)
                                                        @php
                                                            $photo=explode(',',$data->product['photo']);
                                                        @endphp
                                                        <li>
                                                            <a href="{{route('wishlist-delete',$data->id)}}" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                                            <a class="cart-img" href="#"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></a>
                                                            <h4><a href="{{route('product-detail',$data->product['slug'])}}" target="_blank">{{$data->product['title']}}</a></h4>
                                                            <p class="quantity">{{$data->quantity}} x - <span class="amount">{{number_format($data->price,2)}} MMK</span></p>
                                                        </li>
                                                @endforeach
                                        </ul>
                                        <div class="bottom">
                                            <div class="total">
                                                <span>Total</span>
                                                <span class="total-amount">{{number_format(Helper::totalWishlistPrice(),2)}} MMK</span>
                                            </div>
                                            <a href="{{route('cart')}}" class="btn animate">Cart</a>
                                        </div>
                                    </div>
                                @endauth
                                <!--/ End Shopping Item -->
                            </div>

                            <div class="sinlge-bar shopping">
                                <a href="{{route('cart')}}" class="single-icon"><i class="fa fa-shopping-basket"></i> <span class="total-count">{{Helper::cartCount()}}</span></a>
                                <!-- Shopping Item -->
                                @auth
                                    <div class="shopping-item">
                                        <div class="dropdown-cart-header">
                                            <span>{{count(Helper::getAllProductFromCart())}} Items</span>
                                            <a href="{{route('cart')}}">View Cart</a>
                                        </div>
                                        <ul class="shopping-list">
                                            {{-- {{Helper::getAllProductFromCart()}} --}}
                                                @foreach(Helper::getAllProductFromCart() as $data)
                                                        @php
                                                            $photo=explode(',',$data->product['photo']);
                                                        @endphp
                                                        <li>
                                                            <a href="{{route('cart-delete',$data->id)}}" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                                            <a class="cart-img" href="#"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></a>
                                                            <h4><a href="{{route('product-detail',$data->product['slug'])}}" target="_blank">{{$data->product['title']}}</a></h4>
                                                            <p class="quantity">{{$data->quantity}} x - <span class="amount">{{number_format($data->price,2)}} MMK</span></p>
                                                        </li>
                                                @endforeach
                                        </ul>
                                        <div class="bottom">
                                            <div class="total">
                                                <span>Total</span>
                                                <span class="total-amount">{{number_format(Helper::totalCartPrice(),2)}} MMK</span>
                                            </div>
                                            <a href="{{route('checkout')}}" class="btn animate">Checkout</a>
                                        </div>
                                    </div>
                                @endauth
                                <!--/ End Shopping Item -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>