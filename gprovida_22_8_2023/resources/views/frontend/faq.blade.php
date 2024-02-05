@extends('frontend.app')

@section('second_header')
    <header class="page">
        <div class="page_main container-fluid">
            <div class="container">
                <h1 class="page_header">Popular Questions</h1>
                <p class="page_text"></p>
            </div>
        </div>
        <div class="container">
            <ul class="page_breadcrumbs d-flex flex-wrap">
                <li class="page_breadcrumbs-item">
                    <a class="link" href="{{url('/')}}">Home</a>
                </li>
                <li class="page_breadcrumbs-item current">
                    <span>Popular Questions</span>
                </li>
            </ul>
        </div>
    </header>
@endsection

@section('pageTitle', $pageTitle)


@section('styles')
    <link rel="stylesheet" type='text/css' href="{{ URL::asset('frontend/css/faq.css') }}" />
@stop

@section('content')
    <!-- Features section start -->
    <div class="accordion section">
        <div class="container">
            <div class="accordion_component" id="accordionComponent">
                <!-- item 1 -->
                <div class="accordion_component-item">
                    <h4
                        class="accordion_component-item_header d-flex justify-content-between align-items-center collapsed"
                        data-bs-toggle="collapse" data-bs-target="#item-1">
                        How much do I need to sign up with Gpro
                        <span class="wrapper"> <i class="icon-caret_down icon"></i> </span>
                    </h4>
                    <div id="item-1" class="accordion-collapse collapse" data-bs-parent="#accordionComponent">
                        <div class="accordion_component-item_body">
                            you are free to make a choice from the list of packages below and start with.<br/><br/>

                            Starter Package with a registration of only N5,200 $17.5<br/>
                            Jasper Package ,with a registration of only N10,400 $35<br/>
                            Emerald Package with a registration of only N52,000 $174.<br/>
                            Topaz Package with a registration of only N104,000 $347<br/>
                            Ruby Package with a registration of only N520,000 $1734<br/>
                        </div>
                    </div>
                </div>
                <!-- item 2 -->
                <div class="accordion_component-item">
                    <h4
                        class="accordion_component-item_header d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse"
                        data-bs-target="#item-2" >
                        How do I get register?
                        <span class="wrapper"> <i class="icon-caret_down icon transform"></i> </span>
                    </h4>
                    <div id="item-2" class="accordion-collapse collapse show" data-bs-parent="#accordionComponent">
                        <div class="accordion_component-item_body">
                            <p>First, contact the person that told you about GPro , for your registration.</p>
                            <p>Secondly, you can purchase our pin directly from the company by paying directly to the company</p>
                        </div>
                    </div>
                </div>
                <!-- item 3 -->
                <div class="accordion_component-item">
                    <h4
                        class="accordion_component-item_header d-flex justify-content-between align-items-center collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#item-3" >
                        WHO ARE THE PEOPLE BEHIND GPro ?
                        <span class="wrapper"> <i class="icon-caret_down icon"></i></span>
                    </h4>
                    <div id="item-3" class="accordion-collapse collapse" data-bs-parent="#accordionComponent">
                        <div class="accordion_component-item_body">
                            <p>GPro is made of three Directors from different Works of Life and idealogy. </p>
                            <p>GPro is a product base network marketing company  with just one goal, To be the leading Network Marketing Platform  in Nigeria and one of the best in Africa and Beyond,
                                Providing quality health and skin care product to members and the general public .</p>
                        </div>
                    </div>
                </div>
                <!-- item 4 -->
                <div class="accordion_component-item">
                    <h4
                        class="accordion_component-item_header d-flex justify-content-between align-items-center collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#item-4" >
                        HOW DO I GET PIN FROM THE COMPANY ?
                        <span class="wrapper"><i class="icon-caret_down icon"></i> </span>
                    </h4>
                    <div id="item-4" class="accordion-collapse collapse" data-bs-parent="#accordionComponent">
                        <div class="accordion_component-item_body">
                            <p>After Payment <span> <b>Send Us a Mail</b> </span> <span><b>gpsskills@gmail.com</b></span>  with an attachment of your payment proof.  if you are already a member tell us the username where u want the pin to be sent to..</p>
                        </div>
                    </div>
                </div>
                <!-- item 5 -->
                <div class="accordion_component-item">
                    <h4
                        class="accordion_component-item_header d-flex justify-content-between align-items-center collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#item-5" >
                        WHEN DO I GET PAID ?
                        <span class="wrapper"><i class="icon-caret_down icon"></i></span>
                    </h4>
                    <div id="item-5" class="accordion-collapse collapse" data-bs-parent="#accordionComponent">
                        <div class="accordion_component-item_body">
                            <p>GPro PAYS DAILY,WEEKLY AND  MONTHLY , DIRECTLY TO YOUR LOCAL  BANK ACCOUNT. </p>
                        </div>
                    </div>
                </div>
                <!-- item 6 -->
                <div class="accordion_component-item">
                    <h4
                        class="accordion_component-item_header d-flex justify-content-between align-items-center collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#item-6" >
                        HOW DO I MOVE FROM ONE PACKAGE TO ANOTHER
                        <i class="icon-caret_down icon"></i>
                    </h4>
                    <div id="item-6" class="accordion-collapse collapse" data-bs-parent="#accordionComponent">
                        <div class="accordion_component-item_body">
                            Moving from one Package to another requires you paying the amount for the new package you intend to move to..
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Instagram section start -->
    <section class="instagram section--nopt">
        <div class="container">
            <div class="instagram_header">
                <h2 class="instagram_header-title">Follow Us on Instagram</h2>
                <p class="instagram_header-text">
                </p>
            </div>
        </div>
        <div class="instagram_slider swiper">
            <div class="swiper-wrapper">
                <div class="instagram_slider-slide swiper-slide">
                    <a class="link" href="https://instagram.com" target="_blank" rel="noopener norefferer">
                        <picture>
                            <source data-srcset="frontend/img/about/01.webp"
                                    srcset="frontend/img/about/01.webp" type="image/webp" />
                            <img class="lazy" data-src="frontend/img/about/01.webp"
                                 src="frontend/img/about/01.webp" alt="instagram post" />
                        </picture>
                        <span class="overlay d-flex justify-content-center align-items-center">
                          <i class="icon-instagram"></i>
                        </span>
                    </a>
                </div>
                <div class="instagram_slider-slide swiper-slide">
                    <a class="link" href="https://instagram.com" target="_blank" rel="noopener norefferer">
                        <picture>
                            <source data-srcset="frontend/img/about/02.webp"
                                    srcset="frontend/img/about/02.webp" type="image/webp" />
                            <img class="lazy" data-src="frontend/img/about/02.webp"
                                 src="frontend/img/about/02.webp" alt="instagram post" />
                        </picture>
                        <span class="overlay d-flex justify-content-center align-items-center">
                                    <i class="icon-instagram"></i>
                                </span>
                    </a>
                </div>
                <div class="instagram_slider-slide swiper-slide">
                    <a class="link" href="https://instagram.com" target="_blank" rel="noopener norefferer">
                        <picture>
                            <source data-srcset="frontend/img/about/03.webp"
                                    srcset="frontend/img/about/03.webp" type="image/webp" />
                            <img class="lazy" data-src="frontend/img/about/03.webp"
                                 src="frontend/img/about/03.webp" alt="instagram post" />
                        </picture>
                        <span class="overlay d-flex justify-content-center align-items-center">
                                    <i class="icon-instagram"></i>
                                </span>
                    </a>
                </div>
                <div class="instagram_slider-slide swiper-slide">
                    <a class="link" href="https://instagram.com" target="_blank" rel="noopener norefferer">
                        <picture>
                            <source data-srcset="frontend/img/about/04.webp"
                                    srcset="frontend/img/about/04.webp" type="image/webp" />
                            <img class="lazy" data-src="frontend/img/about/04.webp"
                                 src="frontend/img/about/04.webp" alt="instagram post" />
                        </picture>
                        <span class="overlay d-flex justify-content-center align-items-center">
                                    <i class="icon-instagram"></i>
                                </span>
                    </a>
                </div>
                <div class="instagram_slider-slide swiper-slide">
                    <a class="link" href="https://instagram.com" target="_blank" rel="noopener norefferer">
                        <picture>
                            <source data-srcset="frontend/img/about/05.webp"
                                    srcset="frontend/img/about/05.webp" type="image/webp" />
                            <img class="lazy" data-src="frontend/img/about/05.webp"
                                 src="frontend/img/about/05.webp" alt="instagram post" />
                        </picture>
                        <span class="overlay d-flex justify-content-center align-items-center">
                                    <i class="icon-instagram"></i>
                                </span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Instagram section end -->


@endsection


@section('scripts')
    <script src="{{ URL::asset('frontend/js/faq.min.js') }}"></script>
@stop
