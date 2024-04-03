<div class ="boxl" style="padding-bottom:6px">
  <div class ="tit">
    <h2><a href ="/tintucnoibat.html" title ="Tin tức nổi bật">Cẩm nang sức khỏe</a></h2>
  </div>
  <ul class ="ulnewsh">
    @if(isset($dataShare['newsHot']))
      @forelse($dataShare['newsHot'] as $key => $item)
      @if($key == 0)
      <li class ="linews">
        <a href ="{{route('frontend.news.detail',['alias'=>$item->alias])}}" title ="{{$item->name}}">
          <img src="{{$item->introimage != '' ? asset($item->introimage) : asset('backend/libout/images/noimage.png')}}"  alt ="{{$item->name}}"/>
          <h3>{{$item->name}}</h3>
        </a>
      </li>
      @else 
      <li>
        <a href ="{{route('frontend.news.detail',['alias'=>$item->alias])}}" title ="{{$item->name}}">
          <h3>{{$item->name}}</h3>
        </a>
      </li>
      @endif
      @empty
      @endforelse
    @endif
  </ul>
</div>