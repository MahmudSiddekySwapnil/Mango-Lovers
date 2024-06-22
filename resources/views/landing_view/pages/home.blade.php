@extends('landing_view.layouts.landing_temp')
@section('content')

    @include('landing_view.common.mobile_view_side_navbar')

    <section class="banner-part">
        <div class="container">
            <div class="row">
                @include('landing_view.common.side_navbar')
                @include('landing_view.pages.banner')
            </div>
        </div>
    </section>
{{--    @include('landing_view.pages.suggest_catagories')--}}

{{--    @include('landing_view.pages.best_deals')--}}

{{--    @include('landing_view.pages.recently_sold')--}}

{{--    @include('landing_view.pages.featured_items')--}}

{{--    @include('landing_view.pages.promo')--}}

    @include('landing_view.pages.new_items')

{{--    @include('landing_view.pages.top_catagories')--}}

    @include('landing_view.pages.catagories')

    @include('landing_view.pages.brands')

    @include('landing_view.pages.client_feedback')

    @include('landing_view.pages.blog')
@endsection
