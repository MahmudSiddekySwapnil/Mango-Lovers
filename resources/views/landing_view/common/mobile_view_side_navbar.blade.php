
<aside class="category-sidebar">
    <div class="category-header">
        <h4 class="category-title">
            <i class="fas fa-align-left"></i>
            <span>categories</span>
        </h4>
        <button class="category-close">
            <i class="icofont-close"></i>
        </button>
    </div>
    <ul class="category-list">
        <li class="category-item">
            <a class="category-link dropdown-link" href="#">
                <i class="flaticon-fruit"></i>
                <span>fruits</span>
            </a>
            <ul class="dropdown-list">
                <li>
                    <a href="{{route('home')}}">Mango</a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="category-footer">
        <p>All Rights Reserved by <a href="#">Mango Lovers</a>
        </p>
    </div>
</aside>
<aside class="nav-sidebar">
    <div class="nav-header">
        <a href="#">
            <img src="front_assets/images/mango/logo.png" alt="logo">
        </a>
        <button class="nav-close">
            <i class="icofont-close"></i>
        </button>
    </div>
    <div class="nav-content">
        <div class="nav-btn">
            @if(!session()->has('username'))
                <a href="{{route('user_login')}}" class="btn btn-inline">
                    <i class="fa fa-unlock-alt"></i>
                    <span>Login</span>
                </a>
            @endif

        </div>
{{--        <div class="nav-select-group">--}}
{{--            <div class="nav-select">--}}
{{--                <i class="icofont-world"></i>--}}
{{--                <select class="select">--}}
{{--                    <option value="english" selected>English</option>--}}
{{--                    <option value="bangali">Bangali</option>--}}
{{--                    <option value="arabic">Arabic</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="nav-select">--}}
{{--                <i class="icofont-money"></i>--}}
{{--                <select class="select">--}}
{{--                    <option value="english" selected>Doller</option>--}}
{{--                    <option value="bangali">Pound</option>--}}
{{--                    <option value="arabic">Taka</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
        <ul class="nav-list">
            <li>
                <a class="nav-link" href="{{route('home')}}">
                    <i class="icofont-home"></i>Home</a>
{{--                <ul class="dropdown-list">--}}
{{--                    <li>--}}
{{--                        <a href="home-grid.html">Home grid</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="index.html">Home index</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="home-classic.html">Home classic</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="home-standard.html">Home standard</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="home-category.html">Home category</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
            </li>
{{--            <li>--}}
{{--                <a class="nav-link dropdown-link" href="#">--}}
{{--                    <i class="icofont-food-cart"></i>shop </a>--}}
{{--                <ul class="dropdown-list">--}}
{{--                    <li>--}}
{{--                        <a href="shop-5column.html">shop 5 column</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="shop-4column.html">shop 4 column</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="shop-3column.html">shop 3 column</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="shop-2column.html">shop 2 column</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="shop-1column.html">shop 1 column</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a class="nav-link dropdown-link" href="#">--}}
{{--                    <i class="icofont-page"></i>product </a>--}}
{{--                <ul class="dropdown-list">--}}
{{--                    <li>--}}
{{--                        <a href="product-tab.html">product tab</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="product-grid.html">product grid</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="product-video.html">product video</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="product-simple.html">product simple</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a class="nav-link dropdown-link" href="#">--}}
{{--                    <i class="icofont-bag-alt"></i>my account </a>--}}
{{--                <ul class="dropdown-list">--}}
{{--                    <li>--}}
{{--                        <a href="profile.html">profile</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="wallet.html">wallet</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="wishlist.html">wishlist</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="compare.html">compare</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="checkout.html">checkout</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="orderlist.html">order history</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="invoice.html">order invoice</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="email-template.html">email template</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a class="nav-link dropdown-link" href="#">--}}
{{--                    <i class="icofont-lock"></i>authentic </a>--}}
{{--                <ul class="dropdown-list">--}}
{{--                    <li>--}}
{{--                        <a href="login.html">login</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="register.html">register</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="reset-password.html">reset password</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="change-password.html">change password</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a class="nav-link dropdown-link" href="#">--}}
{{--                    <i class="icofont-book-alt"></i>blogs </a>--}}
{{--                <ul class="dropdown-list">--}}
{{--                    <li>--}}
{{--                        <a href="blog-grid.html">blog grid</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="blog-standard.html">blog standard</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="blog-details.html">blog details</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="blog-author.html">blog author</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a class="nav-link" href="offer.html">--}}
{{--                    <i class="icofont-sale-discount"></i>offers </a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a class="nav-link" href="about.html">--}}
{{--                    <i class="icofont-info-circle"></i>about us </a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a class="nav-link" href="faq.html">--}}
{{--                    <i class="icofont-support-faq"></i>need help </a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a class="nav-link" href="contact.html">--}}
{{--                    <i class="icofont-contacts"></i>contact us </a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a class="nav-link" href="privacy.html">--}}
{{--                    <i class="icofont-warning"></i>privacy policy </a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a class="nav-link" href="coming-soon.html">--}}
{{--                    <i class="icofont-options"></i>coming soon </a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a class="nav-link" href="error.html">--}}
{{--                    <i class="icofont-ui-block"></i>404 error </a>--}}
{{--            </li>--}}
            <li>
                @if(session()->has('username'))
                    <a class="nav-link" href="{{route('logout')}}">
                        <i class="icofont-logout"></i>logout </a>
                @endif

            </li>
        </ul>
        <div class="nav-info-group" style="margin-top:550px;">
            <div class="nav-info">
                <i class="icofont-ui-touch-phone"></i>
                <p>
                    <small>call us</small>
                    <span>01325-444569</span>
                </p>
            </div>
            <div class="nav-info">
                <i class="icofont-ui-email"></i>
                <p>
                    <small>email us</small>
                    <span>farukirahi@gmail.com</span>
                </p>
            </div>
        </div>
        <div class="nav-footer">
            <p>All Rights Reserved by <a href="#">Mango Lovers</a>
            </p>
        </div>
    </div>
</aside>
{{-- <div class="modal fade" id="product-view">--}}
{{-- <div class="modal-dialog">--}}
{{-- <div class="modal-content">--}}
{{-- <button class="modal-close icofont-close" data-bs-dismiss="modal"></button>--}}
{{-- <div class="product-view">--}}
{{-- <div class="row">--}}
{{-- <div class="col-md-6 col-lg-6">--}}
{{-- <div class="view-gallery">--}}
{{-- <div class="view-label-group">
										<label class="view-label new">new</label>
										<label class="view-label off">-10%</label>
									</div>--}}
{{-- <ul id="preview-slider" class="preview-slider slider-arrow">--}}
{{-- <!-- Preview images will be injected here -->--}}
{{-- </ul>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- <div class="col-md-6 col-lg-6">--}}
{{-- <div class="view-details">--}}
{{-- <h3 class="view-name">
										<a id="product-name" href="#">existing product name</a>
									</h3>--}}
{{-- <div class="view-meta">--}}
{{-- <p>SKU:
											<span id="product-sku">1234567</span>
										</p>--}}
{{-- <p>BRAND:
											<a id="product-brand" href="#">radhuni</a>
										</p>--}}
{{-- </div>--}}
{{-- <div class="view-rating">--}}
{{-- <i class="active icofont-star"></i>--}}
{{-- <i class="active icofont-star"></i>--}}
{{-- <i class="active icofont-star"></i>--}}
{{-- <i class="active icofont-star"></i>--}}
{{-- <i class="icofont-star"></i>--}}
{{-- <a href="#">(3 reviews)</a>--}}
{{-- </div>--}}
{{-- <h3 class="view-price">--}}
{{-- <del id="product-original-price">$38.00</del>--}}
{{-- <span id="product-price">$24.00
											<small>/per kilo</small>
										</span>--}}
{{-- </h3>--}}
{{-- <p id="product-description" class="view-desc"></p>--}}
{{-- <div class="view-list-group">--}}
{{-- <label class="view-list-title">tags:</label>--}}
{{-- <ul class="view-tag-list">--}}
{{-- <li>
												<a href="#">organic</a>
											</li>--}}
{{-- <li>
												<a href="#">vegetable</a>
											</li>--}}
{{-- <li>
												<a href="#">chilis</a>
											</li>--}}
{{-- </ul>--}}
{{-- </div>--}}
{{-- <div class="view-list-group">--}}
{{-- <label class="view-list-title">Share:</label>--}}
{{-- <ul class="view-share-list">--}}
{{-- <li>
												<a href="#" class="icofont-facebook" title="Facebook"></a>
											</li>--}}
{{-- <li>
												<a href="#" class="icofont-twitter" title="Twitter"></a>
											</li>--}}
{{-- <li>
												<a href="#" class="icofont-linkedin" title="Linkedin"></a>
											</li>--}}
{{-- <li>
												<a href="#" class="icofont-instagram" title="Instagram"></a>
											</li>--}}
{{-- </ul>--}}
{{-- </div>--}}
{{-- <div class="view-add-group">--}}
{{-- <button class="product-add" title="Add to Cart">--}}
{{-- <i class="fas fa-shopping-basket"></i>--}}
{{-- <span>add to cart</span>--}}
{{-- </button>--}}
{{-- <div class="product-action">--}}
{{-- <button class="action-minus" title="Quantity Minus">
												<i class="icofont-minus"></i>
											</button>--}}
{{-- <input class="action-input" title="Quantity Number" type="text" name="quantity" value="1">--}}
{{-- <button class="action-plus" title="Quantity Plus">
													<i class="icofont-plus"></i>
												</button>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- <div class="view-action-group">--}}
{{-- <a class="view-wish wish" href="#" title="Add Your Wishlist">--}}
{{-- <i class="icofont-heart"></i>--}}
{{-- <span>add to wish</span>--}}
{{-- </a>--}}
{{-- <a class="view-compare" href="compare.html" title="Compare This Item">--}}
{{-- <i class="fas fa-random"></i>--}}
{{-- <span>Compare This</span>--}}
{{-- </a>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
<div class="modal fade" id="product-view">
    <!-- Modal Content -->
    <div class="modal-dialog">
        <div class="modal-content">
            <button class="modal-close icofont-close" data-bs-dismiss="modal"></button>
            <div class="product-view">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="view-gallery">
                            <ul id="preview-slider" class="preview-slider slider-arrow">
                                <!-- Preview images will be injected here -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="view-details">
                            <h3 class="view-name">
                                <a id="product-name" href="#">existing product name</a>
                            </h3>
                            <div class="view-meta">
                                <p>SKU: <span id="product-sku">1234567</span>
                                </p>
                                <p>BRAND: <a id="product-brand" href="#">radhuni</a>
                                </p>
                            </div>
                            <div class="view-rating">
                                <i class="active icofont-star"></i>
                                <i class="active icofont-star"></i>
                                <i class="active icofont-star"></i>
                                <i class="active icofont-star"></i>
                                <i class="icofont-star"></i>
                                <a href="#">(3 reviews)</a>
                            </div>
                            <h3 class="view-price">
                                <del id="product-original-price"></del>
                                <span id="product-price">
                  <small>/per kilo</small>
                </span>
                                <br>
                                <span>Total Price: TK: <span id="total-price"></span>
                </span>
                            </h3>
                            <p id="product-description" class="view-desc"></p>
                            <div class="view-list-group">
                                <label class="view-list-title">tags:</label>
                                <ul class="view-tag-list">
                                    <li>
                                        <a href="#">organic</a>
                                    </li>
                                    <li>
                                        <a href="#">vegetable</a>
                                    </li>
                                    <li>
                                        <a href="#">chilis</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="view-list-group">
                                <label class="view-list-title">Share:</label>
                                <ul class="view-share-list">
                                    <li>
                                        <a href="#" class="icofont-facebook" title="Facebook"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="icofont-twitter" title="Twitter"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="icofont-linkedin" title="Linkedin"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="icofont-instagram" title="Instagram"></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product-action" style="display:inline-flex">
                                <button class="action-minus a-minus" title="Quantity Minus">
                                    <i class="icofont-minus"></i>
                                </button>
                                <input class="action-input" title="Quantity Number" type="text" name="quantity" id="quantity-input" value="1" min="1">
                                <button class="action-plus a-plus" title="Quantity Plus">
                                    <i class="icofont-plus"></i>
                                </button>
                            </div>
                            <div class="view-add-group">
                                <button class="p-add" title="Add to Cart" id="p-add" data-sku="">
                                    <i class="fas fa-shopping-basket"></i>
                                    <span>add to cart</span>
                                </button>
                            </div>
                            <!-- Additional elements can be added here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


