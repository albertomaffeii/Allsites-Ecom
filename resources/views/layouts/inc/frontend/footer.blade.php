    <div>
        <div class="footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h4 class="footer-heading">{{ $appSetting->website_name }}</h4>
                        <div class="footer-underline"></div>
                        <p>{{ $appSetting->meta_description }}</p>
                    </div>
                    <div class="col-md-3">
                        <h4 class="footer-heading">Quick Links</h4>
                        <div class="footer-underline"></div>
                        <div class="mb-2"><a href="{{ route('welcome') }}" class="text-white">Home</a></div>
                        <div class="mb-2"><a href="{{ url('about-us') }}" class="text-white">About Us</a></div>
                        <div class="mb-2"><a href="{{ url('contact-us') }}" class="text-white">Contact Us</a></div>
                        <div class="mb-2"><a href="{{ url('blogs') }}" class="text-white">Blogs</a></div>
                        <div class="mb-2"><a href="#" class="text-white">Sitemaps</a></div>
                    </div>
                    <div class="col-md-3">
                        <h4 class="footer-heading">Shop Now</h4>
                        <div class="footer-underline"></div>
                        <div class="mb-2"><a href="{{ route('collections') }}" class="text-white">Collections</a></div>
                        <div class="mb-2"><a href="{{ route('collections') }}" class="text-white">Trending Products</a></div>
                        <div class="mb-2"><a href="{{ route('newarrivals') }}" class="text-white">New Arrivals Products</a></div>
                        <div class="mb-2"><a href="{{ route('featured') }}" class="text-white">Featured Products</a></div>
                        <div class="mb-2"><a href="{{ route('cart') }}" class="text-white">Cart</a></div>
                    </div>
                    <div class="col-md-3">
                        <h4 class="footer-heading">Reach Us</h4>
                        <div class="footer-underline"></div>
                        <div class="mb-2 footer-info">
                            <p>
                                <i class="fa fa-map-marker"></i>{{ $appSetting->address1 }}<br /><span class="icon"></span>{{ $appSetting->address2 }}<br /><span class="icon"></span>{{ $appSetting->zip_code }} - {{ $appSetting->country }}
                            </p>
                        </div>
                        <div class="mb-2">
                            <a href="" class="text-white">
                                <i class="fa fa-phone"></i> {{ $appSetting->phone1 }}
                            </a>
                        </div>
                        <div class="mb-2">
                            <a href="" class="text-white">
                                <i class="fa fa-envelope"></i> {{ $appSetting->contact_email }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <p class=""> &copy; 2023 - <a href="https://www.allsites.com.br">Allsites IT</a> - All rights reserved.</p>
                    </div>
                    <div class="col-md-4">
                        <div class="social-media">
                            Get Connected:
                            @if($appSetting->facebook)
                                <a href="{{ $appSetting->facebook }}" target="_blank">
                                    <i class="fa fa-facebook"></i></a>
                            @endif
                            @if($appSetting->twitter)
                                <a href="{{ $appSetting->twitter }}" target="_blank">
                                    <i class="fa fa-twitter"></i></a>
                            @endif
                            @if($appSetting->instagram)
                                <a href="{{ $appSetting->instagram }}" target="_blank">
                                    <i class="fa fa-instagram"></i></a>
                            @endif
                            @if($appSetting->youtube)
                                <a href="{{ $appSetting->youtube }}" target="_blank">
                                    <i class="fa fa-youtube"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
