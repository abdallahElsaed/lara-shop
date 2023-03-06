@extends('website.layout')

@section('content')
    <!-- details_section - start ================================================== -->
    <section class="details_section shop_details sec_ptb_140 clearfix">
        <div class="container">

            <div class="row">
                @if (session('success'))
                    <div class="col">
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mb_100 justify-content-lg-between justify-content-md-center">

                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="shop_details_image">
                        <div class="tab-content zoom-gallery">

                            @foreach ($product->photos as $photo)
                                <div id="tab_{{ $loop->index }}" class="tab-pane {{ $loop->first ? 'active' : 'fade' }}">
                                    <a class="popup_image zoom-image" data-image="{{ asset($photo->path) }}"
                                        href="{{ asset($photo->path) }}">
                                        <img src="{{ asset($photo->path) }}" alt="image_not_found">
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <ul class="nav ul_li clearfix" role="tablist">
                            @foreach ($product->photos as $photo)
                                <li>
                                    <a class="{{ $loop->first ? 'active' : '' }}" data-toggle="tab"
                                        href="#tab_{{ $loop->index }}">
                                        <img src="{{ asset($photo->path) }}" alt="image_not_found">
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                    <div class="shop_details_content">
                        <h2 class="item_title">
                            {{ $product->name }}
                        </h2>
                        <span class="item_price">
                            {{ $product->price }}
                        </span>
                        <hr>

                        <div class="row mb_30 align-items-center justify-content-lg-between">
                            <div class="col-lg-5">
                                <div class="item_brand d-flex align-items-center">
                                    <span class="brand_title">Brands:</span>
                                    <span class="brand_image d-flex align-items-center justify-content-center"
                                        data-bg-color="#f7f7f7">
                                        <img src="{{ asset('assets/images/product_brands/img_01.png') }}"
                                            alt="image_not_found">
                                    </span>
                                </div>
                            </div>

                            <div class="col-lg-7">
                                <div class="rating_review_wrap d-flex align-items-center clearfix">
                                    {{-- <ul class="rating_star ul_li">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul> --}}

                                    <div class="p-rating"></div>

                                    <span>
                                        {{ $product->comments_count }} Review(s)
                                    </span>
                                </div>
                            </div>
                        </div>

                        <p class="mb-0">
                            {{ Str::words($product->description, 25) }}
                        </p>
                        <hr>

                        {{-- <div class="item_color_list mb_30 clearfix">
                            <h4 class="list_title mb_15 text-uppercase">Color</h4>
                            <ul class="ul_li clearfix">
                                <li>
                                    <button type="button"><span><small data-bg-color="#cc7b4a"></small></span>
                                        Brown</button>
                                </li>
                                <li>
                                    <button type="button"><span><small data-bg-color="#b6b8ba"></small></span>
                                        Grey</button>
                                </li>
                                <li>
                                    <button type="button"><span><small data-bg-color="#dd3333"></small></span>
                                        Red</button>
                                </li>
                            </ul>
                        </div>
                        <div class="item_size_list mb_30 clearfix">
                            <h4 class="list_title mb_15 text-uppercase">Size</h4>
                            <ul class="ul_li clearfix">
                                <li><button type="button">XL</button></li>
                                <li><button type="button">L</button></li>
                                <li><button type="button">M</button></li>
                                <li><button type="button">SM</button></li>
                                <li><a class="size_guide" href="#!"><i class="far fa-tape mr-1"></i> Size Guide</a>
                                </li>
                            </ul>
                        </div> --}}

                        <form id="add-to-cart-form" action="{{ url('add-to-cart') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}" />
                            <ul class="btns_group_1 ul_li mb_30 clearfix">
                                <li>
                                    <div class="quantity_input">
                                        <form action="#">
                                            <span class="input_number_decrement">–</span>
                                            <input class="input_number" type="text" value="1" name="quantity">
                                            <span class="input_number_increment">+</span>
                                        </form>
                                    </div>
                                </li>
                                <li>
                                    <button type="submit" class="custom_btn bg_black text-uppercase">
                                        <i class="fal fa-shopping-bag mr-2"></i>
                                        Add To Cart
                                    </button>
                                </li>
                            </ul>
                        </form>

                        {{-- <ul class="btns_group_2 ul_li clearfix">
                            <li><a href="#!"><span><i class="far fa-heart"></i></span> Add to Wishlist</a></li>
                            <li><a href="#!"><span><i class="fal fa-repeat"></i></span> Compare</a></li>
                        </ul> --}}

                        <hr>

                        <ul class="product_info ul_li_block clearfix">
                            <li>
                                <strong>SKU:</strong>
                                {{ $product->sku }}
                            </li>
                            <li>
                                <strong>Category:</strong>
                                <a href="{{ url('/category/' . $product->category->id) }}">
                                    {{ $product->category->name }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="details_description_tab mb_100">
                <ul class="nav ul_li text-uppercase" role="tablist">
                    <li>
                        <a class="active" data-toggle="tab" href="#description_tab">Product Description</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#reviews_tab">Reviews</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="description_tab" class="tab-pane active">
                        <div class="row mb_50">
                            {{ $product->description }}
                        </div>
                    </div>

                    <div id="reviews_tab" class="tab-pane fade">

                        @foreach ($product->comments as $user)
                            {{-- @if (!empty($user->pivot->comment)) --}}
                            <div class="card mb-3">
                                <div class="card-header">
                                    {{ $user->name }}
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        {{ $user->pivot->comment }}
                                    </p>
                                </div>
                            </div>
                            {{-- @endif --}}
                        @endforeach

                        <hr />

                        <h5 class="mb-4">
                            Please, leave your comment.
                        </h5>

                        @if (auth()->check())
                            <form action="{{ url('/product/review') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="row">
                                    <div class="col">
                                        <div class="my-rating"></div>
                                        <input type="hidden" name="rating" id="rating">
                                    </div>
                                </div>

                                <div class="form_item mt-4">
                                    <textarea name="comment" placeholder="Your Message"></textarea>
                                </div>

                                <button type="submit" class="custom_btn bg_default_red text-uppercase">Submit
                                    Review
                                </button>
                            </form>
                        @else
                            <div class="alert alert-danger">
                                Please, login to your account first.
                                <a href="{{ url('login') }}" class="btn btn-primary">Login</a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            <hr class="mt-0 mb_100">

            @include('website.partials.popular_products')
        </div>
    </section>
    <!-- details_section - end================================================== -->
@endsection

@section('js')
    <script>
        $(function() {
            $(".p-rating").starRating({
                starSize: 15,
                readOnly: true,
                initialRating: {{ $rating }},
            });
        });
    </script>
@endsection
