<div class ="boxl">
  <div class ="tit">
    <h2><a href ="/sanphambanchay.html" title ="Sản phẩm bán chạy">Sản phẩm bán chạy</a></h2>
  </div>
  <div class ="default1">
    <ul class ="ulnewsh spm">
      @if(isset($dataShare['productBuy']))
        @forelse($dataShare['productBuy'] as $key => $item)
        <li class ="linews">
          <a href ="{{route('frontend.product.detail',['alias'=>$item->alias])}}" title ="{{$item->name}}">
            <img src="{{$item->introimage != '' ? asset($item->introimage) : asset('backend/libout/images/noimage.png')}}"  alt ="{{$item->name}}"/>
            <h3>{{$item->name}}</h3>
          </a>
        </li>
        @empty
        @endforelse
      @endif
    </ul>
  </div>
</div>