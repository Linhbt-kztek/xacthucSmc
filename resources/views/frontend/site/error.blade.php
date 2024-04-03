@extends("frontend.layouts.main")
@section("title", 'Lỗi')
@section("keywords", 'Lỗi')
@section("description", 'Lỗi')

@section("navbar")
<div class ="clr"></div>
<div class ="divhr">
  <div class ="divhr">

    <!-- category bar -->
    @include("frontend.component.category")

    <!-- cat news bar -->
    @include("frontend.component.cat_news")

    <!-- news_hot bar -->
    @include("frontend.component.news_hot")

  </div>
  <!-- product_new bar -->
  @include("frontend.component.product_new")

  <!-- news_new bar -->
  @include("frontend.component.news_new")

  <!-- product_buy bar -->
  @include("frontend.component.product_buy")

  <!-- product_buy bar -->
  @include("frontend.component.fanpage")
</div>
@stop

@section("content")
    <div class ="boxr">
      <div class ="bg-tit">
        <div class ="t1">
          <h2><a href ="#" title ="Error">Error</a></h2>
        </div>
        <div class ="t2"></div>
      </div>
      <div style="padding: 10px; min-height: 500px;">
        Yêu cầu của bạn không được tìm thấy! <br />
        <a href="{{route('frontend.site.index')}}" title="Trang chủ" style="font-weight: bold;">Quay lại trang chủ</a>
      </div>
      <div class ="clr"></div>
    </div>
@stop