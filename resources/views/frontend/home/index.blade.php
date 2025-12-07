@extends('frontend.layouts.app')
@section('contents')
    {{-- start-hero-section --}}
    @include('frontend.home.sections.hero-section')
    {{-- end-hero-section --}}

    {{-- start-category-section --}}
    @include('frontend.home.sections.category-section')
    {{-- end-category-section --}}

    {{-- start-banner-section --}}
    @include('frontend.home.sections.banner-section')
    {{-- end-banner-section --}}

    {{-- start-product-tab-section --}}
    @include('frontend.home.sections.product-tab-section')
    {{-- end-product-tab-section --}}

    {{-- start-banner--section-two --}}
    @include('frontend.home.sections.banner-section-two')
    {{-- end-banner--section-two --}}
    {{-- start-flash-sale-section --}}
    @include('frontend.home.sections.flash-sale-section')
    {{-- end-flash-sale-section --}}

    {{-- start-new-arival-section --}}
    @include('frontend.home.sections.new-arival-section')
    {{-- end-new-arival-section --}}

    <section class="wsus__ctg mt-40">
        <div class="container">
            <a href="#" class="wsus__ctg_area">
                <img src="assets/imgs/cta_bg.png" alt="cta" class="img-fluid w-100" />
            </a>
        </div>
    </section>
    <!--CTA section end-->

    {{-- start-special-products-section --}}
    @include('frontend.home.sections.special-products-section')
    {{-- end-special-products-section --}}

    {{-- start-four-col-section --}}
    @include('frontend.home.sections.four-col-products-section')
    {{-- end-four-col-section --}}
    @endsection
