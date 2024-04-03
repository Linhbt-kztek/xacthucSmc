<div class ="boxl">
	<div class ="tit">
	  <h2>Danh mục sản phẩm</h2>
	</div>
	<ul class ="menu1">
		@if(isset($dataShare['category']))
			@forelse($dataShare['category'] as $item)
			@if(count($item->product) > 0)
		  	<li><a href ="{{route('frontend.product.listByCategory',['alias'=>$item->alias])}}">{{$item->name}}</a></li>
		  	@endif
		  	@empty
		  	@endforelse
		@endif
	</ul>
</div>
  
