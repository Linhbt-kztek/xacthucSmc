@extends("frontend.layouts.main")
@section("title", $cat->meta_title)
@section("keywords", $cat->meta_keyword)
@section("description", $cat->meta_description)

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
  	<div class ="boxr">
      <div class ="bg-tit">
        <div class ="t1">
          <h2><a href ="{{route('frontend.product.listByCategory',['alias'=>$cat->alias])}}" title ="{{$cat->name}}">{{$cat->name}}</a></h2>
        </div>
        <div class ="t2"></div>
      </div>
      <ul class ="produces">
        @foreach($listByCat as $product)
        <li>
          <a href ="{{route('frontend.product.detail',['alias'=>$product->alias])}}" title ="{{$product->name}}">
            <img alt ="{{$product->name}}" src ="{{$product->introimage != '' ? asset($product->introimage) : asset('backend/libout/images/noimage.png')}}" />
            <h3>{{$product->name}}</h3>
            <h4>Giá: {{$product->price != "" ? number_format($product->price) : 0}} VNĐ</h4>
            {{str_limit($product->introtext, 180)}}
          </a>
        </li>
        @endforeach
      </ul>
      <div class ="clr"></div>
    </div>
    {{ $listByCat->links() }}
@stop