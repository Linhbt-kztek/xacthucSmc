<div class ="boxl">
  <div class ="tit">
    <h2><a href ="/tinmoi.html" title ="Tin mới">Tin y dược</a></h2>
  </div>
  <ul class ="ulnewsh spm">
    @if(isset($dataShare['newsNew']))
      @forelse($dataShare['newsNew'] as $key => $item)
      <li class ="linews">
        <a href ="{{route('frontend.news.detail',['alias'=>$item->alias])}}" title ="{{$item->name}}">
          <img src="{{$item->introimage != '' ? asset($item->introimage) : asset('backend/libout/images/noimage.png')}}"  alt ="{{$item->name}}"/>
          <h3>{{str_limit($item->name, 200)}}</h3>
        </a>
      </li>
      @empty
      @endforelse
    @endif
  </ul>
</div>