@extends("frontend.layouts.main")
@section("title", $product->meta_title)
@section("keywords", $product->meta_keyword)
@section("description", $product->meta_description)

@section("navbar")
<script type="text/javascript">
  $(function() {
    $(".prodt img").addClass("img-responsive");
  });
</script>
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
<div class ="boxr prodt">
    <h1>{{$product->name}}</h1>
    <div class ="l">
        <a href ="javascript:void(0)" title="{{$product->name}}"><img id="img1" src="{{$product->introimage != '' ? asset($product->introimage) : asset('backend/libout/images/noimage.png')}}"  data-zoom-image= "{{$product->introimage != '' ? asset($product->introimage) : asset('backend/libout/images/noimage.png')}}" alt="{{$product->name}}"/></a>
        <script type="text/javascript">
         	$(function() {
             	$("#img1").elevateZoom();
         	}); 
        </script>
    </div>
    <div class ="r">
        <p><b>Giá trị trường: {{$product->price != "" ? number_format($product->price)." VNĐ" : "Liên hệ"}}</b></p>
        @if($product->price_sale != "")
        <h3>Giá khuyến mại: {{number_format($product->price_sale)." VNĐ"}}</h3>
        @endif
        @if($product->code != "")
        <p><b>Mã sản phẩm: {{$product->code}}</b></p>
        @endif
        @if($product->status_count != "")
        <p><b>Tình trạng: {{$product->status_count}}</b></p>
        @endif
        @if(isset($dataShare['setting']['phone']))
        <div class ="tel"><i class ="icon_tel2"></i><span>{{$dataShare['setting']['phone']}}</span></div>
        @endif
        <p><b>Tóm tắt thông tin sản phẩm:</b></p>
        <p>{{$product->introtext}}</p>
    </div>
    <div class ="clr"></div>
    <table cellpadding ="0" cellspacing ="0" width ="100%" class ="ct">
        <tr>
            <td align ="left" class ="tt" >Chi tiết sản phẩm</td>
            <td align ="right" class ="tt2">
                <div class="addthis_toolbox addthis_default_style">
                  <div class="fb-share-button" data-href="{{route('frontend.product.detail', ['alias'=>$product->alias])}}" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Chia sẻ</a></div>
                </div>
                <b>Share sản phẩm nếu bạn thấy bổ ích: </b>
            </td>
        </tr>
    </table>
   	<div class ="fretext" >
   	{!!$product->content!!}
   	</div>                        
	<div class ="cm">
	    <h3>Ý kiến khách hàng</h3>
	    <div width="100%" class="fb-comments" data-href="{{route('frontend.product.detail',['alias'=>$product->alias])}}" data-numposts="5"></div>
	</div>
                        
</div>
<div class ="clr"></div>
@if(count($suggestProduct) > 0)
<div id="pnPage">
	<div class ="boxr">
      <div class ="bg-tit">
        <div class ="t1">
          <h2><span id="lblLink">Sản phẩm tương tự</span></h2>
        </div>
        <div class ="t2"></div>
      </div>
      <ul class ="produces">
        @foreach($suggestProduct as $product)
	        <li>
	          	<a href ="{{route('frontend.product.detail',['alias'=>$product->alias])}}" title ="{{$product->name}}">
	            <!-- <img class ='imgs' src ='{{asset('frontend/images/icon/sale.png')}}' alt ='' /> -->
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
</div>
{{ $suggestProduct->links() }}
@endif
@stop