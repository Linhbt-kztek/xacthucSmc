<div class ="boxl">
	<div class ="tit">
	  <h2>Danh mục tin tức</h2>
	</div>
	<ul class ="menu1">
		@if(isset($dataShare['cat_news']))
			@forelse($dataShare['cat_news'] as $item)
		  	<li><a href ="{{route('frontend.news.listByCategory',['alias'=>$item->alias])}}">{{$item->name}}</a></li>
		  	@empty
		  	@endforelse
		@endif
	</ul>
</div>
  
