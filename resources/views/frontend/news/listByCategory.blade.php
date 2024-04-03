@extends("frontend.layouts.main")
@section("title", $cat->meta_title)
@section("keywords", $cat->meta_keyword)
@section("description", $cat->meta_description)

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
<div class="clr"></div>
<div id="pnPage">
	<div class="boxr">
		<div class="bg-tit">
			<div class="t1">
				<h2><span id="lblLink">{{$cat->name}}</span></h2>
			</div>
			<div class="t2"></div>
		</div>
		<ul class="news">
			@foreach($listByCat as $news)
			<li>
                <a href="{{route('frontend.news.detail',['alias'=>$news->alias])}}" title="{{$news->name}}">
                    <img src="{{$news->introimage != '' ? asset($news->introimage) : asset('backend/libout/images/noimage.png')}}" alt="{{$news->name}}">
                    <h3>{{$news->name}}</h3>
                    {{str_limit($news->introtext, 500)}}
                </a>
            </li>
            @endforeach
		</ul>
	</div>
</div>
{{ $listByCat->links() }}
@stop