<div class ="boxl">
	<div class ="tit">
	  <h2><a href ="/sanphammoi.html" title ="Sản phẩm mới">Sản phẩm mới</a></h2>
	</div>
	<div class ="default">
	  	<ul class ="lstpro">
	  		@if(isset($dataShare['productNew']))
		  		@forelse($dataShare['productNew'] as $key => $item)
			    <li>
			      <a href ="{{route('frontend.product.detail',['alias'=>$item->alias])}}" title ="{{$item->name}}">
			        <img src="{{$item->introimage != '' ? asset($item->introimage) : asset('backend/libout/images/noimage.png')}}"  alt ="{{$item->name}}"/>
			        <h3>{{$item->name}}</h3>
			        <h4>{{$item->price != "" ? number_format($item->price) : 0}} VNĐ</h4>
			      </a>
			    </li>
			    @empty
	    		@endforelse
    		@endif
	  	</ul>
	</div>
</div>
          


          
          
