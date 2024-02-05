@extends('frontend.app')

@section('pageTitle', $pageTitle)

@section('styles')
    <link rel="stylesheet" type='text/css'  href="{{ URL::asset('frontend/css/index.css') }}" />
    <link rel="stylesheet" type='text/css' href="{{ URL::asset('frontend/css/index_extra.css') }}" />
@stop

@section('content')
        <!-- Hero section start -->
        <section class="hero section">
            <div class="container">
                <div class="hero_content col-xl-6">
                    <div class="hero_content-header">
                        <h1 class="hero_content-header_title">GPG Herbal Tea: AKA Wonder Tea </h1>
                        <p class="hero_content-header_text">
                            Wonder Tea is a natural remedy for life threatening Disease<br>
                            Make Wonder Tea your Family Delight
                        </p>
                    </div>
                    <a class="hero_content-btn btn" href="#shop.html">Shop Now</a>
                    <div class="features-list d-sm-flex flex-wrap">
                        <div class="features-list_row d-sm-flex">
                            <div class="features-list_item" data-order="1" data-aos="fade-up">
                                <div class="wrapper d-flex flex-column flex-sm-row align-items-center">
                                                <span class="icon d-flex align-items-center justify-content-center">
                                                    <svg
                                                        class=""
                                                        width="50"
                                                        height="35"
                                                        viewBox="0 0 50 35"
                                                        fill="none"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            clip-rule="evenodd"
                                                            d="M31.6328 28.5714C31.6328 25.1954 34.3793 22.449 37.7553 22.449C41.1313 22.449 43.8777 25.1954 43.8777 28.5714C43.8777 31.9474 41.1318 34.6939 37.7553 34.6939C34.3793 34.6939 31.6328 31.9474 31.6328 28.5714ZM34.694 28.5714C34.694 30.2597 36.067 31.6326 37.7553 31.6326C39.4435 31.6326 40.8165 30.2598 40.8165 28.5714C40.8165 26.8832 39.4435 25.5102 37.7553 25.5102C36.067 25.5102 34.694 26.8832 34.694 28.5714Z"
                                                            fill="currentColor"
                                                        />
                                                        <path
                                                            fill-rule="evenodd"
                                                            clip-rule="evenodd"
                                                            d="M11.2246 28.5714C11.2246 25.1954 13.9711 22.449 17.3471 22.449C20.723 22.449 23.4695 25.1954 23.4695 28.5714C23.4695 31.9474 20.723 34.6939 17.3471 34.6939C13.9711 34.6939 11.2246 31.9474 11.2246 28.5714ZM14.2858 28.5714C14.2858 30.2597 15.6588 31.6326 17.3471 31.6326C19.0353 31.6326 20.4083 30.2598 20.4083 28.5714C20.4083 26.8832 19.0348 25.5102 17.3471 25.5102C15.6588 25.5102 14.2858 26.8832 14.2858 28.5714Z"
                                                            fill="currentColor"
                                                        />
                                                        <path
                                                            d="M40.9047 5.85977C40.6207 5.39516 40.0431 5.10205 39.4115 5.10205H31.6113V7.85397H38.3811L42.9309 15.3061L45.9175 14.0696L40.9047 5.85977Z"
                                                            fill="currentColor"
                                                        />
                                                        <rect x="21.4277" y="25.5103" width="11.2245" height="4.08163" fill="currentColor" />
                                                        <path
                                                            d="M10.5642 25.5103H4.74045C3.81252 25.5103 3.06055 26.4239 3.06055 27.5511C3.06055 28.6784 3.81262 29.5919 4.74045 29.5919H10.5643C11.4923 29.5919 12.2442 28.6782 12.2442 27.5511C12.2442 26.4238 11.4921 25.5103 10.5642 25.5103Z"
                                                            fill="currentColor"
                                                        />
                                                        <path
                                                            d="M49.6733 17.5633L46.6175 13.4888C46.3239 13.0963 45.8708 12.8668 45.3907 12.8668H34.1014V1.60832C34.1014 0.719925 33.4059 0 32.5479 0H6.65508C5.79696 0 5.10156 0.720024 5.10156 1.60832C5.10156 2.49661 5.79706 3.21663 6.65508 3.21663H30.9943V14.4751C30.9943 15.3635 31.6898 16.0835 32.5478 16.0835H44.6299L46.8924 19.1007V27.3956H42.5942C41.736 27.3956 41.0406 28.1156 41.0406 29.0039C41.0406 29.8923 41.7361 30.6122 42.5942 30.6122H48.4459C49.304 30.6122 49.9994 29.8922 49.9995 29.0039V18.5498C49.9995 18.1927 49.8846 17.8453 49.6733 17.5633Z"
                                                            fill="currentColor"
                                                        />
                                                        <path
                                                            d="M10.6991 18.3673H3.58707C2.73307 18.3673 2.04102 19.281 2.04102 20.4081C2.04102 21.5354 2.73316 22.4489 3.58707 22.4489H10.699C11.553 22.4489 12.2451 21.5353 12.2451 20.4081C12.2452 19.281 11.553 18.3673 10.6991 18.3673Z"
                                                            fill="currentColor"
                                                        />
                                                        <path
                                                            d="M15.7001 12.2449H1.64682C0.737262 12.2449 0 13.1585 0 14.2858C0 15.413 0.737262 16.3265 1.64682 16.3265H15.7001C16.6098 16.3265 17.3469 15.4129 17.3469 14.2858C17.3469 13.1586 16.6098 12.2449 15.7001 12.2449Z"
                                                            fill="currentColor"
                                                        />
                                                        <path
                                                            d="M17.7411 6.12244H3.68784C2.77818 6.12244 2.04102 7.03609 2.04102 8.16325C2.04102 9.29055 2.77828 10.2041 3.68784 10.2041H17.7411C18.6508 10.2041 19.388 9.29042 19.388 8.16325C19.3881 7.03609 18.6508 6.12244 17.7411 6.12244Z"
                                                            fill="currentColor"
                                                        />
                                                    </svg>
                                                </span>
                                    <h5 class="title"> We Deliver To All Nations</h5>
                                </div>
                            </div>
                            <div class="features-list_item" data-order="2" data-aos="fade-up">
                                <div class="wrapper d-flex flex-column flex-sm-row align-items-center">
                                                <span class="icon d-flex align-items-center justify-content-center">
                                                    <svg
                                                        class=""
                                                        width="50"
                                                        height="50"
                                                        viewBox="0 0 50 50"
                                                        fill="none"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            clip-rule="evenodd"
                                                            d="M0 25C0 11.2156 11.2156 0 25 0C38.7844 0 50 11.2156 50 25C50 38.7844 38.7844 50 25 50C11.2156 50 0 38.7844 0 25ZM3.125 25C3.125 37.0625 12.9375 46.875 25 46.875C37.0625 46.875 46.875 37.0625 46.875 25C46.875 12.9375 37.0625 3.125 25 3.125C12.9375 3.125 3.125 12.9375 3.125 25Z"
                                                            fill="currentColor"
                                                        />
                                                        <path
                                                            d="M25.5109 23.9229C22.8562 23.9229 20.613 22.4689 20.613 20.7483C20.613 19.0277 22.8562 17.5737 25.5109 17.5737C27.013 17.5737 28.404 18.0308 29.3248 18.8245C29.9975 19.4054 31.026 19.3515 31.6301 18.6912C32.2309 18.0372 32.1689 17.034 31.493 16.4499C30.3501 15.4626 28.8154 14.7959 27.1436 14.5324V12.8118C27.1436 11.9356 26.4121 11.2245 25.5109 11.2245C24.6097 11.2245 23.8783 11.9356 23.8783 12.8118V14.5261C20.1558 15.1166 17.3477 17.6816 17.3477 20.7483C17.3477 24.2499 21.0113 27.0975 25.5109 27.0975C28.1656 27.0975 30.4089 28.5515 30.4089 30.2721C30.4089 31.9927 28.1656 33.4467 25.5109 33.4467C24.0089 33.4467 22.6179 32.9896 21.697 32.1959C21.0244 31.6118 19.9926 31.6689 19.3917 32.3292C18.7909 32.9832 18.853 33.9864 19.5289 34.5705C20.6717 35.561 22.2064 36.2245 23.8783 36.4912V38.2086C23.8783 39.0848 24.6097 39.7959 25.5109 39.7959C26.4121 39.7959 27.1436 39.0848 27.1436 38.2086V36.4943C30.866 35.9039 33.6742 33.3388 33.6742 30.2721C33.6742 26.7705 30.0105 23.9229 25.5109 23.9229Z"
                                                            fill="currentColor"
                                                        />
                                                    </svg>
                                                </span>
                                    <h5 class="title"> Product Satisfaction Guaranteed</h5>
                                </div>
                            </div>
                        </div>
                        <div class="features-list_row d-sm-flex">
                            <div class="features-list_item" data-order="3" data-aos="fade-up">
                                <div class="wrapper d-flex flex-column flex-sm-row align-items-center">
                                                <span class="icon d-flex align-items-center justify-content-center">
                                                    <svg
                                                        class=""
                                                        width="50"
                                                        height="44"
                                                        viewBox="0 0 50 44"
                                                        fill="none"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                    >
                                                        <path
                                                            d="M47.311 27.6956C46.4686 27.6956 45.7849 28.3823 45.7849 29.2284V39.9578H3.05233V21.5645H19.8401C20.6826 21.5645 21.3663 20.8778 21.3663 20.0318C21.3663 19.1857 20.6826 18.499 19.8401 18.499H3.05233V12.3679H19.8401C20.6826 12.3679 21.3663 11.6812 21.3663 10.8351C21.3663 9.98905 20.6826 9.30237 19.8401 9.30237H3.05233C1.36744 9.30237 0 10.6757 0 12.3679V39.9578C0 41.6499 1.36744 43.0233 3.05233 43.0233H45.7849C47.4698 43.0233 48.8372 41.6499 48.8372 39.9578V29.2284C48.8372 28.3823 48.1535 27.6956 47.311 27.6956Z"
                                                            fill="currentColor"
                                                        />
                                                        <path
                                                            d="M14.7285 27.907H8.52695C7.67114 27.907 6.97656 28.6884 6.97656 29.6512C6.97656 30.614 7.67114 31.3954 8.52695 31.3954H14.7285C15.5843 31.3954 16.2789 30.614 16.2789 29.6512C16.2789 28.6884 15.5843 27.907 14.7285 27.907Z"
                                                            fill="currentColor"
                                                        />
                                                        <path
                                                            fill-rule="evenodd"
                                                            clip-rule="evenodd"
                                                            d="M38.3926 0.1248L49.0758 4.83422C49.6374 5.08225 50.0006 5.65052 50.0006 6.27844V12.5577C50.0006 21.2073 46.8964 26.2558 38.5514 31.1881C38.3163 31.3263 38.0538 31.3953 37.7913 31.3953C37.5288 31.3953 37.2663 31.3263 37.0313 31.1881C28.6862 26.2432 25.582 21.1947 25.582 12.5577V6.27844C25.582 5.65052 25.9453 5.08225 26.5038 4.83422L37.187 0.1248C37.5746 -0.0415999 38.005 -0.0415999 38.3926 0.1248ZM37.7913 28.0046C44.6163 23.7975 46.9483 19.807 46.9483 12.5577V7.31451L37.7913 3.27697L28.6344 7.31451V12.5577C28.6344 19.7976 30.9663 23.7881 37.7913 28.0046Z"
                                                            fill="currentColor"
                                                        />
                                                        <path
                                                            d="M42.4773 9.62645C41.8524 9.11805 40.9396 9.21674 40.4338 9.85971L35.8643 15.7392L34.0562 12.9579C33.6056 12.2701 32.7016 12.0877 32.0417 12.5423C31.3761 12.9998 31.1929 13.9299 31.6377 14.6147L34.5445 19.1006C34.8033 19.4983 35.2277 19.7436 35.6928 19.7675C35.7131 19.7675 35.7364 19.7675 35.7538 19.7675C36.1927 19.7675 36.6113 19.5641 36.8904 19.2053L42.7041 11.7288C43.2041 11.0829 43.1052 10.1438 42.4773 9.62645Z"
                                                            fill="currentColor"
                                                        />
                                                    </svg>
                                                </span>
                                    <h5 class="title">100% Secure Payment</h5>
                                </div>
                            </div>
                            <div class="features-list_item" data-order="4" data-aos="fade-up">
                                <div class="wrapper d-flex flex-column flex-sm-row align-items-center">
                                                <span class="icon d-flex align-items-center justify-content-center">
                                                    <svg
                                                        class=""
                                                        width="47"
                                                        height="50"
                                                        viewBox="0 0 47 50"
                                                        fill="none"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            clip-rule="evenodd"
                                                            d="M41.2292 20.6684H41.3542C44.2277 20.6684 46.2265 23.8244 46.2264 26.485V34.2202C46.2264 36.6336 44.5398 38.3044 41.8538 38.49L40.6669 40.2227C38.3206 43.3138 34.6389 45.126 30.7349 45.1113C30.5595 46.2319 30.0354 47.2703 29.2356 48.0817C28.0503 49.2834 26.4339 49.9728 24.7381 50C21.3125 50.0002 18.5257 47.2672 18.4915 43.8738C18.5146 40.9805 20.5779 38.4977 23.4397 37.9196C26.7861 37.2434 30.0524 39.3828 30.7349 42.698C33.8524 42.7127 36.7936 41.2673 38.6681 38.7995L38.793 38.6139H37.3563C37.3328 38.6128 37.3092 38.611 37.2858 38.6086C36.634 38.5395 36.1622 37.9601 36.2319 37.3144V22.1535C36.2319 21.4108 36.6692 20.6683 37.3563 20.6683H38.7306V17.6361C38.7306 9.26299 31.8786 2.47514 23.4264 2.47514C14.9742 2.47514 8.12218 9.26299 8.12218 17.6361V20.6683H9.49645C10.1836 20.6683 10.6208 21.4109 10.6208 22.1535V37.3144C10.6233 37.3376 10.6251 37.361 10.6262 37.3843C10.6571 38.0329 10.1512 38.5836 9.49645 38.614H4.87398L4.85772 38.6138C4.84166 38.6136 4.82563 38.6133 4.80954 38.6128C2.08503 38.5442 -0.0676036 36.3007 0.00162401 33.6017V25.8665C0.00162401 23.0817 2.12544 20.6684 4.87398 20.6684H5.62353V17.6362C5.62353 7.89601 13.594 0 23.4264 0C33.2587 0 41.2292 7.89601 41.2292 17.6362V20.6684ZM4.87398 36.1387H8.12218V23.1436H4.87398C3.49971 23.1436 2.50027 24.4431 2.50027 25.8664V33.6015C2.4992 33.6236 2.49836 33.6455 2.49776 33.6674C2.465 34.9999 3.52888 36.1063 4.87398 36.1387ZM27.4242 46.3492C26.732 47.0928 25.7593 47.5186 24.7382 47.525C22.7059 47.493 21.0566 45.8864 20.9903 43.8739C20.9894 41.8575 22.6388 40.2222 24.6743 40.2214C26.7097 40.2206 28.3604 41.8545 28.3613 43.8709V43.8739C28.4133 44.7927 28.0732 45.6909 27.4242 46.3492ZM41.3542 36.1387C42.1037 36.1387 43.7279 35.8912 43.7279 34.2204V26.4852C43.7279 25.062 42.7284 23.1437 41.3542 23.1437H38.7306V36.1387H41.3542Z"
                                                            fill="currentColor"
                                                        />
                                                    </svg>
                                                </span>
                                    <h5 class="title">Online Support</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero_media">
                <picture>
                    <source data-srcset="frontend/img/leaf.webp"
                            srcset="frontend/img/leaf.webp" type="image/webp" />
                    <img class="lazy hero_media-leaf"
                         data-src="frontend/img/leaf.webp"
                         src="frontend/img/leaf.webp" alt="media" />
                </picture>
            </div>
        </section>
        <!-- Hero section end -->

        <!-- banner section start -->
        <section class="sale section--nopb">
            <div class="container">
                <div class="sale_grid d-grid">
                    <div class="sale_grid-item sale_grid-item--am">
                        <div class="sale_grid-item_bg">
                            <picture>
                                <source data-srcset="frontend/img/about/sale--am.webp"
                                        srcset="frontend/img/about/sale--am.webp" type="image/webp" />
                                <img class="lazy" data-src="frontend/img/about/sale--am.webp"
                                     src="frontend/img/about/sale--am.webp" alt="media" />
                            </picture>
                        </div>
                        <div class="sale_grid-item_content d-flex flex-column justify-content-end">
                            <h3 class="sale_grid-item_title">Skin Care Product</h3>
                            <div class="wrapper d-flex flex-column">
                                <span class="text">buy </span>
                                <a class="btn--underline" href="{{url('/#shop')}}">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="sale_grid-item sale_grid-item--medical">
                        <div class="sale_grid-item_bg">
                            <picture>
                                <source
                                    data-srcset="frontend/img/about/sale--medical.webp"
                                    srcset="frontend/img/about/sale--medical.webp"
                                    type="image/webp"
                                />
                                <img
                                    class="lazy"
                                    data-src="frontend/img/about/sale--medical.webp"
                                    src="frontend/img/about/sale--medical.webp"
                                    alt="media"
                                />
                            </picture>
                        </div>
                        <div class="sale_grid-item_content d-flex flex-column justify-content-end">
                            <h3 class="sale_grid-item_title">Health Products</h3>
                            <div class="wrapper d-flex flex-column">
                                <span class="text">buy</span>
                                <a class="btn--underline" href="{{url('/shop')}}">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="sale_grid-item sale_grid-item--pm">
                        <div class="sale_grid-item_bg">
                            <picture>
                                <source data-srcset="frontend/img/about/sale--pm.webp"
                                        srcset="frontend/img/about/sale--pm.webp" type="image/webp" />
                                <img class="lazy" data-src="frontend/img/about/sale--pm.webp"
                                     src="frontend/img/about/sale--pm.webp" alt="media" />
                            </picture>
                        </div>
                        <div class="sale_grid-item_content d-flex flex-column justify-content-end">
                            <h3 class="sale_grid-item_title">Skill Acquisition </h3>
                            <div class="wrapper d-flex flex-column">
                                <span class="text">buy </span>
                                <a class="btn--underline" href="{{url('/shop')}}">Shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- banner section start -->

        <!-- Popular products section start -->
        <!--<section class="popular section">-->
        <!--    <div class="container">-->
        <!--        <div class="popular_header">-->
        <!--            <h2 class="popular_header-title">Upcomig Products</h2>-->
        <!--            <p class="popular_header-text">-->
        <!--                Your Healthy Life IS covered with our Natural Remedies.-->
        <!--            </p>-->
        <!--        </div>-->
        <!--        <div class="popular_slider swiper">-->
        <!--            <div class="swiper-wrapper">-->
        <!--                <div class="popular_slider-slide swiper-slide">-->
        <!--                    <div class="wrapper d-flex flex-column">-->
        <!--                        <div class="media">-->
        <!--                            <div class="overlay d-flex flex-column align-items-center justify-content-center">-->
        <!--                                <ul class="action d-flex align-items-center justify-content-center">-->
        <!--                                    <li class="list-item">-->
        <!--                                        <a-->
        <!--                                            class="action_link d-flex align-items-center justify-content-center"-->
        <!--                                            href="#"-->
        <!--                                            data-trigger="compare"-->
        <!--                                        >-->
        <!--                                            <i class="icon-compare"></i>-->
        <!--                                        </a>-->
        <!--                                    </li>-->
        <!--                                    <li class="list-item">-->
        <!--                                        <a class="action_link d-flex align-items-center justify-content-center" href="#">-->
        <!--                                            <i class="icon-basket"></i>-->
        <!--                                        </a>-->
        <!--                                    </li>-->
        <!--                                    <li class="list-item">-->
        <!--                                        <a-->
        <!--                                            class="action_link d-flex align-items-center justify-content-center"-->
        <!--                                            href="#"-->
        <!--                                            data-role="wishlist"-->
        <!--                                        >-->
        <!--                                            <i class="icon-heart"></i>-->
        <!--                                        </a>-->
        <!--                                    </li>-->
        <!--                                    <li class="list-item">-->
        <!--                                        <a-->
        <!--                                            class="action_link d-flex align-items-center justify-content-center"-->
        <!--                                            href="#"-->
        <!--                                            data-trigger="view"-->
        <!--                                        >-->
        <!--                                            <i class="icon-eye"></i>-->
        <!--                                        </a>-->
        <!--                                    </li>-->
        <!--                                </ul>-->
        <!--                            </div>-->
        <!--                            <picture>-->
        <!--                                <source data-srcset="frontend/img/shop/07.webp"-->
        <!--                                        srcset="frontend/img/shop/07.webp" type="image/webp" />-->
        <!--                                <img class="lazy" data-src="frontend/img/shop/07.webp"-->
        <!--                                     src="frontend/img/shop/07.webp" alt="media" />-->
        <!--                            </picture>-->
        <!--                        </div>-->
        <!--                        <div class="main d-flex flex-column">-->
        <!--                            <div class="main_rating">-->
        <!--                                <ul class="main_rating-stars d-flex align-items-center accent">-->
        <!--                                    <li class="main_rating-stars_star">-->
        <!--                                        <i class="icon-star_fill"></i>-->
        <!--                                    </li>-->
        <!--                                    <li class="main_rating-stars_star">-->
        <!--                                        <i class="icon-star_fill"></i>-->
        <!--                                    </li>-->
        <!--                                    <li class="main_rating-stars_star">-->
        <!--                                        <i class="icon-star"></i>-->
        <!--                                    </li>-->
        <!--                                    <li class="main_rating-stars_star">-->
        <!--                                        <i class="icon-star"></i>-->
        <!--                                    </li>-->
        <!--                                    <li class="main_rating-stars_star">-->
        <!--                                        <i class="icon-star"></i>-->
        <!--                                    </li>-->
        <!--                                </ul>-->
        <!--                            </div>-->
        <!--                            <a class="main_title" href="{{url('/shop')}}" target="_blank" rel="noopener norefferer">Loading</a-->
        <!--                            >-->
        <!--                            <div class="main_price">-->
        <!--                                <span class="price">₦0</span>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                <div class="popular_slider-slide swiper-slide">-->
        <!--                    <div class="wrapper d-flex flex-column">-->
        <!--                        <div class="media">-->
        <!--                            <div class="overlay d-flex flex-column align-items-center justify-content-center">-->
        <!--                                <ul class="action d-flex align-items-center justify-content-center">-->
        <!--                                    <li class="list-item">-->
        <!--                                        <a-->
        <!--                                            class="action_link d-flex align-items-center justify-content-center"-->
        <!--                                            href="#"-->
        <!--                                            data-trigger="compare"-->
        <!--                                        >-->
        <!--                                            <i class="icon-compare"></i>-->
        <!--                                        </a>-->
        <!--                                    </li>-->
        <!--                                    <li class="list-item">-->
        <!--                                        <a class="action_link d-flex align-items-center justify-content-center" href="#">-->
        <!--                                            <i class="icon-basket"></i>-->
        <!--                                        </a>-->
        <!--                                    </li>-->
        <!--                                    <li class="list-item">-->
        <!--                                        <a-->
        <!--                                            class="action_link d-flex align-items-center justify-content-center"-->
        <!--                                            href="#"-->
        <!--                                            data-role="wishlist"-->
        <!--                                        >-->
        <!--                                            <i class="icon-heart"></i>-->
        <!--                                        </a>-->
        <!--                                    </li>-->
        <!--                                    <li class="list-item">-->
        <!--                                        <a-->
        <!--                                            class="action_link d-flex align-items-center justify-content-center"-->
        <!--                                            href="#"-->
        <!--                                            data-trigger="view"-->
        <!--                                        >-->
        <!--                                            <i class="icon-eye"></i>-->
        <!--                                        </a>-->
        <!--                                    </li>-->
        <!--                                </ul>-->
        <!--                            </div>-->
        <!--                            <picture>-->
        <!--                                <source data-srcset="frontend/img/shop/10.webp"-->
        <!--                                        srcset="frontend/img/shop/10.webp" type="image/webp" />-->
        <!--                                <img class="lazy" data-src="frontend/img/shop/10.webp"-->
        <!--                                     src="frontend/img/shop/10.webp" alt="media" />-->
        <!--                            </picture>-->
        <!--                        </div>-->
        <!--                        <div class="main d-flex flex-column">-->
        <!--                            <div class="main_rating">-->
        <!--                                <ul class="main_rating-stars d-flex align-items-center accent">-->
        <!--                                    <li class="main_rating-stars_star">-->
        <!--                                        <i class="icon-star_fill"></i>-->
        <!--                                    </li>-->
        <!--                                    <li class="main_rating-stars_star">-->
        <!--                                        <i class="icon-star_fill"></i>-->
        <!--                                    </li>-->
        <!--                                    <li class="main_rating-stars_star">-->
        <!--                                        <i class="icon-star_fill"></i>-->
        <!--                                    </li>-->
        <!--                                    <li class="main_rating-stars_star">-->
        <!--                                        <i class="icon-star_fill"></i>-->
        <!--                                    </li>-->
        <!--                                    <li class="main_rating-stars_star">-->
        <!--                                        <i class="icon-star_fill"></i>-->
        <!--                                    </li>-->
        <!--                                </ul>-->
        <!--                            </div>-->
        <!--                            <a class="main_title" href="product.html" target="_blank" rel="noopener norefferer"><i class="fas fa-truck-loading    "></i></a>-->
        <!--                            <div class="main_price">-->
        <!--                                <span class="price">₦0</span>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                <div class="popular_slider-slide swiper-slide">-->
        <!--                    <div class="wrapper d-flex flex-column">-->
        <!--                        <div class="media">-->
        <!--                            <span class="sale d-flex align-items-center justify-content-center">Loading</span>-->
        <!--                            <div class="overlay d-flex flex-column align-items-center justify-content-center">-->
        <!--                                <ul class="action d-flex align-items-center justify-content-center">-->
        <!--                                    <li class="list-item">-->
        <!--                                        <a-->
        <!--                                            class="action_link d-flex align-items-center justify-content-center"-->
        <!--                                            href="#"-->
        <!--                                            data-trigger="compare"-->
        <!--                                        >-->
        <!--                                            <i class="icon-compare"></i>-->
        <!--                                        </a>-->
        <!--                                    </li>-->
        <!--                                    <li class="list-item">-->
        <!--                                        <a class="action_link d-flex align-items-center justify-content-center" href="#">-->
        <!--                                            <i class="icon-basket"></i>-->
        <!--                                        </a>-->
        <!--                                    </li>-->
        <!--                                    <li class="list-item">-->
        <!--                                        <a-->
        <!--                                            class="action_link d-flex align-items-center justify-content-center"-->
        <!--                                            href="#"-->
        <!--                                            data-role="wishlist"-->
        <!--                                        >-->
        <!--                                            <i class="icon-heart"></i>-->
        <!--                                        </a>-->
        <!--                                    </li>-->
        <!--                                    <li class="list-item">-->
        <!--                                        <a-->
        <!--                                            class="action_link d-flex align-items-center justify-content-center"-->
        <!--                                            href="#"-->
        <!--                                            data-trigger="view"-->
        <!--                                        >-->
        <!--                                            <i class="icon-eye"></i>-->
        <!--                                        </a>-->
        <!--                                    </li>-->
        <!--                                </ul>-->
        <!--                            </div>-->
        <!--                            <picture>-->
        <!--                                <source data-srcset="frontend/img/shop/13.webp"-->
        <!--                                        srcset="frontend/img/shop/13.webp" type="image/webp" />-->
        <!--                                <img class="lazy" data-src="frontend/img/shop/13.webp"-->
        <!--                                     src="frontend/img/shop/13.webp" alt="media" />-->
        <!--                            </picture>-->
        <!--                        </div>-->
        <!--                        <div class="main d-flex flex-column">-->
        <!--                            <div class="main_rating">-->
        <!--                                <ul class="main_rating-stars d-flex align-items-center accent">-->
        <!--                                    <li class="main_rating-stars_star">-->
        <!--                                        <i class="icon-star_fill"></i>-->
        <!--                                    </li>-->
        <!--                                    <li class="main_rating-stars_star">-->
        <!--                                        <i class="icon-star_fill"></i>-->
        <!--                                    </li>-->
        <!--                                    <li class="main_rating-stars_star">-->
        <!--                                        <i class="icon-star_fill"></i>-->
        <!--                                    </li>-->
        <!--                                    <li class="main_rating-stars_star">-->
        <!--                                        <i class="icon-star_fill"></i>-->
        <!--                                    </li>-->
        <!--                                    <li class="main_rating-stars_star">-->
        <!--                                        <i class="icon-star"></i>-->
        <!--                                    </li>-->
        <!--                                </ul>-->
        <!--                            </div>-->
        <!--                            <a class="main_title" href="product.html" target="_blank" rel="noopener norefferer">Loading</a>-->
        <!--                            <div class="main_price">-->
        <!--                                {{--  <span class="price price--old">₦5,800</span>  --}}-->
        <!--                                <span class="price price--new">₦0</span>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                <div class="popular_slider-slide swiper-slide">-->
        <!--                    <div class="wrapper d-flex flex-column">-->
        <!--                        <div class="media">-->
        <!--                            <div class="overlay d-flex flex-column align-items-center justify-content-center">-->
        <!--                                <ul class="action d-flex align-items-center justify-content-center">-->
        <!--                                    <li class="list-item">-->
        <!--                                        <a-->
        <!--                                            class="action_link d-flex align-items-center justify-content-center"-->
        <!--                                            href="#"-->
        <!--                                            data-trigger="compare"-->
        <!--                                        >-->
        <!--                                            <i class="icon-compare"></i>-->
        <!--                                        </a>-->
        <!--                                    </li>-->
        <!--                                    <li class="list-item">-->
        <!--                                        <a class="action_link d-flex align-items-center justify-content-center" href="#">-->
        <!--                                            <i class="icon-basket"></i>-->
        <!--                                        </a>-->
        <!--                                    </li>-->
        <!--                                    <li class="list-item">-->
        <!--                                        <a-->
        <!--                                            class="action_link d-flex align-items-center justify-content-center"-->
        <!--                                            href="#"-->
        <!--                                            data-role="wishlist"-->
        <!--                                        >-->
        <!--                                            <i class="icon-heart"></i>-->
        <!--                                        </a>-->
        <!--                                    </li>-->
        <!--                                    <li class="list-item">-->
        <!--                                        <a-->
        <!--                                            class="action_link d-flex align-items-center justify-content-center"-->
        <!--                                            href="#"-->
        <!--                                            data-trigger="view"-->
        <!--                                        >-->
        <!--                                            <i class="icon-eye"></i>-->
        <!--                                        </a>-->
        <!--                                    </li>-->
        <!--                                </ul>-->
        <!--                            </div>-->
        <!--                            <picture>-->
        <!--                                <source data-srcset="frontend/img/shop/14.webp"-->
        <!--                                        srcset="frontend/img/shop/14.webp" type="image/webp" />-->
        <!--                                <img class="lazy" data-src="frontend/img/shop/14.webp"-->
        <!--                                     src="frontend/img/shop/14.webp" alt="media" />-->
        <!--                            </picture>-->
        <!--                        </div>-->
        <!--                        <div class="main d-flex flex-column">-->
        <!--                            <div class="main_rating">-->
        <!--                                <ul class="main_rating-stars d-flex align-items-center accent">-->
        <!--                                    <li class="main_rating-stars_star">-->
        <!--                                        <i class="icon-star_fill"></i>-->
        <!--                                    </li>-->
        <!--                                    <li class="main_rating-stars_star">-->
        <!--                                        <i class="icon-star_fill"></i>-->
        <!--                                    </li>-->
        <!--                                    <li class="main_rating-stars_star">-->
        <!--                                        <i class="icon-star_fill"></i>-->
        <!--                                    </li>-->
        <!--                                    <li class="main_rating-stars_star">-->
        <!--                                        <i class="icon-star"></i>-->
        <!--                                    </li>-->
        <!--                                    <li class="main_rating-stars_star">-->
        <!--                                        <i class="icon-star"></i>-->
        <!--                                    </li>-->
        <!--                                </ul>-->
        <!--                            </div>-->
        <!--                            <a class="main_title" href="product.html" target="_blank" rel="noopener norefferer">Loading</a-->
        <!--                            >-->
        <!--                            <div class="main_price">-->
        <!--                                <span class="price">₦0</span>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="swiper-pagination swiper-pagination--dots"></div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->
        <!-- Popular products section end -->
        <!-- Reviews section start -->
        <section class="reviews section--nopb">
            <div class="container">
                <div class="reviews_header">
                    <h2 class="reviews_header-title">Your Trust is Our Top Concern</h2>
                    <p class="reviews_header-text">
                        Earn money Using our Product .
                    </p>
                </div>
                <div class="reviews_slider swiper">
                    <div class="swiper-wrapper">
                        <div class="reviews_slider-slide swiper-slide">
                            <div class="reviews_slider-slide_wrapper d-flex flex-column align-items-center">
                                <picture>
                                    <source
                                        data-srcset="frontend/img/review01.webp"
                                        srcset="frontend/img/review01.webp"
                                        type="image/webp"
                                    />
                                    <img
                                        class="lazy avatar"
                                        data-src="frontend/img/review01.webp"
                                        src="frontend/img/review01.webp"
                                        alt="avatar"
                                    />
                                </picture>
                                <ul class="rating d-flex align-items-center accent">
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                </ul>
                                <p class="text">
                                    A blend of natural herbs and fruits, rich in anti-oxidant, Polyphenols,
                                    Glycosides, Alkaloids, Terpenoids, Falvonoids,  Catechins.
                                    Zinc, Potassium, Magnesium,   Calcium, Sodium, Iron, Vitamin C,  ETC.
                                </p>
                                <h5 class="name">Wonder Tea</h5>
                            </div>
                        </div>

                        <div class="reviews_slider-slide swiper-slide">
                            <div class="reviews_slider-slide_wrapper d-flex flex-column align-items-center">
                                <picture>
                                    <source
                                        data-srcset="frontend/img/review02.webp"
                                        srcset="frontend/img/review02.webp"
                                        type="image/webp"
                                    />
                                    <img
                                        class="lazy avatar"
                                        data-src="frontend/img/review02.webp"
                                        src="frontend/img/review02.webp"
                                        alt="avatar"
                                    />
                                </picture>
                                <ul class="rating d-flex align-items-center accent">
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                </ul>
                                <p class="text">
                                 Rich In Enzyme,Weight Loss, Reduce Swelling ,Cure Infection
                                 Improve Lactation ,Anti aging Correct menstrual disorders
                                 Fight Intestinal Parasite

                                </p>
                                <h5 class="name"> Fixit Tea </h5>
                            </div>
                        </div>

                        <div class="reviews_slider-slide swiper-slide">
                            <div class="reviews_slider-slide_wrapper d-flex flex-column align-items-center">
                                <picture>
                                    <source
                                        data-srcset="frontend/img/review03.webp"
                                        srcset="frontend/img/review03.webp"
                                        type="image/webp"
                                    />
                                    <img
                                        class="lazy avatar"
                                        data-src="frontend/img/review03.webp"
                                        src="frontend/img/review03.webp"
                                        alt="avatar"
                                    />
                                </picture>
                                <ul class="rating d-flex align-items-center accent">
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                </ul>
                                <p class="text">
                                    Promotes  Wound Healing
                                    Fights Infection
                                    Promotes Bowel Movement
                                    Tissues Repairs
                                    Suitable For People With Stroke
                                    Suitable For People With Hiv
                                    Strengthens The Liver

                                </p>
                                <h5 class="name">Nutri-SC-V7</h5>
                            </div>
                        </div>

                        <div class="reviews_slider-slide swiper-slide">
                            <div class="reviews_slider-slide_wrapper d-flex flex-column align-items-center">
                                <picture>
                                    <source
                                        data-srcset="frontend/img/review04.webp"
                                        srcset="frontend/img/review04.webp"
                                        type="image/webp"
                                    />
                                    <img
                                        class="lazy avatar"
                                        data-src="frontend/img/review04.webp"
                                        src="frontend/img/review04.webp"
                                        alt="avatar"
                                    />
                                </picture>
                                <ul class="rating d-flex align-items-center accent">
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                </ul>
                                <p class="text">
                                    Improve Blood circulation
                                    Anti Inflammation
                                    Boost Immune System
                                    Maintain Blood Pressure
                                    Maintain Cholesterol Level
                                    Prevent Cancer
                                    Rich in antioxidant

                                </p>
                                <h5 class="name">Nutri-SC-1</h5>
                            </div>
                        </div>

                        <div class="reviews_slider-slide swiper-slide">
                            <div class="reviews_slider-slide_wrapper d-flex flex-column align-items-center">
                                <picture>
                                    <source
                                        data-srcset="frontend/img/review05.webp"
                                        srcset="frontend/img/review05.webp"
                                        type="image/webp"
                                    />
                                    <img
                                        class="lazy avatar"
                                        data-src="frontend/img/review05.webp"
                                        src="frontend/img/review05.webp"
                                        alt="avatar"
                                    />
                                </picture>
                                <ul class="rating d-flex align-items-center accent">
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                </ul>
                                <p class="text">
                                   Wellness, Strenght and Vitality
                                </p>
                                <h5 class="name">Complete Package </h5>
                            </div>
                        </div>

                        <div class="reviews_slider-slide swiper-slide">
                            <div class="reviews_slider-slide_wrapper d-flex flex-column align-items-center">
                                <picture>
                                    <source
                                        data-srcset="frontend/img/review06.webp"
                                        srcset="frontend/img/review06.webp"
                                        type="image/webp"
                                    />
                                    <img
                                        class="lazy avatar"
                                        data-src="frontend/img/review06.webp"
                                        src="frontend/img/review06.webp"
                                        alt="avatar"
                                    />
                                </picture>
                                <ul class="rating d-flex align-items-center accent">
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                    <li class="rating_star">
                                        <i class="icon-star_fill"></i>
                                    </li>
                                </ul>
                                <p class="text">
                                    Build Your wealth using our Amazing  Compensation plan
                                </p>
                                <h5 class="name">Wealth</h5>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination swiper-pagination--dots"></div>
                </div>
            </div>
            <div class="reviews_underlay">
                <span class="reviews_underlay-circle reviews_underlay-circle--green"></span>
                <span class="reviews_underlay-circle reviews_underlay-circle--yellow"></span>
            </div>
        </section>
        <!-- Reviews section end -->
        <!-- Newsletter section start -->
        <section class="newsletter section--nopb">
            <div class="container">
                <div class="wrapper">
                    <div class="newsletter_deco">
                        <div class="newsletter_deco-wrapper">
                            <picture>
                                <source
                                    data-srcset="frontend/img/leaf--left.webp"
                                    srcset="frontend/img/leaf--left.webp"
                                    type="image/webp"
                                />
                                <img
                                    class="lazy leaf leaf--left"
                                    data-src="frontend/img/leaf--left.webp"
                                    src="frontend/img/leaf--left.webp"
                                    alt="deco"
                                />
                            </picture>
                        </div>
                        <div class="newsletter_deco-wrapper">
                            <picture>
                                <source
                                    data-srcset="frontend/img/leaf--right.webp"
                                    srcset="frontend/img/leaf--right.webp"
                                    type="image/webp"
                                />
                                <img
                                    class="lazy leaf leaf--right"
                                    data-src="frontend/img/leaf--right.webp"
                                    src="frontend/img/leaf--right.webp"
                                    alt="deco"
                                />
                            </picture>
                        </div>
                    </div>
                    <div class="newsletter_highlight">
                                    <span class="underlay underlay--left">
                                        <span class="underlay_circle underlay_circle--accent"></span>
                                    </span>
                        <span class="underlay underlay--right">
                                        <span class="underlay_circle underlay_circle--small underlay_circle--green"></span>
                                        <span class="underlay_circle underlay_circle--big underlay_circle--green"></span>
                                    </span>
                    </div>
                    <div class="newsletter_content">
                        <div class="newsletter_header">
                            <h2 class="newsletter_header-title">Have You Sign Up ?</h2>
                            <p class="newsletter_header-text">
                                Feel Free To reach us Via Email.
                            </p>
                        </div>
                        <form class="newsletter_form d-sm-flex" data-type="newsletter" action="#" method="post">
                            <input class="newsletter_form-field field required" type="text" data-type="email" placeholder="Email" />
                            <button class="newsletter_form-btn btn" type="submit">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Newsletter section end -->
        <!-- FAQ section start -->
        <section class="faq section--nopb">
            <div class="container d-flex flex-column-reverse flex-xl-row">
                <div class="faq_media">
                    <picture>
                        <source data-srcset="frontend/img/faq.webp"
                                srcset="frontend/img/faq.webp" type="image/webp" />
                        <img class="lazy" data-src="frontend/img/faq.webp"
                             src="frontend/img/faq.webp" alt="media" />
                    </picture>
                </div>
                <div class="faq_main col-xl-6">
                    <div class="faq_main-header">
                        <h2 class="faq_main-header_title">The Effects of Wonder tea on Your Body</h2>
                        <p class="faq_main-header_text">
                            Feel The Goodness in a Cup of Wonder Tea
                        </p>
                    </div>
                    <div class="accordion">
                        <div class="accordion_component" id="accordionComponent">
                            <!-- item 1 -->
                            <div class="accordion_component-item">
                                <h4
                                    class="accordion_component-item_header d-flex justify-content-between align-items-center collapsed"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#item-1"
                                >
                                    Reduce Inflammation and Relieve Pain
                                    <span class="wrapper">
                                                    <i class="icon-caret_down icon"></i>
                                                </span>
                                </h4>
                                <div id="item-1" class="accordion-collapse collapse" data-bs-parent="#accordionComponent">
                                    <div class="accordion_component-item_body">
                                       A blend of Natural solution to pain
                                    </div>
                                </div>
                            </div>
                            <!-- item 2 -->
                            <div class="accordion_component-item">
                                <h4
                                    class="accordion_component-item_header d-flex justify-content-between align-items-center"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#item-2"
                                >
                                    Kill Cancer Cells and Slow Tumor Growth
                                    <span class="wrapper">
                                                    <i class="icon-caret_down transform icon"></i>
                                                </span>
                                </h4>
                                <div id="item-2" class="accordion-collapse collapse show" data-bs-parent="#accordionComponent">
                                    <div class="accordion_component-item_body">
                                        Rich In Flavonoid
                                    </div>
                                </div>
                            </div>
                            <!-- item 3 -->
                            <div class="accordion_component-item">
                                <h4
                                    class="accordion_component-item_header d-flex justify-content-between align-items-center collapsed"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#item-3"
                                >
                                    Relax Tight Muscles in People with MS
                                    <span class="wrapper">
                                                    <i class="icon-caret_down icon"></i>
                                                </span>
                                </h4>
                                <div id="item-3" class="accordion-collapse collapse" data-bs-parent="#accordionComponent">
                                    <div class="accordion_component-item_body">
                                        Rich In Calcium and Iron
                                    </div>
                                </div>
                            </div>
                            <!-- item 4 -->
                            <div class="accordion_component-item">
                                <h4
                                    class="accordion_component-item_header d-flex justify-content-between align-items-center collapsed"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#item-4"
                                >
                                    Stimulate Appetite and Improve Weight
                                    <span class="wrapper">
                                                    <i class="icon-caret_down icon"></i>
                                                </span>
                                </h4>
                                <div id="item-4" class="accordion-collapse collapse" data-bs-parent="#accordionComponent">
                                    <div class="accordion_component-item_body">
                                        Rich In Enzymes
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- FAQ section end -->
        <!--  Contacts section start -->
        <section class="contacts section">
            <div class="container">
                <div class="contacts_header">
                    <h2 class="contacts_header-title">Have any Questions?</h2>
                    <p class="contacts_header-text">
                        Please Feel Free To reach us
                    </p>
                </div>
                <ul class="contacts_cards d-md-flex flex-wrap">
                    <li class="contacts_cards-item col-md-6 col-xl-4" data-order="1" data-aos="fade-up">
                        <div class="contacts_cards-item_wrapper d-xl-flex flex-column justify-content-between">
                            <h4 class="title">Our Office Location</h4>
                            <div class="info flex-grow-1 flex-xxl-grow-0 d-flex flex-column flex-sm-row align-items-center">
                                <i class="icon-location icon"></i>
                                <span class="address">Head office : Suit T 1 Febson Mall Wuse Zone IV
                                                <span class="linebreak"> Abuja Nigeria </span>
                                </span>
                            </div>
                            <p class="text">
                                Great Provider  !
                            </p>
                        </div>
                    </li>
                    <li class="contacts_cards-item col-md-6 col-xl-4" data-order="2" data-aos="fade-up">
                        <div class="contacts_cards-item_wrapper">
                            <h4 class="title">How Can We Help?</h4>
                            <ul class="list">
                                <li class="list-item d-flex align-items-center">
                                    <i class="icon-check icon"></i>
                                   Health
                                </li>
                                <li class="list-item d-flex align-items-center">
                                    <i class="icon-check icon"></i>
                                    Wealth
                                </li>
                                <li class="list-item d-flex align-items-center">
                                    <i class="icon-check icon"></i>
                                    One To Many Connections
                                </li>
                                <li class="list-item d-flex align-items-center">
                                    <i class="icon-check icon"></i>
                                    Knowledge
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="contacts_cards-item col-md-6 col-xl-4" data-order="3" data-aos="fade-up">
                        <div class="contacts_cards-item_wrapper d-xl-flex flex-column justify-content-between">
                            <h4 class="title">Our Phone</h4>
                            <div class="info flex-grow-1 flex-xxl-grow-0 d-flex flex-column flex-sm-row align-items-center">
                                <i class="icon-call icon"></i>
                                <div class="wrapper d-flex flex-column align-items-center">
                                    <a class="link" href="tel:+1234567890">+234-0700 CALL GPS</a>
                                    <a class="link" href="tel:+1234567890">+234-0700 CALL GPs</a>
                                </div>
                            </div>
                            <p class="text">
                                Free to Call Us
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
       
        <!--  Contacts section end -->
        <!--<div class="partners">-->
        <!--    <div class="container-fluid container-xl">-->
        <!--        <div class="partners_list swiper">-->
        <!--            <ul class="swiper-wrapper">-->
        <!--                <li class="partners_list-item d-flex justify-content-center swiper-slide">-->
        <!--                    <svg width="145" height="120" viewBox="0 0 145 120" fill="none" xmlns="http://www.w3.org/2000/svg">-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M51.2945 69.559C54.7578 67.5068 58.2879 63.8973 61.0647 60.378C61.3633 59.793 62.0319 59.4735 62.6871 59.649C68.6509 61.2646 74.2223 62.2187 79.4106 61.5842C83.8231 61.0441 88.0042 59.3429 91.9709 55.8866C90.045 55.378 87.7899 54.838 85.5481 54.469C83.0654 54.0594 80.6047 53.8479 78.6795 54.1089C78.1312 54.2529 77.5919 54.3789 77.0526 54.4825C76.2859 54.6265 75.5505 54.1179 75.4079 53.3438C75.2697 52.6012 75.7288 51.8857 76.442 51.7012C76.9412 51.5392 77.4805 51.4177 78.051 51.3277C82.597 50.1035 87.438 47.2637 91.3735 43.5779C94.7789 40.3916 97.4797 36.5932 98.6831 32.6958C93.9539 33.8164 89.5102 35.2701 85.5661 37.4482C81.0863 39.9235 77.2086 43.3529 74.2312 48.3439H74.2268C73.83 49.0099 72.9743 49.2304 72.3102 48.8389C71.6372 48.4429 71.4142 47.5697 71.8065 46.8902L71.8154 46.8767H71.811C71.8511 46.8092 71.8957 46.7372 71.9358 46.6697C75.2786 40.9181 77.583 35.9586 78.7421 30.8146C79.7625 26.2826 79.8962 21.5616 79.0674 15.9586C75.1449 19.568 72.0873 23.5689 69.9835 27.9928C67.6524 32.8983 66.4802 38.3349 66.5872 44.3519C66.6406 45.018 66.2216 45.648 65.562 45.8325C64.8132 46.0441 64.0332 45.6031 63.8237 44.847C62.3885 39.7075 60.5387 35.4591 57.7619 32.2232C55.4174 29.4869 52.3687 27.4393 48.2993 26.1386C48.4063 26.7372 48.5044 27.3132 48.6024 27.8803C50.0153 36.1161 51.1386 42.6687 57.9758 47.2367C58.689 47.6012 59.3977 48.0243 60.1064 48.5059C60.7526 48.9469 60.9221 49.8335 60.4852 50.486C60.0618 51.1206 59.2239 51.3007 58.5865 50.909C57.8555 50.5175 57.1691 50.1125 56.5273 49.694C54.7667 48.8119 52.9927 48.3258 51.2277 48.1278C49.2175 47.9028 47.2073 48.0558 45.2416 48.4338C45.9147 50.8145 48.1656 55.846 55.2703 57.0072C56.037 57.1287 56.5629 57.8578 56.4426 58.6363C56.3223 59.4104 55.6002 59.9415 54.8291 59.82C43.3251 57.9388 42.1707 47.5517 42.1662 47.5202C42.0726 46.7552 42.5985 46.0621 43.3429 45.9406C46.0039 45.297 48.754 44.9865 51.5441 45.297L51.6155 45.306C47.9471 40.7156 46.9755 35.0495 45.83 28.3618C45.6027 27.0387 45.3665 25.6706 45.1347 24.4239C44.992 23.6499 45.4957 22.9073 46.2624 22.7633C46.4629 22.7273 46.6591 22.7318 46.8418 22.7768C52.6138 24.1539 56.7813 26.7192 59.9058 30.3601C61.6486 32.3942 63.057 34.7479 64.2248 37.4077C64.7864 33.6319 65.874 30.0855 67.4563 26.7642C70.0682 21.2736 74.0172 16.4086 79.1565 12.1287C79.7578 11.6291 80.6453 11.7191 81.1395 12.3223C81.2959 12.5158 81.3936 12.7363 81.4382 12.9658C82.7753 20.072 82.7581 25.8686 81.5055 31.4401C80.9972 33.7084 80.2794 35.9316 79.3747 38.1818C80.9034 36.9622 82.5259 35.8956 84.2329 34.955C89.0738 32.2817 94.5247 30.6571 100.297 29.4194C101.059 29.2574 101.808 29.7479 101.968 30.5176C102.013 30.7246 102.009 30.9271 101.968 31.1206C101.09 36.3816 97.7291 41.5257 93.3081 45.666C90.8434 47.9748 88.0354 49.9775 85.1376 51.5212C85.4277 51.5617 85.717 51.6112 86.0118 51.6562C89.439 52.2232 92.8397 53.1413 95.1667 53.8074C95.9158 54.0189 96.3568 54.8065 96.1426 55.5625C96.0714 55.828 95.9291 56.0531 95.7414 56.2242C90.7542 61.3142 85.4363 63.7173 79.7539 64.4105C74.4274 65.0585 68.8336 64.1944 62.9055 62.6463C59.986 66.2331 56.398 69.6985 52.7654 71.8361C46.7527 75.378 39.8663 74.4735 34.6291 69.8425C28.5673 64.4825 26 54.874 26 46.6382C26 33.7579 31.1703 22.0972 39.5275 13.6588C47.8892 5.22052 59.4378 0 72.1898 0C74.9979 0 77.7479 0.252025 80.4225 0.738073L80.471 0.747069L80.6359 0.778576C82.4813 1.17911 81.7189 3.91988 80.3107 3.62736C77.6811 3.1233 74.9667 2.86229 72.1898 2.86229C60.2178 2.86229 49.3735 7.76327 41.5288 15.6841C33.6797 23.6049 28.8303 34.5544 28.8303 46.6427C28.8303 57.1377 33.0602 70.3915 45.1792 71.2241C45.1659 71.2331 48.6425 71.4086 51.2945 69.559Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M84.121 82.0792C82.1084 82.7868 80.0374 83.3225 77.9406 83.6786C75.8479 84.0347 73.7197 84.2143 71.5737 84.2143C69.5655 84.2143 67.5794 84.0609 65.6334 83.7488C63.6917 83.4412 61.7591 82.9757 59.853 82.3513C59.111 82.11 58.3157 82.5101 58.0713 83.2393C57.8269 83.9731 58.2313 84.7593 58.9689 85.0013C60.9859 85.6603 63.0697 86.1567 65.1935 86.4951C67.3173 86.8289 69.4544 87 71.5737 87C73.8663 87 76.1545 86.8027 78.4161 86.4204C80.6735 86.0334 82.8949 85.4576 85.0587 84.6976C85.7914 84.4433 86.178 83.6478 85.92 82.9225C85.6628 82.2064 84.8537 81.8241 84.121 82.0792ZM79.3842 81.2914C81.6037 80.8281 83.7886 80.1336 85.9056 79.2219C86.0089 79.1838 86.1074 79.1324 86.206 79.0661C86.8667 78.6218 87.0607 77.6911 86.6381 76.9967C83.0648 71.2425 79.892 73.1937 75.1008 73.1937C73.7255 73.1937 72.4581 73.0708 71.6491 72.792L71.2266 72.6267C76.2109 70.4725 90.6064 66.608 97.9186 70.6142C98.6156 70.9969 99.4735 70.7134 99.8377 69.9811C100.202 69.2489 99.9323 68.3466 99.2353 67.9639C88.8489 62.2664 68.1165 70.7748 68.0581 70.8079C67.3569 71.148 67.0378 72.022 67.3524 72.7684C67.3524 72.7731 68.1615 74.7479 70.7637 75.6408C71.8783 76.0235 73.4558 76.1936 75.0962 76.1936C79.3748 76.1936 79.2352 74.6818 82.9165 77.1998C81.5817 77.6769 80.22 78.0549 78.8356 78.3478C76.7682 78.7777 74.6558 78.9998 72.5299 78.9998C70.8851 78.9998 69.2446 78.8675 67.6311 78.6077C66.0086 78.3478 64.4086 77.9557 62.8491 77.4407C62.0985 77.1951 61.2985 77.6344 61.0648 78.4282C60.8311 79.2169 61.2491 80.0581 61.9996 80.3035C63.7075 80.8662 65.4514 81.2914 67.2086 81.5748C68.9704 81.8583 70.7502 82 72.5344 82C74.8356 82 77.1322 81.7638 79.3842 81.2914ZM104.475 13.8097C101.539 10.8602 98.2066 8.30451 94.5669 6.23224C92.6514 5.21175 91.7338 7.82562 93.3735 8.82376L93.3821 8.82824C96.7146 10.7528 99.7751 13.1071 102.475 15.8239C110.315 23.7013 115.167 34.591 115.167 46.613C115.167 58.6351 110.315 69.5247 102.475 77.4021C94.6341 85.2838 83.7949 90.1583 71.829 90.1583C68.6482 90.1583 65.4986 89.805 62.4247 89.1195C61.1728 88.829 60.2729 91.2726 61.8144 91.8944C65.0887 92.6247 68.4477 93 71.829 93C84.5788 93 96.1222 87.8082 104.475 79.4159C112.828 71.0241 118 59.4228 118 46.6175C118 33.8032 112.832 22.2064 104.475 13.8097Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M16 96V115H12.656V106.857H3.34405V115H0V96H3.34405V103.844H12.656V96H16Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M34.9451 108.583C34.9817 108.145 35 107.806 35 107.569C35 106.07 34.6795 104.753 34.0385 103.62C33.4158 102.468 32.5366 101.581 31.4011 100.96C30.2839 100.32 29.011 100 27.5824 100C26.1356 100 24.8352 100.32 23.6814 100.96C22.5275 101.6 21.6209 102.496 20.9616 103.647C20.3206 104.781 20 106.061 20 107.486C20 108.93 20.3297 110.229 20.9891 111.381C21.6667 112.514 22.619 113.4 23.8462 114.04C25.0733 114.68 26.4927 115 28.1045 115C29.3682 115 30.5036 114.799 31.511 114.397C32.5183 113.995 33.3517 113.4 34.011 112.615L32.1703 110.503C31.1264 111.564 29.7985 112.093 28.1869 112.093C26.9231 112.093 25.8609 111.782 25 111.161C24.1575 110.521 23.6356 109.662 23.4341 108.583H34.9451ZM25.3201 103.831C26.0594 103.277 26.9571 103 28.0132 103C29.0869 103 29.9846 103.277 30.7062 103.831C31.428 104.385 31.8592 105.108 32 106H24C24.1584 105.092 24.5984 104.37 25.3201 103.831Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M57.1142 101C58.9238 101 60.3572 101.547 61.4143 102.639C62.4715 103.713 63 105.334 63 107.5V116H59.6405V107.944C59.6405 106.648 59.3628 105.676 58.8074 105.028C58.252 104.362 57.4547 104.028 56.4154 104.028C55.2867 104.028 54.3818 104.417 53.701 105.195C53.0202 105.953 52.6798 107.047 52.6798 108.472V116H49.3202V107.944C49.3202 106.648 49.0425 105.676 48.4871 105.028C47.9317 104.362 47.1344 104.028 46.0952 104.028C44.9485 104.028 44.0347 104.408 43.3539 105.166C42.691 105.926 42.3595 107.028 42.3595 108.472V116H39V101.166H42.1983V103.056C42.7358 102.389 43.4076 101.88 44.2139 101.528C45.0202 101.176 45.916 101 46.9014 101C47.9765 101 48.9261 101.213 49.7503 101.639C50.5924 102.046 51.2553 102.658 51.7391 103.472C52.3304 102.694 53.0918 102.092 54.0235 101.667C54.9552 101.223 55.9854 101 57.1142 101Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M78.5082 100.927C77.4324 100.309 76.2065 100 74.8309 100C73.8608 100 72.9701 100.173 72.1589 100.518C71.3651 100.863 70.6949 101.381 70.1482 102.071V100.163H67V120H70.3069V112.943C71.418 114.25 72.9261 114.904 74.8309 114.904C76.2065 114.904 77.4324 114.596 78.5082 113.978C79.602 113.36 80.4568 112.489 81.0741 111.362C81.6914 110.218 82 108.91 82 107.439C82 105.967 81.6914 104.669 81.0741 103.542C80.4568 102.416 79.602 101.544 78.5082 100.927ZM78.7224 110.76C77.8896 111.586 76.8202 112 75.5142 112C74.6624 112 73.8959 111.82 73.2145 111.461C72.5331 111.084 71.9937 110.553 71.5962 109.871C71.1987 109.188 71 108.398 71 107.5C71 106.601 71.1987 105.811 71.5962 105.128C71.9937 104.446 72.5331 103.925 73.2145 103.566C73.8959 103.188 74.6624 103 75.5142 103C76.8202 103 77.8896 103.413 78.7224 104.239C79.5741 105.066 80 106.152 80 107.5C80 108.847 79.5741 109.934 78.7224 110.76Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M92.7514 115C90.9095 115 89.2407 114.595 87.7457 113.786C86.2683 112.959 85.1034 111.824 84.2518 110.382C83.417 108.939 83 107.312 83 105.5C83 103.688 83.4262 102.061 84.2777 100.618C85.1293 99.1758 86.2942 98.0493 87.7716 97.2399C89.2666 96.4136 90.9355 96 92.7781 96C94.2723 96 95.637 96.2639 96.8713 96.7916C98.1055 97.3194 99.1484 98.0848 100 99.0878L97.8097 101.172C96.4893 99.7298 94.8639 99.0084 92.9344 99.0084C91.6826 99.0084 90.5619 99.29 89.5708 99.8525C88.5798 100.398 87.8067 101.163 87.2502 102.149C86.6937 103.134 86.4162 104.251 86.4162 105.5C86.4162 106.749 86.6937 107.866 87.2502 108.851C87.8067 109.837 88.5798 110.611 89.5708 111.174C90.5619 111.718 91.6826 111.992 92.9344 111.992C94.8639 111.992 96.4893 111.262 97.8097 109.801L100 111.912C99.1484 112.915 98.0971 113.681 96.8453 114.208C95.6111 114.736 94.2464 115 92.7514 115Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M114.181 101.564C112.989 100.521 111.257 100 108.986 100C107.715 100 106.513 100.156 105.378 100.467C104.242 100.777 103.27 101.225 102.463 101.81L103.876 104.306C104.454 103.849 105.156 103.492 105.984 103.236C106.83 102.98 107.687 102.852 108.553 102.852C109.823 102.852 110.776 103.126 111.41 103.675C112.065 104.223 112.392 105.01 112.392 106.033V106.252H108.408C106.195 106.252 104.569 106.655 103.53 107.459C102.511 108.245 102 109.296 102 110.613C102 111.454 102.231 112.212 102.693 112.889C103.174 113.547 103.847 114.068 104.713 114.452C105.579 114.817 106.59 115 107.744 115C108.899 115 109.88 114.836 110.689 114.507C111.516 114.159 112.151 113.666 112.594 113.026V114.808H116V106.225C116 104.141 115.394 102.587 114.181 101.564ZM111.464 111.421C110.756 111.806 109.938 112 109.013 112C108.067 112 107.329 111.816 106.798 111.448C106.266 111.08 106 110.584 106 109.958C106 108.653 107.063 108 109.19 108H113V109.71C112.705 110.446 112.193 111.016 111.464 111.421Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M123.465 103.333C124.514 101.778 126.359 101 129 101V104.306C128.689 104.25 128.407 104.223 128.155 104.223C126.737 104.223 125.631 104.621 124.835 105.417C124.038 106.195 123.641 107.324 123.641 108.806V116H120V101.166H123.465V103.333Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M144.945 108.583C144.982 108.145 145 107.806 145 107.569C145 106.07 144.68 104.753 144.039 103.62C143.416 102.468 142.537 101.581 141.401 100.96C140.284 100.32 139.011 100 137.583 100C136.136 100 134.836 100.32 133.681 100.96C132.528 101.6 131.621 102.496 130.961 103.647C130.32 104.781 130 106.061 130 107.486C130 108.93 130.33 110.229 130.99 111.381C131.667 112.514 132.619 113.4 133.847 114.04C135.073 114.68 136.493 115 138.105 115C139.368 115 140.504 114.799 141.511 114.397C142.519 113.995 143.352 113.4 144.011 112.615L142.171 110.503C141.127 111.564 139.799 112.093 138.187 112.093C136.923 112.093 135.861 111.782 135 111.161C134.158 110.521 133.636 109.662 133.435 108.583H144.945ZM135.32 103.831C136.06 103.277 136.957 103 138.014 103C139.087 103 139.985 103.277 140.706 103.831C141.428 104.385 141.859 105.108 142 106H134C134.159 105.092 134.599 104.37 135.32 103.831Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                    </svg>-->
        <!--                </li>-->
        <!--                <li class="partners_list-item d-flex justify-content-center swiper-slide">-->
        <!--                    <svg width="99" height="120" viewBox="0 0 99 120" fill="none" xmlns="http://www.w3.org/2000/svg">-->
        <!--                        <path-->
        <!--                            d="M11.4571 102C10.0481 102 8.772 101.701 7.62882 101.105C6.49896 100.496 5.60839 99.66 4.95705 98.5973C4.31902 97.534 4 96.3351 4 95C4 93.6649 4.32566 92.466 4.977 91.4027C5.62833 90.34 6.51892 89.5105 7.64879 88.9143C8.79196 88.3045 10.068 88 11.477 88C12.6202 88 13.6636 88.1947 14.6074 88.5834C15.5511 88.9721 16.3487 89.5362 17 90.2751L15.3252 91.8113C14.315 90.748 13.0721 90.2166 11.5966 90.2166C10.6396 90.2166 9.78221 90.4241 9.02453 90.8392C8.26686 91.2408 7.67534 91.8049 7.24998 92.5309C6.82463 93.2563 6.61195 94.0793 6.61195 95C6.61195 95.9201 6.82463 96.7431 7.24998 97.4691C7.67534 98.1951 8.26686 98.7657 9.02453 99.1801C9.78221 99.5823 10.6396 99.7834 11.5966 99.7834C13.0721 99.7834 14.315 99.245 15.3252 98.1694L17 99.7249C16.3487 100.464 15.5445 101.027 14.5874 101.417C13.6437 101.805 12.6003 102 11.4571 102Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M25.8309 93.042C25.0639 92.3473 23.9505 92 22.4907 92C21.6743 92 20.901 92.1033 20.1712 92.3105C19.4413 92.5177 18.8165 92.8167 18.297 93.2064L19.2062 94.87C19.5774 94.5655 20.0289 94.3275 20.5608 94.1572C21.1052 93.9868 21.6557 93.9011 22.2124 93.9011C23.0289 93.9011 23.6412 94.0841 24.0495 94.4496C24.4701 94.815 24.6804 95.3394 24.6804 96.022V96.1682H22.1196C20.6969 96.1682 19.6515 96.4364 18.9835 96.9722C18.3279 97.4966 18 98.1973 18 99.075C18 99.6356 18.1485 100.141 18.4454 100.592C18.7546 101.031 19.1877 101.378 19.7443 101.634C20.301 101.878 20.9505 102 21.6928 102C22.4351 102 23.066 101.89 23.5855 101.671C24.1175 101.439 24.5258 101.11 24.8103 100.684V101.872H27V96.1501C27 94.7607 26.6103 93.7247 25.8309 93.042ZM23.1223 99.7101C22.7173 99.9034 22.2503 100 21.7215 100C21.1814 100 20.7595 99.9079 20.4557 99.7242C20.1519 99.5401 20 99.2917 20 98.979C20 98.3263 20.6076 98 21.8228 98H24V98.8551C23.8312 99.2229 23.5387 99.5077 23.1223 99.7101Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M36.7604 92C38.0405 92 39.0671 92.3641 39.8403 93.0923C40.6134 93.8211 41 94.9011 41 96.333V102H38.6236V96.6298C38.6236 95.7651 38.4144 95.1171 37.9962 94.6851C37.5779 94.2409 36.9822 94.0187 36.2091 94.0187C35.3346 94.0187 34.6439 94.2776 34.1369 94.7965C33.6299 95.3025 33.3764 96.0368 33.3764 97V102H31V92.1114H33.2624V93.3891C33.6552 92.932 34.1496 92.5862 34.7452 92.3519C35.3409 92.1175 36.0127 92 36.7604 92Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M49.7605 92C51.0406 92 52.0671 92.3641 52.8403 93.0923C53.6134 93.8211 54 94.9011 54 96.333V102H51.6236V96.6298C51.6236 95.7651 51.4144 95.1171 50.9962 94.6851C50.578 94.2409 49.9822 94.0187 49.2091 94.0187C48.3346 94.0187 47.6439 94.2776 47.1369 94.7965C46.6299 95.3025 46.3764 96.0368 46.3764 97V102H44V92.1114H46.2624V93.3891C46.6552 92.932 47.1496 92.5862 47.7452 92.3519C48.3409 92.1175 49.0127 92 49.7605 92Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M63.8307 93.042C63.0636 92.3473 61.9504 92 60.4907 92C59.6742 92 58.901 92.1033 58.1711 92.3105C57.4412 92.5177 56.8164 92.8167 56.2969 93.2064L57.2061 94.87C57.5773 94.5655 58.0288 94.3275 58.5608 94.1572C59.1051 93.9868 59.6556 93.9011 60.2123 93.9011C61.0288 93.9011 61.6412 94.0841 62.0494 94.4496C62.47 94.815 62.6803 95.3394 62.6803 96.022V96.1682H60.1195C58.6969 96.1682 57.6515 96.4364 56.9835 96.9722C56.3278 97.4966 56 98.1973 56 99.075C56 99.6356 56.1485 100.141 56.4454 100.592C56.7546 101.031 57.1876 101.378 57.7443 101.634C58.301 101.878 58.9504 102 59.6927 102C60.435 102 61.0659 101.89 61.5855 101.671C62.1174 101.439 62.5257 101.11 62.8102 100.684V101.872H65V96.1501C65 94.7607 64.61 93.7247 63.8307 93.042ZM61.1223 99.7101C60.7173 99.9034 60.2503 100 59.7215 100C59.1814 100 58.7595 99.9079 58.4557 99.7242C58.1519 99.5401 58 99.2917 58 98.979C58 98.3263 58.6076 98 59.8228 98H62V98.8551C61.8312 99.2229 61.5387 99.5077 61.1223 99.7101Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M76.439 91.7263C75.6498 91.2723 74.751 91.0453 73.742 91.0453C73.0695 91.0453 72.449 91.1657 71.8797 91.406C71.3239 91.6462 70.8386 91.9996 70.4245 92.4674V87H68V101.86H70.3085V100.478C70.7091 100.985 71.2008 101.365 71.7829 101.619C72.3778 101.873 73.0311 102 73.742 102C74.751 102 75.6498 101.773 76.439 101.319C77.2409 100.865 77.8679 100.224 78.3205 99.3967C78.7737 98.5556 79 97.594 79 96.5127C79 95.4314 78.7737 94.4765 78.3205 93.6487C77.8679 92.8208 77.2409 92.1802 76.439 91.7263ZM76.1481 99.036C75.5933 99.6787 74.8803 100 74.0097 100C73.4418 100 72.9308 99.8601 72.4761 99.5803C72.022 99.2874 71.6624 98.8747 71.3972 98.3442C71.1326 97.813 71 97.1981 71 96.5C71 95.8012 71.1326 95.1863 71.3972 94.6558C71.6624 94.1247 72.022 93.7195 72.4761 93.4398C72.9308 93.1468 73.4418 93 74.0097 93C74.8803 93 75.5933 93.3213 76.1481 93.964C76.716 94.6066 77 95.4522 77 96.5C77 97.5478 76.716 98.3927 76.1481 99.036Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M81.4312 89.5803C81.7187 89.8605 82.075 90 82.5 90C82.9374 90 83.2937 89.8533 83.5688 89.5605C83.8563 89.2538 84 88.8804 84 88.4402C84 88.0264 83.8563 87.6867 83.5688 87.4204C83.2813 87.1401 82.925 87 82.5 87C82.075 87 81.7187 87.1467 81.4312 87.4402C81.1437 87.7198 81 88.0734 81 88.5003C81 88.9266 81.1437 89.2868 81.4312 89.5803ZM83 91H81V102H83V91Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M90.3459 102C89.5128 102 88.6988 101.896 87.9038 101.689C87.1089 101.482 86.4741 101.22 86 100.903L86.9233 99.1662C87.3847 99.4586 87.9356 99.6966 88.5768 99.8791C89.2307 100.05 89.8718 100.135 90.5003 100.135C91.9358 100.135 92.6539 99.7758 92.6539 99.0563C92.6539 98.7156 92.4677 98.4776 92.096 98.3435C91.7369 98.2094 91.1536 98.0813 90.3459 97.9599C89.5001 97.8379 88.8075 97.6977 88.2692 97.5394C87.7437 97.3806 87.2824 97.1063 86.8846 96.7167C86.5001 96.3144 86.3076 95.7598 86.3076 95.053C86.3076 94.127 86.7117 93.3894 87.5194 92.8409C88.3398 92.2803 89.4423 92 90.8269 92C91.5323 92 92.237 92.0791 92.9424 92.2374C93.6477 92.3836 94.2241 92.5848 94.6734 92.8409L93.7501 94.5776C92.8782 94.0901 91.8977 93.8467 90.8079 93.8467C90.1025 93.8467 89.5643 93.95 89.1925 94.1572C88.8335 94.3523 88.6537 94.6145 88.6537 94.9431C88.6537 95.3092 88.8462 95.5707 89.2307 95.7296C89.6285 95.8758 90.2372 96.0159 91.0576 96.1501C91.878 96.2715 92.5516 96.4116 93.0771 96.5705C93.6026 96.7288 94.0513 96.997 94.423 97.3745C94.8075 97.7527 95 98.2885 95 98.9832C95 99.8972 94.5831 100.629 93.7501 101.177C92.917 101.726 91.782 102 90.3459 102Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M1.23384 109.145L1.27615 110.133C1.85899 109.378 2.62045 109 3.56052 109C5.17274 109 5.9859 109.936 6 111.809V117H4.69565V111.802C4.69095 111.236 4.56404 110.817 4.31492 110.546C4.0705 110.275 3.68743 110.14 3.16569 110.14C2.74265 110.14 2.37133 110.256 2.05171 110.488C1.73208 110.721 1.48296 111.025 1.30435 111.403V117H0V109.145H1.23384Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M9.05231 116.845C9.75381 117.615 10.6637 118 11.7822 118C13.1648 118 14.2019 117.441 14.8932 116.323L14.0316 115.617C13.7723 115.971 13.4699 116.254 13.1242 116.468C12.7785 116.682 12.3566 116.788 11.8584 116.788C11.1569 116.788 10.5773 116.526 10.1198 116.002C9.66741 115.473 9.43099 114.78 9.41068 113.925H15V113.308C15 111.922 14.7026 110.859 14.1078 110.115C13.5131 109.372 12.6794 109 11.6068 109C10.9509 109 10.341 109.193 9.77668 109.578C9.2175 109.957 8.78028 110.487 8.46515 111.166C8.15507 111.839 8 112.607 8 113.468V113.741C8 115.035 8.35075 116.07 9.05231 116.845ZM10.6938 110.794C11.0676 110.264 11.5302 110 12.0812 110C12.6519 110 13.1046 110.252 13.4391 110.755C13.7737 111.252 13.9606 111.954 14 112.864V113H10C10.0886 112.051 10.3198 111.316 10.6938 110.794Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M16.8961 110.08C16.2987 110.795 16 111.76 16 112.974C16 114.241 16.2987 115.242 16.8961 115.976C17.4986 116.71 18.2848 117.078 19.2549 117.078C20.2353 117.078 21.0087 116.77 21.5755 116.156V116.826C21.5755 117.488 21.3815 118.001 20.9934 118.366C20.6105 118.731 20.0744 118.913 19.3851 118.913C18.5069 118.913 17.7641 118.56 17.1564 117.855L16.4212 118.654C16.7225 119.071 17.159 119.4 17.7309 119.64C18.3027 119.88 18.8873 120 19.4847 120C20.5569 120 21.4096 119.71 22.0427 119.129C22.6809 118.548 23 117.754 23 116.746V109.144H21.7057L21.6367 110.008C21.07 109.336 20.2812 109 19.2703 109C18.2848 109 17.4934 109.36 16.8961 110.08ZM18.5535 115.228C18.1845 114.708 18 113.995 18 113.089C18 112.069 18.187 111.3 18.5609 110.78C18.9348 110.26 19.4538 110 20.1181 110C20.9545 110 21.5818 110.384 22 111.151V114.819C21.5966 115.606 20.9644 116 20.1033 116C19.4391 116 18.9225 115.743 18.5535 115.228Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M30.2754 116.925C30.3277 117.363 30.3957 117.668 30.4792 117.84H32V117.711C31.8014 117.24 31.7021 116.607 31.7021 115.81V111.815C31.6812 110.939 31.3938 110.252 30.8399 109.754C30.2859 109.252 29.5203 109 28.5431 109C27.9264 109 27.3594 109.118 26.8421 109.353C26.3299 109.588 25.9224 109.909 25.6193 110.315C25.3214 110.717 25.1724 111.134 25.1724 111.567H26.6305C26.6305 111.187 26.8055 110.863 27.1556 110.597C27.5058 110.329 27.9395 110.195 28.4569 110.195C29.0474 110.195 29.4942 110.351 29.7973 110.66C30.1004 110.965 30.2519 111.377 30.2519 111.896V112.578H28.8409C27.6233 112.578 26.6775 112.829 26.0033 113.332C25.3344 113.829 25 114.53 25 115.433C25 116.177 25.2665 116.791 25.7996 117.278C26.3378 117.759 27.025 118 27.8611 118C28.7966 118 29.6013 117.641 30.2754 116.925ZM30.0681 116.649C29.6392 116.883 29.1855 117 28.7072 117C28.2068 117 27.7973 116.873 27.4784 116.618C27.1594 116.362 27 116.008 27 115.555C27 114.518 27.9347 114 29.8041 114H31V115.734C30.8075 116.109 30.4969 116.414 30.0681 116.649Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M34.5942 107V108.921H35.966V109.969H34.5942V114.889C34.5942 115.206 34.6553 115.446 34.7776 115.607C34.8998 115.763 35.1081 115.841 35.4023 115.841C35.5472 115.841 35.7464 115.812 36 115.754V116.853C35.6695 116.951 35.348 117 35.0357 117C34.4743 117 34.0509 116.817 33.7657 116.45C33.4805 116.083 33.3379 115.563 33.3379 114.889V109.969H32V108.921H33.3379V107H34.5942Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M38.2466 106.293C38.0822 106.488 38 106.727 38 107.01C38 107.293 38.0822 107.528 38.2466 107.717C38.417 107.906 38.6666 108 38.9954 108C39.3242 108 39.5739 107.906 39.7443 107.717C39.9148 107.528 40 107.293 40 107.01C40 106.727 39.9148 106.488 39.7443 106.293C39.5739 106.098 39.3242 106 38.9954 106C38.6666 106 38.417 106.098 38.2466 106.293ZM38 117H40V109H38V117Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M44.5266 115.144L46.5635 109H48L45.051 117H43.9793L41 109H42.4365L44.5266 115.144Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M50.0523 116.845C50.7538 117.615 51.6638 118 52.7822 118C54.1648 118 55.2019 117.441 55.8933 116.323L55.0316 115.617C54.7724 115.971 54.4699 116.254 54.1242 116.468C53.7785 116.682 53.3566 116.788 52.8584 116.788C52.1569 116.788 51.5773 116.526 51.1199 116.002C50.6674 115.473 50.4311 114.78 50.4107 113.925H56V113.308C56 111.922 55.7026 110.859 55.1079 110.115C54.5131 109.372 53.6794 109 52.6068 109C51.951 109 51.341 109.193 50.7767 109.578C50.2175 109.957 49.7803 110.487 49.4651 111.166C49.1551 111.839 49 112.607 49 113.468V113.741C49 115.035 49.3508 116.07 50.0523 116.845ZM51.6938 110.794C52.0677 110.264 52.5302 110 53.0812 110C53.6519 110 54.1046 110.252 54.4392 110.755C54.7737 111.252 54.9607 111.954 55 112.864V113H51C51.0886 112.051 51.3198 111.316 51.6938 110.794Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M64.7092 115.537C64.7092 115.136 64.5769 114.826 64.3118 114.607C64.0515 114.382 63.5933 114.19 62.9373 114.029C62.2861 113.869 61.7675 113.677 61.3814 113.452C61 113.227 60.7163 112.96 60.5302 112.649C60.3488 112.34 60.2582 111.971 60.2582 111.543C60.2582 110.832 60.5186 110.23 61.0396 109.738C61.5651 109.246 62.235 109 63.0489 109C63.9048 109 64.598 109.254 65.1282 109.762C65.6627 110.27 65.9303 110.92 65.9303 111.712H64.6328C64.6328 111.305 64.4813 110.955 64.1789 110.66C63.8813 110.366 63.505 110.219 63.0489 110.219C62.5791 110.219 62.2117 110.337 61.9466 110.572C61.6814 110.807 61.5488 111.115 61.5488 111.495C61.5488 111.853 61.6722 112.123 61.9187 112.305C62.1652 112.486 62.6094 112.661 63.2512 112.826C63.8976 112.992 64.4212 113.19 64.821 113.419C65.2208 113.65 65.5166 113.928 65.7072 114.254C65.9026 114.575 66 114.968 66 115.433C66 116.208 65.7307 116.831 65.1908 117.302C64.6515 117.767 63.9511 118 63.0907 118C62.4861 118 61.9512 117.877 61.4861 117.631C61.0209 117.385 60.6558 117.043 60.3907 116.604C60.1302 116.16 60 115.682 60 115.168H61.2907C61.314 115.666 61.4861 116.061 61.807 116.356C62.1326 116.645 62.5605 116.788 63.0907 116.788C63.5789 116.788 63.9697 116.676 64.2631 116.452C64.5607 116.222 64.7092 115.917 64.7092 115.537Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M74.1348 116.036C74.7116 115.307 75 114.346 75 113.152V113.029C75 111.764 74.709 110.775 74.1269 110.065C73.5501 109.355 72.7635 109 71.7683 109C70.7421 109 69.9402 109.338 69.3634 110.015L69.2941 109.145H68V120H69.4169V116.225C69.9937 116.829 70.785 117.131 71.7907 117.131C72.7767 117.131 73.5574 116.766 74.1348 116.036ZM73.4266 110.781C73.8086 111.302 74 112.012 74 112.912C74 113.934 73.8061 114.705 73.419 115.226C73.0369 115.742 72.5199 116 71.8679 116C71.0296 116 70.4068 115.637 70 114.909V111.098C70.4118 110.367 71.0296 110 71.8527 110C72.5199 110 73.0439 110.26 73.4266 110.781Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M81.2755 116.925C81.3275 117.363 81.3957 117.668 81.4795 117.84H83V117.711C82.8014 117.24 82.7021 116.607 82.7021 115.81V111.815C82.6812 110.939 82.3934 110.252 81.8395 109.754C81.2856 109.252 80.5203 109 79.5429 109C78.9262 109 78.3595 109.118 77.842 109.353C77.33 109.588 76.922 109.909 76.6194 110.315C76.3215 110.717 76.1722 111.134 76.1722 111.567H77.6306C77.6306 111.187 77.8056 110.863 78.1555 110.597C78.5054 110.329 78.9397 110.195 79.4571 110.195C80.0475 110.195 80.494 110.351 80.7973 110.66C81.1005 110.965 81.2519 111.377 81.2519 111.896V112.578H79.8408C78.6236 112.578 77.6772 112.829 77.0031 113.332C76.3344 113.829 76 114.53 76 115.433C76 116.177 76.2661 116.791 76.7998 117.278C77.3375 117.759 78.0251 118 78.8613 118C79.7962 118 80.6014 117.641 81.2755 116.925ZM80.3012 116.649C79.9792 116.883 79.6391 117 79.2804 117C78.9051 117 78.5981 116.873 78.3587 116.618C78.1194 116.362 78 116.008 78 115.555C78 114.518 78.701 114 80.1029 114H81V115.734C80.8555 116.109 80.6226 116.414 80.3012 116.649Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M87.6997 116.788C88.2063 116.788 88.6488 116.628 89.0271 116.307C89.4061 115.987 89.6157 115.586 89.6567 115.104H91C90.9742 115.602 90.8108 116.075 90.5086 116.524C90.207 116.973 89.8029 117.332 89.2963 117.599C88.7943 117.866 88.2626 118 87.6997 118C86.5688 118 85.668 117.607 84.998 116.821C84.3327 116.029 84 114.949 84 113.581V113.332C84 112.486 84.1488 111.735 84.4451 111.078C84.7421 110.42 85.1667 109.909 85.7196 109.545C86.2771 109.182 86.9345 109 87.6918 109C88.623 109 89.3955 109.292 90.0099 109.874C90.629 110.457 90.959 111.214 91 112.144H89.6567C89.6157 111.583 89.4114 111.123 89.043 110.765C88.6792 110.401 88.2295 110.219 87.6918 110.219C86.9702 110.219 86.4101 110.492 86.0112 111.038C85.6171 111.577 85.42 112.361 85.42 113.388V113.668C85.42 114.668 85.6171 115.438 86.0112 115.978C86.4048 116.519 86.9676 116.788 87.6997 116.788Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M93.0527 116.845C93.7538 117.615 94.6639 118 95.7822 118C97.1654 118 98.2023 117.441 98.8936 116.323L98.0321 115.617C97.7726 115.971 97.4703 116.254 97.1247 116.468C96.779 116.682 96.3565 116.788 95.8584 116.788C95.1573 116.788 94.5778 116.526 94.1198 116.002C93.6677 115.473 93.4311 114.78 93.4108 113.925H99V113.308C99 111.922 98.703 110.859 98.1083 110.115C97.513 109.372 96.6798 109 95.6068 109C94.951 109 94.3412 109.193 93.7768 109.578C93.2176 109.957 92.7806 110.487 92.4652 111.166C92.1551 111.839 92 112.607 92 113.468V113.741C92 115.035 92.3509 116.07 93.0527 116.845ZM94.6938 110.794C95.0677 110.264 95.53 110 96.0808 110C96.6518 110 97.1046 110.252 97.4391 110.755C97.7736 111.252 97.9606 111.954 98 112.864V113H94C94.0884 112.051 94.3199 111.316 94.6938 110.794Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M79.8083 12.1551C82.7057 15.053 85.081 18.2752 86.9425 21.7031C90.8131 27.5454 92.3007 34.2618 91.9504 40.9196C92.1005 51.7335 88.0551 62.5937 79.8083 70.8446C63.6096 87.0518 37.347 87.0518 21.1485 70.8446C4.95105 54.638 4.94994 28.362 21.1485 12.1551C37.347 -4.05171 63.6096 -4.05171 79.8083 12.1551ZM47.9678 4.01434C39.213 4.55561 30.6134 8.15273 23.9232 14.8112C9.35893 29.3066 9.35893 52.8075 23.9232 67.3027C26.3944 69.7626 29.1247 71.8015 32.0278 73.4269C37.6258 76.3824 43.2127 76.984 46.57 74.2204C49.5335 71.7814 49.4149 67.4232 49.2974 63.1026C49.2745 62.2604 49.2516 61.4197 49.2516 60.5949C48.8273 66.3545 44.3824 70.2872 39.9364 71.1305C40.5013 67.4781 41.7717 62.7026 47.558 59.7526C46.8771 60.0347 46.1375 60.3596 45.3502 60.7053C39.2344 63.3915 30.2399 67.3419 23.5189 62.3609C28.6462 57.7859 37.6103 55.2758 47.558 57.5048C34.2907 52.8692 26.1053 49.3581 19.7264 33.9532C36.6899 37.1369 41.9123 44.3014 48.4043 55.3981C38.101 36.2947 41.4815 17.9684 51.0626 7.63902C54.1085 14.5224 55.7434 27.5152 54.6147 37.9803C54.022 43.4752 53.101 47.9643 52.3169 51.7861C51.9568 53.5415 51.6255 55.156 51.3682 56.6626C50.1687 63.6857 53.4141 68.5323 61.79 71.1305C61.2251 67.4781 59.9547 62.7026 54.1684 59.7526C54.8493 60.0347 55.589 60.3596 56.3763 60.7054C62.4921 63.3915 71.4862 67.3419 78.2072 62.3609C73.0799 57.7859 64.1161 55.2758 54.1684 57.5048C67.4355 52.8692 75.6214 49.3581 82 33.9532C65.0368 37.1369 59.814 44.3014 53.3221 55.3981C55.6958 50.8067 62.2098 29.2074 54.7964 8.40516C53.7951 5.59517 50.9917 3.83575 48.0011 4.01214C47.9899 4.01324 47.9789 4.01434 47.9678 4.01434Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                    </svg>-->
        <!--                </li>-->
        <!--                <li class="partners_list-item d-flex justify-content-center swiper-slide">-->
        <!--                    <svg width="153" height="120" viewBox="0 0 153 120" fill="none" xmlns="http://www.w3.org/2000/svg">-->
        <!--                        <path-->
        <!--                            d="M17 112.59C16.727 114.958 15.8627 116.787 14.4067 118.079C12.961 119.36 11.0351 120 8.6289 120C6.02052 120 3.92774 119.052 2.35058 117.156C0.783527 115.26 0 112.723 0 109.545V107.393C0 105.313 0.363961 103.483 1.09189 101.905C1.82992 100.326 2.87124 99.1164 4.21588 98.276C5.56051 97.4253 7.11745 97 8.88671 97C11.2322 97 13.1127 97.6667 14.5281 98.9992C15.9435 100.321 16.7674 102.155 17 104.503H14.0731C13.8204 102.719 13.2694 101.428 12.4202 100.629C11.581 99.8293 10.4032 99.4297 8.88671 99.4297C7.02647 99.4297 5.56557 100.126 4.50402 101.52C3.45257 102.915 2.92685 104.897 2.92685 107.47V109.638C2.92685 112.067 3.4273 113.999 4.42819 115.434C5.42909 116.869 6.82933 117.587 8.6289 117.587C10.2465 117.587 11.485 117.218 12.3444 116.479C13.2138 115.731 13.7901 114.435 14.0731 112.59H17Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M25.2303 113.997H34.7541L36.9242 120H40L31.3036 97H28.6807L20 120H23.0913L25.2303 113.997ZM34 111H26L29.9919 100L34 111Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M60 120H57.0679L45.9321 102.277V120H43V97H45.9321L57.0984 114.803V97H60V120Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M82 120H79.068L67.9321 102.277V120H65V97H67.9321L79.0983 114.803V97H82V120Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M91.23 113.997H100.754L102.924 120H106L97.304 97H94.6811L86 120H89.0912L91.23 113.997ZM100 111H92L95.9924 100L100 111Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M109 120V97H116.205C118.597 97 120.392 97.5162 121.594 98.5485C122.804 99.5808 123.409 101.107 123.409 103.13C123.409 104.203 123.117 105.156 122.531 105.988C121.947 106.81 121.15 107.447 120.14 107.9C121.331 108.247 122.269 108.911 122.955 109.891C123.652 110.859 124 112.018 124 113.366C124 115.429 123.359 117.052 122.077 118.231C120.796 119.41 118.985 120 116.644 120H109ZM111 109V118H115.708C117.035 118 118.079 117.604 118.842 116.815C119.614 116.013 120 114.914 120 113.517C120 110.506 118.584 109 115.753 109H111ZM115.092 108H111V100H115.007C116.352 100 117.354 100.316 118.013 100.95C118.671 101.573 119 102.575 119 103.957C119 105.201 118.643 106.186 117.928 106.912C117.223 107.637 116.277 108 115.092 108Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path d="M132 120H129V97H132V120Z" fill="currentColor" />-->
        <!--                        <path-->
        <!--                            d="M144.834 109.715C142.344 108.987 140.529 108.096 139.39 107.04C138.26 105.973 137.696 104.662 137.696 103.104C137.696 101.341 138.386 99.8849 139.768 98.7373C141.159 97.5794 142.963 97 145.181 97C146.694 97 148.04 97.297 149.219 97.8918C150.409 98.4865 151.327 99.3064 151.971 100.351C152.627 101.397 152.955 102.54 152.955 103.781H150.036C150.036 102.428 149.613 101.366 148.766 100.598C147.919 99.8191 146.724 99.4297 145.181 99.4297C143.75 99.4297 142.631 99.7523 141.824 100.398C141.028 101.033 140.63 101.92 140.63 103.057C140.63 103.97 141.008 104.743 141.764 105.379C142.53 106.004 143.825 106.578 145.65 107.101C147.485 107.624 148.917 108.203 149.945 108.838C150.984 109.463 151.75 110.197 152.244 111.037C152.748 111.877 153 112.867 153 114.004C153 115.818 152.305 117.274 150.913 118.371C149.522 119.457 147.661 120 145.333 120C143.82 120 142.409 119.708 141.099 119.124C139.788 118.53 138.775 117.72 138.059 116.695C137.354 115.67 137 114.507 137 113.205H139.919C139.919 114.558 140.408 115.629 141.386 116.418C142.374 117.197 143.69 117.587 145.333 117.587C146.865 117.587 148.04 117.269 148.857 116.633C149.673 115.997 150.081 115.131 150.081 114.035C150.081 112.938 149.704 112.092 148.947 111.498C148.191 110.893 146.82 110.299 144.834 109.715Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M117.336 75.4805C113.947 72.739 109.089 70.6709 103.459 69.4704C101.721 71.1334 99.9223 72.7175 98.0849 74.1984C102.809 74.7663 107.112 75.9621 110.448 77.6372C105.676 80.0335 98.9222 81.4498 91.7979 81.4498C86.9092 81.4498 82.1954 80.7812 78.1775 79.5902C85.6943 76.7841 93.766 71.3755 100.95 64.1768C110.833 54.2751 117.336 42.6887 118.347 33.1824L118.711 29.7699L115.305 30.1342C107.197 30.9993 97.5715 35.8854 88.7769 43.4699C88.7267 46.1658 88.5621 48.845 88.292 51.4785C95.8588 43.8989 104.655 38.3729 112.129 36.3671C110.125 43.8581 104.608 52.6767 97.0398 60.2588C90.3225 66.9926 82.633 72.1016 75.7595 74.5698C80.2007 66.0244 82.7502 54.2631 82.7502 41.6319C82.7502 25.6817 78.6844 11.1167 71.8779 2.66954L69.7254 0L67.573 2.66954C60.7975 11.076 56.7413 25.5404 56.7006 41.3946C57.4923 42.1304 58.272 42.8805 59.0397 43.6472C60.202 44.8143 61.3284 46.0101 62.4119 47.2322C62.2923 45.3894 62.2325 43.5059 62.2325 41.6343C62.2325 28.9695 65.0498 16.9998 69.7254 9.2523C74.4011 16.9998 77.2184 28.9719 77.2184 41.6343C77.2184 53.144 74.8913 64.081 70.9571 71.7949C68.3311 63.8725 62.7132 55.2168 55.0791 47.5677C45.1969 37.666 33.6334 31.1503 24.1459 30.1366L20.7402 29.7724L21.1038 33.1847C22.0771 42.346 28.1542 53.4412 37.4409 63.0961C39.6603 62.8612 41.9276 62.739 44.202 62.739C44.4747 62.739 44.7449 62.7414 45.0152 62.7462C44.1327 61.9434 43.2597 61.1095 42.4107 60.2588C34.8412 52.6767 29.3261 43.8581 27.322 36.3671C34.7981 38.3753 43.5993 43.9037 51.1664 51.4857C57.8606 58.1932 62.9499 65.8663 65.4229 72.7342C59.8384 69.9042 52.2833 68.2818 44.202 68.2818C33.7841 68.2818 24.2391 70.9729 18.6667 75.4829L16 77.6396L18.6667 79.7963C24.2391 84.3038 33.7865 86.9974 44.202 86.9974C50.8675 86.9974 57.2459 85.8926 62.4644 83.8605C60.7472 82.5929 57.906 81.3443 54.2565 80.4865C51.1186 81.1215 47.7177 81.4546 44.202 81.4546C37.0773 81.4546 30.3234 80.0384 25.5521 77.6419C30.3234 75.2456 37.0773 73.8294 44.202 73.8294C53.2591 73.8294 61.7111 76.1179 66.2624 79.7987C71.8348 84.3063 81.3822 87 91.8005 87C102.218 87 111.763 84.3087 117.336 79.7987L120 77.6419L117.336 75.4805Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                    </svg>-->
        <!--                </li>-->
        <!--                <li class="partners_list-item d-flex justify-content-center swiper-slide">-->
        <!--                    <svg width="68" height="120" viewBox="0 0 68 120" fill="none" xmlns="http://www.w3.org/2000/svg">-->
        <!--                        <path-->
        <!--                            d="M4.30435 109.189C4.88249 108.469 5.63456 108.108 6.56055 108.108C8.17273 108.108 8.98594 109.032 9 110.88V116H7.69565V110.873C7.69094 110.314 7.56404 109.901 7.31496 109.633C7.07052 109.366 6.68745 109.232 6.16568 109.232C5.74266 109.232 5.37133 109.347 5.05171 109.576C4.73208 109.805 4.48297 110.106 4.30435 110.479V116H3V105H4.30435V109.189Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M11.4406 111.126C11.1469 111.805 11 112.569 11 113.42V113.524C11 114.871 11.3222 115.955 11.9665 116.772C12.6156 117.591 13.4612 118 14.5036 118C15.1953 118 15.8064 117.813 16.3371 117.438C16.8724 117.064 17.2822 116.543 17.5665 115.874C17.8555 115.2 18 114.441 18 113.596V113.492C18 112.133 17.6754 111.045 17.0264 110.227C16.382 109.409 15.5364 109 14.4893 109C13.8119 109 13.2078 109.185 12.6772 109.554C12.1513 109.922 11.7391 110.447 11.4406 111.126ZM13.5407 115.201C13.1803 114.669 13 113.963 13 113.084C13 112.093 13.1824 111.331 13.5473 110.799C13.9121 110.266 14.392 110 14.987 110C15.595 110 16.0814 110.271 16.4462 110.813C16.8154 111.351 17 112.054 17 112.923C17 113.895 16.8198 114.652 16.4593 115.194C16.0988 115.731 15.6124 116 15 116C14.392 116 13.9056 115.734 13.5407 115.201Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path d="M22 116H20V105H22V116Z" fill="currentColor" />-->
        <!--                        <path-->
        <!--                            d="M25.5836 114.873L27.4968 109H29L25.6974 118.045C25.1862 119.348 24.3738 120 23.2603 120L22.9946 119.979L22.4708 119.884V118.798L22.8503 118.827C23.3262 118.827 23.6956 118.735 23.9588 118.552C24.2271 118.368 24.4472 118.032 24.6193 117.545L24.9306 116.748L22 109H23.5336L25.5836 114.873Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M35.3043 109.189C35.8825 108.469 36.6345 108.108 37.5605 108.108C39.1727 108.108 39.9859 109.032 40 110.88V116H38.6957V110.873C38.691 110.314 38.5641 109.901 38.3149 109.633C38.0705 109.366 37.6874 109.232 37.1657 109.232C36.7427 109.232 36.3713 109.347 36.0517 109.576C35.7321 109.805 35.4829 110.106 35.3043 110.479V116H34V105H35.3043V109.189Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M43.0523 116.845C43.7538 117.615 44.6637 118 45.7821 118C47.1649 118 48.2019 117.441 48.8932 116.323L48.0316 115.618C47.7723 115.97 47.4699 116.254 47.1242 116.468C46.7785 116.682 46.3566 116.789 45.8584 116.789C45.1568 116.789 44.5773 116.526 44.1198 116.003C43.6674 115.473 43.431 114.781 43.4107 113.925H49V113.307C49 111.922 48.7026 110.858 48.1078 110.115C47.513 109.372 46.6794 109 45.6068 109C44.951 109 44.3409 109.193 43.7767 109.578C43.2175 109.957 42.7803 110.487 42.4651 111.166C42.1551 111.839 42 112.607 42 113.468V113.74C42 115.035 42.3508 116.069 43.0523 116.845ZM44.6938 110.794C45.0677 110.265 45.5301 110 46.0812 110C46.6519 110 47.1045 110.252 47.4391 110.755C47.7736 111.251 47.9607 111.955 48 112.865V113H44C44.0886 112.052 44.3198 111.317 44.6938 110.794Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M53 110.351C52.8394 110.317 52.6654 110.3 52.478 110.3C51.782 110.3 51.3097 110.675 51.0612 111.425V117H50V109.146H51.0325L51.0497 110.053C51.3977 109.351 51.891 109 52.5297 109C52.7361 109 52.8929 109.034 53 109.102V110.351Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M61.1284 114.939C61.7091 114.227 62 113.288 62 112.119V112.006C62 110.785 61.7122 109.824 61.136 109.122C60.5655 108.419 59.7786 108.068 58.775 108.068C57.7714 108.068 56.9842 108.396 56.4137 109.051V105H55V115.858H56.2991L56.3679 114.975C56.9384 115.658 57.7459 116 58.7903 116C59.7684 116 60.5478 115.646 61.1284 114.939ZM60.4651 109.765C60.8213 110.275 61 110.997 61 111.933C61 112.958 60.8189 113.725 60.4579 114.235C60.0963 114.745 59.5908 115 58.9413 115C58.0622 115 57.4151 114.579 57 113.738V110.262C57.3907 109.421 58.0329 109 58.9267 109C59.5957 109 60.1085 109.255 60.4651 109.765Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M64 117.018C64 116.727 64.081 116.485 64.2429 116.291C64.4113 116.097 64.6607 116 64.991 116C65.3214 116 65.5708 116.097 65.7392 116.291C65.9126 116.485 66 116.727 66 117.018C66 117.297 65.9126 117.531 65.7392 117.718C65.5708 117.906 65.3214 118 64.991 118C64.6607 118 64.4113 117.906 64.2429 117.718C64.081 117.531 64 117.297 64 117.018Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M24.6155 100C24.5799 99.1088 24.5355 97.9973 24.5355 97.865L24.571 97.6708C24.8465 95.6241 25.0242 91.3279 25.0331 90.0311C25.0864 83.9878 23.4693 79.5589 23.4515 79.5148C22.2075 76.03 23.7713 71.2484 25.273 67.4729C26.4814 64.4378 28.8361 55.2628 29.1472 52.3691C29.1738 52.1045 29.3337 51.8751 29.5647 51.7516C29.6803 51.6898 29.8135 51.6634 29.9379 51.6634C30.0712 51.6634 30.2045 51.6986 30.32 51.7604C30.8887 52.0603 31.3596 52.4574 31.7062 52.9426C32.417 53.913 33.0656 55.6774 32.1416 58.5535C32.0172 58.9328 31.9283 59.5416 31.9016 59.9473C31.8839 60.0444 31.7417 60.4765 31.6084 60.8649C31.3152 61.756 30.942 62.8676 30.8798 63.5026C30.862 63.6527 30.9331 63.8028 31.0486 63.891C31.1286 63.9524 31.2264 63.9792 31.3152 63.9792C31.3685 63.9792 31.4218 63.9702 31.4752 63.9524C33.1812 63.3084 34.6829 62.6293 35.9535 61.9145C36.2556 61.7471 36.5755 61.65 36.9131 61.6321C37.3841 61.6059 38.3348 61.5529 39.4189 61.5529H39.5343C39.7209 61.5529 39.8898 61.4385 39.952 61.2616C40.2363 60.4682 40.6361 58.4829 40.8849 57.0272C40.9116 56.8508 40.8405 56.6743 40.6895 56.5773C39.5255 55.8451 38.3081 55.3069 37.0641 54.9805C35.9001 54.6805 35.1093 54.1424 34.7006 53.3925C34.1675 52.4132 34.5051 51.4075 34.5051 51.3987C36.0601 51.5486 39.872 51.9192 41.5692 52.1486C41.5869 52.1486 41.6136 52.1486 41.6313 52.1486C41.8535 52.1486 42.0401 51.9898 42.0667 51.7692C42.1378 51.2928 42.12 50.887 42.0134 50.5165L41.8979 50.093C41.7824 49.6519 41.6491 49.1755 41.4625 48.6285C41.2049 47.8786 41.0627 47.1817 41.0271 46.5465C40.9205 44.2616 42.4311 43.2293 43.2485 43C44.2437 45.3908 46.1718 50.0666 46.314 50.6488C46.4118 51.0635 46.3229 52.8103 46.0652 55.0951C46.0475 55.2363 46.1097 55.3863 46.2163 55.4745C46.8827 56.048 47.6469 56.7008 48.5621 57.4948C48.8997 57.7859 49.0597 58.2359 48.9797 58.677L47.9578 64.2877C47.7624 65.3904 47.6025 66.5728 47.4692 67.9048C47.4425 68.1782 47.3981 68.4343 47.327 68.6726C47.1493 69.2987 46.7139 69.6781 46.3762 69.8813C46.2163 69.9784 46.1363 70.1636 46.1719 70.3489L46.2163 70.5604C46.2518 70.7194 46.2874 70.8868 46.314 71.0542C46.3673 71.3723 46.2518 71.7071 45.9941 71.9191L42.902 74.5038C42.2 75.3068 41.2226 76.5065 40.263 77.9356C39.6943 78.7737 39.1345 79.6828 38.5836 80.5733C37.5884 82.1793 36.6466 83.7055 35.7313 84.764C35.4647 85.0815 35.2959 85.4878 35.1982 86.0876C34.9849 87.3845 35.909 97.3974 36.1489 99.9738H24.6155V100Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M42.6676 42.0138C42.7037 42.0064 42.7353 42 42.7733 42C42.9428 42 43.1123 42.0973 43.1837 42.2389C43.4869 42.9555 46.1095 49.2367 46.2879 49.9799C46.4574 50.6876 46.163 53.5805 46.0559 54.5891C46.2451 54.7517 46.4422 54.9207 46.6483 55.0974C47.171 55.5457 47.7519 56.044 48.4109 56.615C48.8658 57.0043 49.0799 57.6147 48.9729 58.2075L47.9471 63.8341C47.7508 64.9225 47.5902 66.0987 47.4653 67.426C47.4386 67.7265 47.3851 68.0097 47.3137 68.2749C47.0996 69.0712 46.5288 69.5317 46.163 69.7527L46.1641 69.7575C46.2172 69.9948 46.2704 70.2322 46.3146 70.469C46.4038 70.9469 46.2165 71.4337 45.8419 71.7521L42.7376 74.344C42.1221 75.0609 41.132 76.264 40.1687 77.697C39.7078 78.3716 39.247 79.112 38.791 79.8445C38.691 80.0052 38.5912 80.1656 38.4917 80.3248C37.4837 81.9526 36.5292 83.492 35.5926 84.5887C35.3696 84.8456 35.2358 85.1903 35.1555 85.7034C34.9325 87.0923 36.1635 100 36.1635 100H30.6151H28.2424H23.6307C23.6307 100 23.5236 97.4785 23.5414 97.3901L23.5771 97.1602C23.8358 95.1698 24.0231 90.9411 24.0321 89.5606C24.0945 83.5452 22.4978 79.2185 22.48 79.1743C21.1776 75.5298 22.7743 70.6374 24.3086 66.7803C25.5485 63.6573 27.8677 54.4918 28.1621 51.7493C28.2067 51.3423 28.4565 50.9796 28.8222 50.7849C29.0095 50.6876 29.2058 50.6434 29.4109 50.6434C29.6161 50.6434 29.8213 50.6965 30.0086 50.7938C30.6419 51.13 31.1593 51.5723 31.5518 52.112C32.3278 53.1648 33.0325 55.0756 32.0513 58.1278C31.9442 58.4728 31.855 59.0567 31.8283 59.4283C31.8184 59.5426 31.6882 59.9318 31.5234 60.4245C31.2417 61.2665 30.8588 62.4109 30.8025 63.0026C32.1494 62.4984 33.7551 61.8168 35.2358 60.9943C35.6015 60.7906 35.985 60.6759 36.3865 60.649C36.9306 60.6138 37.8851 60.5696 38.9465 60.5696H39.0447C39.3212 59.8002 39.7226 57.7828 39.9635 56.3938C38.9555 55.7657 37.7602 55.1995 36.4489 54.8545C35.1555 54.5271 34.2635 53.9167 33.7907 53.0497C33.1663 51.8996 33.5499 50.7407 33.5677 50.6965C33.6301 50.5195 33.7996 50.3956 33.987 50.3956H34.0316C34.2377 50.4162 34.4691 50.4391 34.7199 50.4639C36.6292 50.6531 39.6587 50.9532 41.1409 51.1565C41.1945 50.7938 41.2034 50.4311 41.1053 50.086L40.9893 49.6614C40.9716 49.598 40.9537 49.5332 40.9355 49.467C40.8338 49.0986 40.7199 48.6856 40.5611 48.2282C40.2846 47.4408 40.133 46.6977 40.0972 46.0165C39.9724 43.4509 41.7119 42.2831 42.6484 42.0177C42.655 42.0164 42.6613 42.0151 42.6676 42.0138ZM45.3426 50.1766C45.2542 49.7794 44.0873 46.8575 42.4873 43C41.9126 43.3002 40.8695 44.1123 40.9491 45.9484C40.9756 46.5397 41.117 47.2018 41.3557 47.908C41.525 48.392 41.6407 48.8224 41.7436 49.2053C41.7589 49.2623 41.774 49.3183 41.7889 49.3733L41.9126 49.8323C42.0276 50.2472 42.0541 50.715 41.9745 51.2535C41.9126 51.6949 41.5325 52.0127 41.0994 52.0127C41.0552 52.0127 41.0198 52.0127 40.9756 52.0038C39.4198 51.792 36.0871 51.4566 34.3632 51.2888C34.3279 51.6066 34.3279 52.1098 34.5931 52.5953C34.9379 53.2308 35.6362 53.6899 36.6705 53.9635C37.9523 54.2989 39.2076 54.855 40.401 55.6142C40.7015 55.7996 40.8607 56.1527 40.7988 56.5058C40.7458 56.8323 40.2419 59.7456 39.8529 60.8221C39.7292 61.1755 39.3932 61.405 39.022 61.405H38.9247C37.8568 61.405 36.9123 61.4579 36.443 61.4842L36.4407 61.4843C36.1843 61.5022 35.9279 61.5814 35.6804 61.7138C34.3897 62.4379 32.8693 63.1353 31.1631 63.7796C31.0571 63.8237 30.951 63.841 30.8449 63.841C30.6504 63.841 30.4648 63.7796 30.3056 63.6646C30.0582 63.4792 29.9344 63.1794 29.9609 62.879C30.0228 62.2526 30.3321 61.2727 30.7035 60.1515C30.7292 60.0722 30.7566 59.9886 30.7837 59.9057C30.8682 59.6475 30.9507 59.3954 30.9775 59.2952C31.0128 58.8715 31.1012 58.2447 31.2339 57.8299C32.1002 55.1375 31.5167 53.5045 30.8714 52.6129C30.562 52.1892 30.1554 51.8361 29.6427 51.5625C29.5896 51.536 29.5277 51.5184 29.4658 51.5184C29.4128 51.5184 29.3509 51.536 29.2979 51.5625C29.1918 51.6155 29.1211 51.7214 29.1122 51.8361C28.794 54.7491 26.4426 64.0001 25.2314 67.0632C23.764 70.7705 22.2346 75.4488 23.4281 78.8122C23.4282 78.8127 23.4289 78.8147 23.4301 78.818C23.4956 79.0009 25.0713 83.4 25.0193 89.4759C25.0105 90.7819 24.8337 95.1073 24.5596 97.1642L24.5331 97.3585C24.5419 97.5439 24.5684 98.2323 24.595 99H28.3166H30.6681H35.1942C34.876 95.5931 34.0892 86.7568 34.2925 85.4771C34.3986 84.7881 34.5931 84.3119 34.9202 83.9322C35.8042 82.8903 36.7324 81.3901 37.7136 79.7921C37.7766 79.6898 37.8405 79.5858 37.9051 79.4806C38.3759 78.714 38.888 77.8802 39.3933 77.135C40.3657 75.6872 41.3469 74.4779 42.001 73.7102C42.0249 73.6804 42.0488 73.6585 42.0727 73.6366C42.0842 73.626 42.0957 73.6155 42.1072 73.6041L45.1835 71.0179C45.3161 70.9028 45.3779 70.7264 45.3514 70.5679C45.3249 70.4087 45.2896 70.2496 45.2542 70.091L45.21 69.8789C45.1305 69.5171 45.2895 69.1463 45.6078 68.952C45.873 68.7845 46.2266 68.4841 46.3593 67.999C46.4211 67.7868 46.4564 67.5489 46.483 67.3016C46.6067 65.9599 46.7659 64.7678 46.9692 63.6473L47.9858 58.0329C48.0389 57.7504 47.9416 57.4502 47.7206 57.2649C47.0676 56.6952 46.492 56.1981 45.9741 55.7509C45.7698 55.5745 45.5744 55.4058 45.3868 55.2435C45.1658 55.0492 45.0509 54.7668 45.0862 54.4755C45.3603 51.9597 45.4133 50.4856 45.3426 50.1766Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M30.5452 66.0744C30.5452 66.0744 28.7804 66.8157 28 64.4595C28 64.4595 32.1414 63.3124 35.6356 61.3619C35.9282 61.1939 36.2564 61.0974 36.5845 61.0795C37.6842 61.0086 40.3091 60.9031 42.136 61.1856C42.4996 61.2386 42.81 61.4591 42.9873 61.7767C44.1491 63.9387 45.3996 67.2305 45.9848 70.5229C46.0469 70.8494 45.9139 71.176 45.6656 71.3875L42.5529 74"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M46.0327 70C46.0327 70 46.9996 69.6224 47.2824 68.6242C47.3554 68.3546 47.401 68.0844 47.4284 67.8416C47.5469 66.6097 47.702 65.3784 47.9301 64.1549L48.9792 58.4363C49.0613 57.9867 48.8971 57.5281 48.5504 57.2314C46.954 55.8646 42.475 52.034 42.1192 51.8902C41.6813 51.7283 34.1097 51 34.1097 51C34.1097 51 33.1793 53.7335 36.737 54.6507C40.395 55.5949 43.3233 58.2654 43.8524 59.5423C44.1079 60.1538 43.3781 62.5454 43.3781 62.5454"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M41.9052 51.9592C42.0301 51.504 42.0884 50.937 41.9218 50.3186C41.7886 49.8203 41.647 49.2019 41.4138 48.4803C41.1557 47.7072 41.0307 47.0287 41.0058 46.4531C40.8726 43.6442 43.0877 43 43.0877 43C43.0877 43 45.7941 49.7344 45.9607 50.4474C46.1272 51.1604 45.7108 55 45.7108 55"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M41 57C41 57 40.3871 61.1922 40 62"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M31.0029 63.6045C31.4232 61.7267 32.081 60.3179 32.1541 59.3167C32.1815 58.918 32.2729 58.2979 32.4008 57.9169C33.3144 55.135 32.7662 53.3719 31.9531 52.2822C31.5329 51.7152 30.9938 51.3431 30.5279 51.095C30.0071 50.8292 29.3767 51.1481 29.3128 51.7152C28.9747 54.7629 26.6175 63.7289 25.3385 66.8827C23.7853 70.7101 22.1865 75.4857 23.4656 78.9852C23.4656 78.9852 25.1466 83.3618 25.0918 89.5456C25.0736 91.1667 24.8725 95.3399 24.6167 97.2183L24.2056 99.5125L37.0511 100C37.0511 100 35.2605 87.4991 35.5711 85.6117C35.6533 85.1247 35.7904 84.6551 36.1193 84.283C37.5811 82.5997 39.1799 79.7294 40.7787 77.4257C41.9207 75.7692 43.0902 74.4136 43.7024 73.7401C43.9764 73.4391 44.0678 73.0222 43.949 72.6328L41.9025 65.8729C41.7655 65.4212 41.3634 65.0934 40.8884 65.0312L35.1965 64.3486C34.7579 64.296 34.3103 64.3756 33.9174 64.5879L29.1848 67.0245C29.1848 67.0245 29.9797 68.9292 31.9257 68.7874C32.8211 68.7258 33.6159 68.5308 34.0545 68.4153C34.3011 68.3447 34.5661 68.3268 34.8219 68.3537L37.508 68.6815C37.9556 68.7342 38.2389 69.1864 38.0653 69.6028C37.6358 70.6126 36.8775 72.2607 36.2746 72.7123C35.3792 73.3859 32.7297 75.1578 31.606 77.638"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M54.3546 48.9727C54.1546 48.3364 53.6546 47.8363 53.0273 47.6454L51 47L53.0273 46.3545C53.6637 46.1545 54.1546 45.6546 54.3546 45.0273L55 43L55.6455 45.0273C55.8455 45.6636 56.3455 46.1545 56.9727 46.3545L59 47L56.9727 47.6454C56.3364 47.8455 55.8455 48.3454 55.6364 48.9727L54.9909 51L54.3546 48.9727Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M55.3057 43.1413C55.3322 43.0442 55.4205 43 55.5 43C55.5883 43 55.6678 43.0442 55.6943 43.1413L56.4362 45.4818C56.5952 45.9941 57.0015 46.4004 57.5137 46.5594L59.8542 47.3013C60.0486 47.3631 60.0486 47.6369 59.8542 47.6987L57.5137 48.4406C57.0015 48.5996 56.5952 49.0059 56.4362 49.5182L55.6943 51.8587C55.6678 51.9558 55.5795 52 55.5 52C55.4205 52 55.3322 51.9558 55.3057 51.8587L54.5638 49.5182C54.4048 49.0059 53.9985 48.5996 53.4863 48.4406L51.1457 47.6987C50.9514 47.6369 50.9514 47.3631 51.1457 47.3013L53.4863 46.5594C53.9985 46.4004 54.4048 45.9941 54.5638 45.4818L55.3057 43.1413ZM55.7769 46.0444L55.5 45L55.2231 46.0444C55.0174 46.8133 54.5111 47.4209 53.8703 47.6677L53 48L53.8703 48.3323C54.5111 48.5791 55.0174 49.1867 55.2231 49.9557L55.5 51L55.7769 49.9557C55.9826 49.1867 56.4889 48.5791 57.1297 48.3323L58 48L57.1297 47.6677C56.4889 47.4209 55.9826 46.8133 55.7769 46.0444Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M44.725 89.1335C44.5917 88.725 44.275 88.3998 43.8666 88.2749L43 87.9997L43.8666 87.7251C44.275 87.6002 44.6 87.275 44.725 86.8665L45 86L45.275 86.8665C45.4083 87.275 45.725 87.6002 46.1333 87.7251L47 87.9997L46.1333 88.2749C45.725 88.3998 45.4 88.725 45.275 89.1335L45 90L44.725 89.1335Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M44.8722 86.0911C44.8905 86.0277 44.9452 86 45 86C45.0548 86 45.1096 86.0277 45.1279 86.0911L45.621 87.6507C45.7306 87.9973 46.0046 88.2615 46.3425 88.3711L47.9041 88.8636C48.032 88.9092 48.032 89.0914 47.9041 89.1278L46.3425 89.6203C45.9954 89.7299 45.7306 90.0033 45.621 90.3407L45.1279 91.8996C45.1096 91.9637 45.0548 92 45 92C44.9452 92 44.8905 91.9637 44.8722 91.8996L44.379 90.3407C44.2695 89.994 43.9954 89.7299 43.6576 89.6203L42.0959 89.1278C41.968 89.0822 41.968 88.8999 42.0959 88.8636L43.6576 88.3711C44.0046 88.2615 44.2695 87.9973 44.379 87.6507L44.8722 86.0911ZM46 89C45.5345 88.8277 45.1724 88.4657 45 88C44.8276 88.4569 44.4569 88.8277 44 89C44.4655 89.1723 44.8276 89.5343 45 90C45.1724 89.5343 45.5345 89.1723 46 89Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M14.3563 68.9817C14.154 68.3486 13.6575 67.8444 13.023 67.6424L11 67L13.023 66.3582C13.6575 66.1563 14.1632 65.6607 14.3563 65.0183L15 63L15.6436 65.0183C15.8459 65.6514 16.3425 66.1563 16.9769 66.3582L19 67L16.9769 67.6424C16.3425 67.8444 15.8367 68.3393 15.6436 68.9817L15 71L14.3563 68.9817Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M15.3042 63.1426C15.3309 63.0445 15.4199 63 15.5001 63C15.5801 63 15.6691 63.0529 15.6959 63.1426L16.4347 65.4862C16.595 66.003 16.9956 66.4037 17.5119 66.5644L19.8531 67.3039C20.049 67.3658 20.049 67.6336 19.8531 67.6955L17.5119 68.4356C16.9956 68.5957 16.595 68.997 16.4347 69.5138L15.6959 71.8574C15.6691 71.9555 15.5801 72 15.5001 72C15.4199 72 15.3309 71.9555 15.3042 71.8574L14.5653 69.5138C14.4051 68.997 14.0045 68.5957 13.4882 68.4356L11.1469 67.6955C10.951 67.6336 10.951 67.3658 11.1469 67.3039L13.4882 66.5644C14.0045 66.4037 14.4051 66.003 14.5653 65.4862L15.3042 63.1426ZM15.7733 65.8598L15.5001 65L15.2267 65.8598C15.0177 66.5112 14.5113 67.0177 13.8601 67.2267L13 67.4997L13.8601 67.7733C14.5113 67.9823 15.0177 68.4888 15.2267 69.1402L15.5001 70L15.7733 69.1402C15.9823 68.4888 16.4888 67.9823 17.1399 67.7733L18 67.4997L17.1399 67.2267C16.4888 67.0177 15.9823 66.5112 15.7733 65.8598Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M0 34.1124C0 15.2694 15.228 0 34 0C52.772 0 67.9911 15.2694 68 34.1124V67.8876C68 86.7304 52.7809 102 34 102C15.2191 102 0 86.7221 0 67.8876V34.1124ZM65 34.0758C65 16.9427 51.0914 3 34.0002 3C16.9088 3 3 16.9339 3 34.0758V67.9239C3 85.0571 16.9088 99 34.0002 99C51.0914 99 65 85.0571 65 67.9239V34.0758Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M34.3334 33.2011C33.7886 35.1329 33.3078 37.0378 32.9072 38.9785C32.5146 40.9192 32.2742 42.8957 32.2101 44.8722C32.1701 46.8397 32.2582 48.8251 32.7549 50.6585C33.0033 51.5707 33.3398 52.4472 33.8286 53.1805C34.3174 53.9139 34.9424 54.5041 35.6875 54.8798H35.6955C35.9599 55.0139 36.0721 55.3627 35.9519 55.6578C35.8397 55.944 35.5433 56.0692 35.2869 55.9619C34.3494 55.5594 33.5242 54.835 32.9152 53.9586C32.2983 53.0822 31.8896 52.0805 31.6092 51.052C31.0643 49.004 30.9282 46.8844 31.0323 44.8185C31.1365 42.7436 31.4329 40.7046 31.8736 38.7102C32.3303 36.7248 32.9873 34.7483 34.077 33.067C34.1251 32.9955 34.2132 32.9775 34.2773 33.0312C34.3334 33.058 34.3494 33.1385 34.3334 33.2011Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M42.2817 34.0904C42.8844 33.6483 52.9274 26.6641 53.3529 19.998C48.8943 20.7584 43.4961 23.5167 39.33 27.0354C40.9166 20.6876 39.0463 13.8625 37.3089 9C37.3089 9 37.309 9.00883 37.3001 9.00883V9C34.2952 13.1906 30.6432 18.7869 30.4039 25.7888C27.3635 21.2623 22.9226 17.1424 18.8452 15.1886C18.6768 23.7378 25.1564 31.1817 25.6173 31.7741C22.639 29.7849 16.1505 29.7142 14.0054 29.7761C13.775 30.0678 20.9016 36.1592 28.2411 37.3527C28.0017 37.4411 21.6905 39.3596 21.008 41.7996C27.0355 42.7544 32.221 38.334 33.3025 37.6002C34.1357 38.5992 35.9439 43.0373 43.9659 45C43.3099 41.7378 38.4347 38.8998 38.2308 38.7495C49.3552 39.4391 53.5124 35.6464 54 35.3547C51.9524 34.6916 47.3431 32.7024 42.2817 34.0904Z"-->
        <!--                            fill="currentColor"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-width="1.116"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M37 14C37 14 34.3943 32.5078 34 36"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-width="0.744"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M37 38L34 36"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-width="0.744"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M38 20C38 20 35.3053 21.2836 35 23"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-width="0.744"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M32 22C32 22 35.4271 23.1687 34.9554 26"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-width="0.744"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M38 27C38 27 34.4624 28.8371 34 32"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-width="0.744"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M31 28C31 28 34.4378 31.2827 33.9532 34"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-width="0.744"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M34 15C34 15 35.0816 16.9927 34.9951 18"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-width="0.744"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M22 21L32 36"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-width="0.744"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M30 37L33 36"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-width="0.744"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M21 32L33 36"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-width="0.744"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M28.2469 24C28.2469 24 27.3408 27.6986 29 29"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-width="0.744"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M27 31.2253C27 31.2253 28.9085 30.0679 30 33"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-width="0.744"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M22 23C22 23 24.4606 23.3806 25 24"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-width="0.744"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M25 34.7943C25 34.7943 26.6101 33.6095 28 34.6018"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-width="0.744"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M28 33C28 33 29.0174 35.5205 30 36"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-width="0.744"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M49 24L34 36"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-width="0.744"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M37 38L34 36"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-width="0.744"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M47 36.2038L34 36.7962"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-width="0.744"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M42 27C42 27 41.5385 31.0445 40 32"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-width="0.744"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M41 33.9231C41 33.9231 38.9196 31.7958 37 34"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-width="0.744"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M47 27.2868C47 27.2868 44.6842 26.8721 44 27.8051"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-width="0.744"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M41 37C41 37 39.5642 35.9268 38 36.004"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-width="0.744"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M39 34C39 34 37.2329 35.9637 36 36"-->
        <!--                            stroke="currentColor"-->
        <!--                            stroke-width="0.744"-->
        <!--                            stroke-linecap="round"-->
        <!--                            stroke-linejoin="round"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M15.6522 38.9043C15.9412 38.5766 16.3172 38.4128 16.7803 38.4128C17.5864 38.4128 17.993 38.8327 18 39.6726V42H17.3478V39.6693C17.3455 39.4154 17.2821 39.2277 17.1575 39.1061C17.0353 38.9846 16.8437 38.9238 16.5828 38.9238C16.3713 38.9238 16.1857 38.9759 16.0259 39.0801C15.866 39.1843 15.7415 39.321 15.6522 39.4902V42H15V37H15.6522V38.9043Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M15.7674 42.7674V43H15.2326V42.7674H15.7674ZM15.7674 42.2326H16V42.7674H15.7674V42.2326ZM15.2326 42.2326H15.7674V37.7674H16V37.2326H15.7674V37H15.2326V37.2326H15V37.7674H15.2326V42.2326ZM15.2326 42.2326H15V42.7674H15.2326V42.2326ZM15.2326 37.7674V37.2326H15.7674V37.7674H15.2326ZM15.6337 37.6337V37.3663H15.3663V37.6337H15.6337ZM16.5301 40.1242H16.5286C16.582 40.0804 16.6379 40.039 16.6964 40L16.7674 40.0952V40.5961C16.6507 40.7115 16.5528 40.8457 16.4734 41L16.2326 40.889V40.4229C16.2425 40.4106 16.2525 40.3984 16.2627 40.3864V40.8758L16.5211 40.5585H16.6337L16.5531 40.5193L16.7373 40.293L16.5301 40.1242ZM16.5531 40.5193L16.3933 40.4415L16.3663 40.4969V40.5585H16.5211L16.5531 40.5193ZM16.2326 40V40.4229C16.1441 40.5329 16.0665 40.6527 16 40.7818L16.2326 40.889V43H16.7674V40.5961C16.8381 40.5262 16.9156 40.4632 17 40.4068L16.7674 40.0952V40V39.6713C16.8414 39.658 16.9188 39.6512 17 39.6512V39.646C17.3418 39.646 17.5437 39.7452 17.6595 39.8888L17.9107 39.6203C17.9994 39.6708 18.0768 39.7304 18.1438 39.7982C18.3069 39.9632 18.4252 40.1933 18.4864 40.5001L18.3663 40.501H18.4866C18.5161 40.6491 18.5323 40.815 18.5339 41L19 40.9968C18.9947 40.3741 18.8384 39.8683 18.4913 39.5172C18.1395 39.1613 17.6277 39 17 39C16.9197 39 16.8421 39.0097 16.7674 39.0291V37H16.2326V39.2983C16.1522 39.3403 16.0746 39.3898 16 39.4467L16.0904 39.585C16.0592 39.6349 16.0291 39.6881 16 39.7444L16.1991 40C16.2101 39.9787 16.2213 39.9581 16.2326 39.9379V40ZM16.2326 39.8025L16.0904 39.585C16.1356 39.5126 16.1831 39.4468 16.2326 39.3878V39.8025ZM16.2747 39.8669C16.2604 39.8898 16.2464 39.9134 16.2326 39.9379V39.8025L16.2747 39.8669ZM16.3944 39.2251C16.3393 39.2464 16.2853 39.2707 16.2326 39.2983V39.3878C16.2842 39.3263 16.3382 39.272 16.3944 39.2251ZM16.2747 39.8669C16.4144 39.644 16.5777 39.5024 16.7674 39.4407V39.6713C16.5873 39.7037 16.4279 39.7751 16.2856 39.8835L16.2747 39.8669ZM16.3944 39.2251C16.5134 39.1792 16.6379 39.148 16.7674 39.1312V39.4407C16.8409 39.4168 16.9184 39.4048 17 39.4048V39.4216C17.3874 39.4216 17.6856 39.4919 17.9107 39.6203L18 39.5248C17.7628 39.2308 17.4117 39.1112 17 39.1112V39.1165C16.9208 39.1165 16.8433 39.1213 16.7674 39.1312V39.0291C16.6339 39.0637 16.5094 39.1291 16.3944 39.2251ZM18.4866 40.501L18.4864 40.5001L18.6337 40.499V40.501H18.4866ZM16.2627 40.3864V40.1242H16.5286C16.4314 40.2039 16.3428 40.2914 16.2627 40.3864ZM18.3663 43.6337V43.3663H18.6337V43.6337H18.3663ZM17.6337 43.3663H17.3663V43.6337H17.6337V43.3663ZM17.6337 40.5012H17.4996L17.5009 40.5L17.6337 40.4988V40.5012ZM17.499 40.5L17.5979 40.4081L17.5009 40.5L17.499 40.5ZM17.4978 40.5012H17.3663L17.499 40.5L17.4978 40.5012ZM17.4978 40.5012L17.4021 40.5901L17.4037 40.5919L17.4996 40.5012H17.4978ZM16.3663 43.3663V43.6337H16.6337V43.3663H16.3663ZM15.3663 43.3663H15.6337V43.6337H15.3663V43.3663ZM16.6337 37.6337H16.3663V37.3663H16.6337V37.6337ZM17.7674 42.7674H18V42.2326H17.7674H17.2326H17V42.7674H17.2326H17.7674ZM17.4994 40C17.772 40.24 17.8848 40.5873 17.889 40.9962L17.3542 41C17.3506 40.647 17.2525 40.4311 17.111 40.3064L17.4994 40Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M54.6522 60.9044C54.9412 60.5766 55.3172 60.4127 55.7803 60.4127C56.5864 60.4127 56.993 60.8327 57 61.6727V64H56.3478V61.6694C56.3455 61.4155 56.2821 61.2277 56.1575 61.106C56.0353 60.9849 55.8437 60.9238 55.5828 60.9238C55.3713 60.9238 55.1857 60.976 55.0259 61.0799C54.866 61.1844 54.7415 61.3211 54.6522 61.4905V64H54V59H54.6522V60.9044Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M54.7674 64.7675V65H54.2326V64.7675H54.7674ZM54.7674 64.2325H55V64.7675H54.7674V64.2325ZM54.2326 64.2325H54.7674V59.7674H55V59.2326H54.7674V59H54.2326V59.2326H54V59.7674H54.2326V64.2325ZM54.2326 64.2325H54V64.7675H54.2326V64.2325ZM54.2326 59.7674V59.2326H54.7674V59.7674H54.2326ZM54.6337 59.6337V59.3663H54.3663V59.6337H54.6337ZM55.5301 62.124H55.529C55.5822 62.0803 55.638 62.039 55.6964 62L55.7674 62.0952V62.5959C55.6507 62.7114 55.5528 62.8458 55.4734 63L55.2326 62.8892V62.4229C55.2425 62.4106 55.2525 62.3985 55.2627 62.3864V62.876L55.5212 62.5585H55.6337L55.5531 62.5193L55.7373 62.293L55.5301 62.124ZM55.5531 62.5193L55.3933 62.4415L55.3663 62.4965V62.5585H55.5212L55.5531 62.5193ZM55.2326 62V62.4229C55.1441 62.533 55.0665 62.6528 55 62.7821L55.2326 62.8892V65H55.7674V62.5959C55.8381 62.526 55.9156 62.4631 56 62.4069L55.7674 62.0952V62V61.6715C55.8414 61.6582 55.9188 61.6515 56 61.6515V61.6465C56.3417 61.6465 56.5437 61.7455 56.6595 61.8885L56.9106 61.6201C56.9993 61.6706 57.0767 61.73 57.1438 61.7978C57.3069 61.9631 57.4252 62.1932 57.4864 62.5001L57.3663 62.501H57.4866C57.5161 62.6491 57.5323 62.8149 57.5339 63L58 62.9968C57.9947 62.3741 57.8384 61.868 57.4913 61.5171C57.1395 61.1608 56.6277 61 56 61C55.9197 61 55.8421 61.0097 55.7674 61.029V59H55.2326V61.2982C55.1522 61.3402 55.0746 61.3896 55 61.4465L55.0904 61.5848C55.0592 61.6348 55.0291 61.6879 55 61.7441L55.1991 62C55.2101 61.9787 55.2213 61.958 55.2326 61.9379V62ZM55.2326 61.8024L55.0904 61.5848C55.1356 61.5124 55.183 61.4466 55.2326 61.3876V61.8024ZM55.2747 61.8669C55.2604 61.8897 55.2464 61.9134 55.2326 61.9379V61.8024L55.2747 61.8669ZM55.3943 61.2251C55.3392 61.2463 55.2853 61.2707 55.2326 61.2982V61.3876C55.2842 61.3262 55.3381 61.272 55.3943 61.2251ZM55.2747 61.8669C55.4144 61.6438 55.5777 61.5024 55.7674 61.4408V61.6715C55.5873 61.7038 55.4279 61.7751 55.2856 61.8835L55.2747 61.8669ZM55.3943 61.2251C55.5133 61.1792 55.6379 61.148 55.7674 61.1312V61.4408C55.8409 61.4169 55.9184 61.405 56 61.405V61.4218C56.3874 61.4218 56.6855 61.4919 56.9106 61.6201L57 61.5245C56.7628 61.2305 56.4117 61.1115 56 61.1115V61.1165C55.9208 61.1165 55.8433 61.1214 55.7674 61.1312V61.029C55.6338 61.0636 55.5093 61.129 55.3943 61.2251ZM57.4866 62.501L57.4864 62.5001L57.6337 62.499V62.501H57.4866ZM55.2627 62.3864V62.124H55.529C55.4317 62.2038 55.3429 62.2913 55.2627 62.3864ZM57.3663 65.634V65.366H57.6337V65.634H57.3663ZM56.6337 65.366H56.3663V65.634H56.6337V65.366ZM56.6337 62.501H56.4998L56.5009 62.5L56.6337 62.499V62.501ZM56.4989 62.5L56.5979 62.408L56.5009 62.5L56.4989 62.5ZM56.4978 62.501H56.3663L56.4989 62.5L56.4978 62.501ZM56.4978 62.501L56.4021 62.59L56.4037 62.592L56.4998 62.501H56.4978ZM55.3663 65.366V65.634H55.6337V65.366H55.3663ZM54.3663 65.366H54.6337V65.634H54.3663V65.366ZM55.6337 59.6337H55.3663V59.3663H55.6337V59.6337ZM56.7674 64.7675H57V64.2325H56.7674H56.2326H56V64.7675H56.2326H56.7674ZM56.4994 62C56.772 62.24 56.8848 62.5875 56.889 62.9967L56.3542 63C56.3506 62.6475 56.2525 62.4317 56.111 62.3067L56.4994 62Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M16.5001 75.974C16.7617 75.974 16.974 75.762 16.974 75.5C16.974 75.239 16.7617 75.026 16.5001 75.026C16.2383 75.026 16.026 75.239 16.026 75.5C16.026 75.762 16.2383 75.974 16.5001 75.974Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M15.5 73C15.7762 73 16 72.7764 16 72.5C16 72.2236 15.7762 72 15.5 72C15.2238 72 15 72.2236 15 72.5C15 72.7764 15.2238 73 15.5 73Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M53.4999 57.974C53.7617 57.974 53.974 57.7617 53.974 57.5001C53.974 57.2383 53.7617 57.026 53.4999 57.026C53.2382 57.026 53.026 57.2383 53.026 57.5001C53.026 57.7617 53.2382 57.974 53.4999 57.974Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M53.5 54C53.7761 54 54 53.7761 54 53.5C54 53.2239 53.7761 53 53.5 53C53.2239 53 53 53.2239 53 53.5C53 53.7761 53.2239 54 53.5 54Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                    </svg>-->
        <!--                </li>-->
        <!--                <li class="partners_list-item d-flex justify-content-center swiper-slide">-->
        <!--                    <svg width="174" height="120" viewBox="0 0 174 120" fill="none" xmlns="http://www.w3.org/2000/svg">-->
        <!--                        <path-->
        <!--                            d="M8.60433 120C6.97852 120 5.50613 119.638 4.18712 118.913C2.88343 118.174 1.85583 117.159 1.1043 115.868C0.368098 114.577 0 113.121 0 111.5C0 109.878 0.375767 108.422 1.1273 107.132C1.87884 105.841 2.90644 104.833 4.21012 104.109C5.52914 103.37 7.00153 103 8.62729 103C9.94635 103 11.1503 103.236 12.2393 103.708C13.3282 104.181 14.2485 104.865 15 105.763L13.0675 107.628C11.9018 106.337 10.4678 105.692 8.76536 105.692C7.66103 105.692 6.67177 105.944 5.79754 106.447C4.92331 106.935 4.2408 107.62 3.75 108.501C3.2592 109.383 3.0138 110.382 3.0138 111.5C3.0138 112.618 3.2592 113.617 3.75 114.499C4.2408 115.38 4.92331 116.072 5.79754 116.577C6.67177 117.064 7.66103 117.308 8.76536 117.308C10.4678 117.308 11.9018 116.655 13.0675 115.348L15 117.237C14.2485 118.134 13.3206 118.819 12.2163 119.292C11.1273 119.764 9.92331 120 8.60433 120Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M26.8142 115.297H35.1146L36.7747 119H40L32.5059 103H29.4704L22 119H25.1779L26.8142 115.297ZM30.9886 106L34 113H28L30.9886 106Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M64 103V119H61.4196L52.111 108.166V119H49V103H51.5804L60.889 113.834V103H64Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            d="M90 103V119H87.4197L78.1109 108.166V119H75V103H77.5804L86.8888 113.834V103H90Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M102.814 115.297H111.114L112.774 119H116L108.506 103H105.47L98 119H101.178L102.814 115.297ZM106.989 106L110 113H104L106.989 106Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M135.961 110.68C136.894 110.97 137.633 111.457 138.18 112.143C138.727 112.814 139 113.652 139 114.657C139 116.044 138.438 117.118 137.312 117.88C136.187 118.626 134.547 119 132.393 119H124V103H131.91C133.904 103 135.439 103.374 136.516 104.12C137.593 104.851 138.132 105.865 138.132 107.16C138.132 107.953 137.939 108.654 137.553 109.263C137.167 109.872 136.637 110.345 135.961 110.68ZM128 106V110H132.529C133.645 110 134.498 109.834 135.089 109.502C135.696 109.157 136 108.659 136 108.01C136 107.347 135.696 106.849 135.089 106.518C134.498 106.172 133.645 106 132.529 106H128ZM137 114C137 115.333 135.745 116 133.235 116H128V112H133.235C135.745 112 137 112.666 137 114Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path d="M148 103H151V119H148V103Z" fill="currentColor" />-->
        <!--                        <path-->
        <!--                            d="M167.418 120C166.163 120 164.945 119.818 163.767 119.457C162.605 119.095 161.682 118.614 161 118.016L162.047 115.632C162.713 116.167 163.528 116.608 164.488 116.954C165.465 117.284 166.442 117.449 167.418 117.449C168.628 117.449 169.527 117.253 170.116 116.859C170.721 116.466 171.023 115.946 171.023 115.301C171.023 114.829 170.853 114.443 170.512 114.144C170.186 113.829 169.768 113.585 169.256 113.412C168.744 113.239 168.047 113.043 167.163 112.822C165.922 112.523 164.915 112.224 164.14 111.925C163.38 111.626 162.721 111.161 162.163 110.532C161.621 109.886 161.349 109.021 161.349 107.934C161.349 107.022 161.589 106.195 162.07 105.455C162.566 104.7 163.302 104.101 164.279 103.661C165.272 103.22 166.481 103 167.907 103C168.899 103 169.876 103.126 170.837 103.377C171.798 103.629 172.628 103.992 173.325 104.464L172.372 106.849C171.659 106.423 170.914 106.101 170.139 105.88C169.364 105.66 168.613 105.55 167.884 105.55C166.69 105.55 165.798 105.754 165.209 106.164C164.636 106.573 164.349 107.116 164.349 107.793C164.349 108.265 164.511 108.651 164.838 108.95C165.178 109.249 165.605 109.485 166.116 109.658C166.628 109.831 167.326 110.028 168.209 110.249C169.418 110.532 170.411 110.831 171.186 111.146C171.961 111.445 172.62 111.909 173.163 112.538C173.721 113.169 174 114.018 174 115.089C174 116.002 173.752 116.828 173.255 117.568C172.775 118.307 172.038 118.898 171.046 119.338C170.055 119.779 168.845 120 167.418 120Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M106.113 27.7908C105.96 26.4487 105.553 21.0378 108.353 17.5935C111.079 14.2423 115.396 12.4774 116.656 12.0158C116.828 11.9538 117.011 12.0817 116.999 12.2641C116.929 13.7497 116.467 19.3157 113.406 22.9074C110.582 26.216 106.652 28.2408 106.226 27.977C106.159 27.9343 106.12 27.8684 106.113 27.7908ZM82.599 38.8426C83.1969 40.4917 83.9847 44.6757 78.3824 47.8829C77.4431 48.4207 76.6392 46.9615 77.5829 46.4237C82.6608 43.5288 81.3291 39.4793 80.9298 39.3646C80.5953 39.2697 79.3224 40.9148 75.6491 42.2278C71.949 43.5486 65.9037 42.2317 65.7445 41.8046C65.5892 41.3854 67.7363 38.9375 69.6737 37.5732C71.3394 36.3986 73.2807 35.5088 74.6008 34.971C74.8609 34.8642 74.7833 34.4648 74.5037 34.4687C72.1431 34.5122 67.5965 34.3343 62.9257 32.705C57.0241 30.6446 52.9357 25.7369 52 24.5346L52.1048 24.1352C53.2696 23.6528 57.6376 21.9997 63.0539 21.9562C66.754 21.9246 70.8035 23.3562 73.5447 24.5545C73.8204 24.6731 74.0378 24.2855 73.7971 24.1075C71.2656 22.2212 67.6936 19.1722 65.3951 15.5418C61.955 10.1041 61.2018 2.22251 61.5086 1.88637C61.8774 1.48299 67.1345 1.97337 73.5913 7.3161C78.1653 11.1007 80.7506 16.3841 82.0591 19.8761C82.1641 20.1569 82.5797 20.058 82.5527 19.7574C81.815 12.2515 84.0705 5.145 86.2101 0.0870024L86.6179 0C87.7742 1.11916 92.3176 6.05853 92.8413 14.9447C93.2066 21.1415 90.7874 25.0131 88.6795 27.382C88.481 27.6034 88.7567 27.9357 89.0054 27.7735C92.3717 25.5945 96.6578 24.6533 99.7174 24.3053C99.9313 24.2815 100.075 24.5188 99.9584 24.7047C90.558 39.5465 83.0184 37.9686 82.626 38.6092C82.5758 38.6844 82.5681 38.7635 82.599 38.8426ZM100.022 16.7671C99.9775 15.5656 99.9217 11.929 100.719 8.84729C101.533 5.70976 105.157 1.91754 105.602 2.00137C105.686 2.01734 105.75 2.06524 105.786 2.14109C110.316 11.0468 100.755 17.3299 100.154 16.9866C100.074 16.9387 100.026 16.8589 100.022 16.7671Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M58.8902 41.4016C57.7524 42.2845 53.0548 45.6453 48.471 44.8904C44.0172 44.1568 40.1689 41.0519 39.096 40.1136C38.9498 39.9857 38.9741 39.7426 39.1449 39.6487C40.5305 38.8981 45.8174 36.2751 50.6694 37.1921C55.1395 38.0408 59.0162 40.6382 58.9999 41.1841C58.9959 41.2737 58.9594 41.3462 58.8902 41.4016ZM79.0305 56.3597C80.1327 54.9912 83.2975 52.158 88.8266 55.5491C89.7543 56.1189 88.9155 57.5797 87.9839 57.0059C82.9831 53.9278 80.2069 57.1784 80.3081 57.5917C80.3969 57.9409 82.4277 58.2419 85.3784 60.8664C88.3493 63.507 90.2557 69.5869 89.9722 69.9481C89.6925 70.3012 86.5394 69.619 84.4082 68.5796C82.5752 67.6847 80.8473 66.4005 79.7334 65.4895C79.5117 65.309 79.2128 65.5818 79.3564 65.8306C80.5754 67.9215 82.6957 72.083 83.6466 77.0914C84.847 83.4199 82.7189 89.5682 82.1635 91.0165L81.7719 91.1251C80.7777 90.3267 77.1899 87.2569 74.4447 82.4291C72.5694 79.1343 71.7579 74.7798 71.4084 71.7218C71.3735 71.4168 70.9348 71.4168 70.9037 71.7259C70.5659 74.9484 69.7582 79.6955 67.8208 83.5884C64.9203 89.4277 58.5953 94.099 58.1566 93.9984C57.6285 93.8739 55.4192 88.9183 56.7315 80.426C57.6596 74.4107 60.8628 69.4184 63.177 66.4727C63.3633 66.2359 63.0682 65.9149 62.8314 66.0914C56.817 70.5621 49.6455 72.1473 44.2757 72.7974L44 72.4763C44.3727 70.8711 46.2986 64.3016 53.5943 59.3214C58.6807 55.85 63.1809 56.0507 66.2482 56.737C66.5355 56.8012 66.6831 56.3878 66.419 56.2473C62.8818 54.3411 59.9387 50.9822 58.1138 48.4178C57.9857 48.2372 58.1177 47.9884 58.3313 48.0004C75.6484 48.8833 78.079 56.432 78.8204 56.46C78.9061 56.456 78.9795 56.4239 79.0305 56.3597ZM50.8818 53.3761C49.9094 54.0086 46.9275 55.8588 43.9991 56.7008C41.0172 57.5587 36.1555 56.3411 36.0144 55.922C35.9877 55.843 35.9991 55.7639 36.041 55.6927C41.2536 47.4144 50.9962 52.4667 51 53.1507C51 53.2495 50.958 53.3286 50.8818 53.3761Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                        <path-->
        <!--                            fill-rule="evenodd"-->
        <!--                            clip-rule="evenodd"-->
        <!--                            d="M93.5249 78.0208C94.7287 78.5543 99.463 80.8838 101.009 84.972C102.509 88.9442 101.919 93.489 101.701 94.7901C101.671 94.9665 101.475 95.0589 101.324 94.9589C100.11 94.164 95.6571 91.0173 94.1152 86.6374C92.6937 82.5996 92.886 78.2588 93.3072 78.0285C93.382 77.9939 93.4538 77.9901 93.5249 78.0208ZM95.6331 51.6253C93.9161 51.332 89.9262 49.9514 90.001 43.4748C90.0166 42.3876 91.6705 42.4071 91.6588 43.4983C91.58 49.3609 95.7313 50.2017 96.0253 49.9084C96.2756 49.662 95.5037 47.7417 96.2327 43.8894C96.9657 40.0097 101.147 35.383 101.594 35.4573C102.033 35.5276 103.048 38.6134 103.245 40.9757C103.413 43.0133 103.197 45.1409 102.99 46.5605C102.947 46.8422 103.331 46.9712 103.468 46.7209C104.62 44.6403 107.07 40.7606 110.825 37.491C115.571 33.361 121.846 32.2229 123.351 32L123.645 32.2894C123.473 33.5448 122.685 38.1715 119.988 42.9156C118.147 46.1577 114.873 48.9854 112.463 50.7805C112.22 50.9605 112.444 51.3437 112.722 51.2224C115.618 49.9475 120.039 48.34 124.311 48.1289C130.716 47.816 137.861 51.0543 137.994 51.4884C138.155 52.0086 135.078 56.3498 127.235 59.3455C121.678 61.4653 115.838 61.1055 112.181 60.5227C111.887 60.4758 111.761 60.8865 112.036 61.0117C118.851 64.0779 123.81 69.5611 127.071 73.9297L126.937 74.3286C125.393 74.7823 118.859 76.3075 110.97 72.3692C105.467 69.6236 103.366 65.5992 102.394 62.5878C102.304 62.3062 101.88 62.3805 101.892 62.6777C102.065 66.6904 100.708 70.8986 99.4624 73.7341C99.3759 73.9335 99.0975 73.9413 99 73.7497C91.0085 58.2114 96.1664 52.4153 95.8132 51.7543C95.7781 51.684 95.7158 51.637 95.6331 51.6253ZM105.394 78.0307C106.409 78.5792 109.448 80.302 111.62 82.4726C113.83 84.6858 115.247 89.5795 114.964 89.9099C114.91 89.9718 114.842 90.0036 114.761 89.9997C105.23 89.4665 104.577 78.373 105.149 78.0307C105.23 77.9917 105.318 77.9879 105.394 78.0307Z"-->
        <!--                            fill="currentColor"-->
        <!--                        />-->
        <!--                    </svg>-->
        <!--                </li>-->
        <!--            </ul>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->

@endsection


@section('scripts')
    <script src="frontend/js/index.min.js"></script>
@stop