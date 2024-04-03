@extends("frontend.layouts.main")
@section("title", 'Tìm kiếm')
@section("keywords", 'Tìm kiếm')
@section("description", 'Tìm kiếm')

@section("navbar")
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/pagination.css')}}">
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
<ul class="tabs">
  <li class="tab-item {{$tabnews == '' ? 'active' : ''}}">
    <a href="#product-search" class="tit">
      <h2>Kết quả tìm kiếm - Sản phẩm</h2>
    </a>
  </li>
  <li class="tab-item {{$tabnews != '' ? 'active' : ''}}">
    <a href="#news-search" class="tit">
      <h2>Kết quả tìm kiếm - Tin tức</h2>
    </a>
  </li>
</ul>
<div class="tab-content">
  <!-- begin product -->
  <div class="tab-panel {{$tabnews == '' ? 'active-tab' : ''}}" id="product-search">
    <div class ="boxr">
      <ul class ="produces">
        @forelse($rs_products as $product)
        <li>
          <a href ="{{route('frontend.product.detail',['alias'=>$product->alias])}}" title ="{{$product->name}}">
            <img alt ="{{$product->name}}" src ="{{$product->introimage != '' ? asset($product->introimage) : asset('backend/libout/images/noimage.png')}}" />
            <h3>{{$product->name}}</h3>
          </a>
          <div class="price">
              Giá: {{$product->price != "" ? number_format($product->price) : 0}} VNĐ
              </div>
        </li>
        @empty
        <div style="padding: 10px; min-height: 500px;font-style: italic;">Không tìm thấy kết quả nào.</div>
        @endforelse
      </ul>
      <div class ="clr"></div>
    </div>
    @if(isset($rs_products) && count($rs_products) > 0)
    {{ $rs_products->links() }}
    @endif
  </div>
  <!-- end product -->
  <!-- begin news -->
  <div class="tab-panel {{$tabnews != '' ? 'active-tab' : ''}}" id="news-search">
    <div class="clr"></div>
    <div id="pnPage">
      <div class="boxr">
        <ul class="news">
          @forelse($rs_news as $news)
          <li>
              <a href="{{route('frontend.news.detail',['alias'=>$news->alias])}}" title="{{$news->name}}">
                  <img src="{{$news->introimage != '' ? asset($news->introimage) : asset('backend/libout/images/noimage.png')}}" alt="{{$news->name}}">
                  <h3>{{$news->name}}</h3>
                  {{str_limit($news->introtext, 500)}}
              </a>
          </li>
          @empty
          <div style="padding: 10px; min-height: 500px;font-style: italic;">Không tìm thấy kết quả nào.</div>
          @endforelse
        </ul>
      </div>
    </div>
    @if(isset($rs_news) && count($rs_news) > 0)
    {{ $rs_news->appends(["tabnews"=>"active"])->links() }}  
    @endif  
  </div>
  <!-- end news -->
</div>

@stop