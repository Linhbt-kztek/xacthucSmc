@extends("frontend.layouts.main")
@section("title", isset($meta_title) ? $meta_title : 'Trang chủ')
@section("keywords", isset($meta_keyword) ? $meta_keyword : 'Trang chủ')
@section("description", isset($meta_description) ? $meta_description : 'Trang chủ')

@section("navbar")
<div id="slide" class="divhl">
  <div class="slider">
    <div style="position:relative ">
      <a href ="/sanphamnoibat.html" title ="Sản phẩm nổi bật"><span style="position:absolute ;width: 167px; height: 33px; top:-37px; left: -10px;background:url(frontend/images/bd/spnb.png')}}) no-repeat top left;z-index:999"></span></a>
      <div id="slider" class="flexslider">
        <ul class="slides">
        @if(isset($listProductHot))
          @foreach($listProductHot as $key => $item)
          <li>
            <div class ="l">
              <img src="{{$item->introimage != '' ? asset($item->introimage) : asset('backend/libout/images/noimage.png')}}" alt="{{$item->name}}" />
            </div>
            <div class ="r">
              <a href ="{{route('frontend.product.detail',['alias'=>$item->alias])}}" title ="{{$item->name}}">
                <h2>{{$item->name}}</h2>
              </a>
              <div class ="pr">
                <h4>Giá: {{$item->price != "" ? number_format($item->price) : 0}} VNĐ</h4>
                <a href = "#" class ="by2"><img src="{{asset('frontend/images/icon/by2.png')}}" /></a>
              </div>
              <p>{{str_limit($item->introtext, 400)}}</p>
            </div>
          </li>
          @endforeach
          @endif
        </ul>
      </div>
      <div id="carousel" class="flexslider">
        <ul class="slides">
          @if(isset($listProductHot))
            @foreach($listProductHot as $key => $item)
          <li>
            <div class ="w">
              <div class ="c"></div>
              <img src="{{$item->introimage != '' ? asset($item->introimage) : asset('backend/libout/images/noimage.png')}}" alt="{{$item->name}}" />
              <h4>Giá: {{$item->price != "" ? number_format($item->price) : 0}} VNĐ</h4>
              <h3>{{$item->name}}</h3>
            </div>
          </li>
          @endforeach
          @endif
        </ul>
      </div>
    </div>
  </div>
  <div class ="clr"></div>
  <!-- Jssor Slider End -->
  <div class ="adv"><a href='http://bidupharma.com/70/1111/nano-c150-ho-tro-dieu-tri-ung-thu.html' target='_blank'><img src="{{asset('frontend/images/advert/70.jpg')}}" alt='' /></a></div>
</div>
<div class ="divhr">

	<!-- category bar -->
	@include("frontend.component.category")

	<!-- news_hot bar -->
	@include("frontend.component.news_hot")

</div>
<div class ="clr"></div>
<div class ="divhr">
  <!-- cat news bar -->
  @include("frontend.component.cat_news")
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
  @if(isset($listCategoryIndex))
    @foreach($listCategoryIndex as $item)
      @if(count($item->product) > 0)
      	<div class ="boxr">
          <div class ="bg-tit">
            <div class ="t1">
              <h2><a href ="{{route('frontend.product.listByCategory',['alias'=>$item->alias])}}" title ="{{$item->name}}">{{$item->name}}</a></h2>
            </div>
            <div class ="t2"></div>
          </div>
          <ul class ="produces">
            @foreach($item->product->take(6) as $product)
            <li>
              <a href ="{{route('frontend.product.detail',['alias'=>$product->alias])}}" title ="{{$product->name}}">
                {{-- <img class ='imgs' src ='{{asset('frontend/images/icon/sale.png')}}' alt ='' /> --}}
                <img alt ="{{$product->name}}" src ="{{$product->introimage != '' ? asset($product->introimage) : asset('backend/libout/images/noimage.png')}}" />
                <h3>{{$product->name}}</h3>
              </a>
              <div class="price">
              Giá: {{$product->price != "" ? number_format($product->price) : 0}} VNĐ
              </div>
            </li>
            @endforeach
          </ul>
          <div class ="clr"></div>
        </div>
      @endif
    @endforeach
  @endif
@stop