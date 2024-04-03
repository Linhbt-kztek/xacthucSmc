@extends("frontend.layouts.main")
@section("title", "Trang chủ")
@section("keywords", "Trang chủ")
@section("description", "Trang chủ")

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
<div class="boxr newsdt">
{!!$intro->content!!}
</div>
@stop