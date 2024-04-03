@extends("frontend.layouts.main")
@section("title", $news->meta_title)
@section("keywords", $news->meta_keyword)
@section("description", $news->meta_description)

@section("navbar")
<script type="text/javascript">
	$(function() {
		$(".newsdt img").addClass("img-responsive");
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
<div class="boxr newsdt">
	<h1>{{$news->name}}</h1>
    <b>Share bài viết nếu bạn thấy bổ ích:</b> <!-- AddThis Button BEGIN -->
    <div class="addthis_toolbox addthis_default_style addthis ">
    	<div class="fb-share-button" data-href="{{route('frontend.news.detail', ['alias'=>$news->alias])}}" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Chia sẻ</a></div>
    </div>
    <!-- AddThis Button END -->
    <h2><strong>{{$news->introtext}}</strong></h2>
    <div class="fretext">
    {!!$news->content!!}
    </div>
	<div class ="cm">
	    <h3>Ý kiến khách hàng</h3>
	    <div width="100%" class="fb-comments" data-href="{{route('frontend.news.detail',['alias'=>$news->alias])}}" data-numposts="5"></div>
	</div>
	<div class="clr"></div>
</div>
@if(count($suggestNews) > 0)
<h3 class="tit-re-news"><b>Tin khác</b></h3>
<ul class="dt">
    @foreach($suggestNews as $news)
    <li><a href="{{route('frontend.news.detail',['alias'=>$news->alias])}}" title="{{$news->name}}">{{$news->name}} ( {{date("d/m/Y",strtotime($news->updated_at))}} )</a></li>
    @endforeach
</ul>
@endif
@stop