<!DOCTYPE html PUBLIC>
<html lang="vi" >
  <head>
    <title>@yield("title")</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('frontend/images/advert/106.png')}}')}}" rel='shortcut icon' type='image/vnd.microsoft.icon' />
    <title>@yield('title')</title>
    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('description')">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/style.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/mobile.css')}}" />
    <link type="text/css" media="screen" rel="stylesheet" href="{{asset('frontend/js/FlexSlider/flexslider.css')}}" />
    <script type="text/javascript" src="{{asset('frontend/js/jquery-1.9.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/jquery.elevatezoom.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/jcarousellite.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/skype_status.packed.js')}}"></script>  
    <script defer src="{{asset('frontend/js/FlexSlider/jquery.flexslider.js')}}"></script>
    <!-- Syntax Highlighter -->
    <script type="text/javascript" src="{{asset('frontend/js/FlexSlider/shCore.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/style.js')}}"></script>
    
    <script type="text/javascript">
      $(function() {
        var tmp_pn = '{{isset($dataShare["productNew"]) && count($dataShare["productNew"]) < 4 ? count($dataShare["productNew"]) : 3}}';
        var tmp_ph = '{{isset($dataShare["productBuy"]) && count($dataShare["productBuy"]) < 4 ? count($dataShare["productNew"]) : 5}}';
        $(".default").jCarouselLite({
          vertical: true,
          hoverPause:true,
          visible: tmp_pn,
          auto:3000,
          speed:1500
        });
        $(".default1").jCarouselLite({
          vertical: true,
          hoverPause:true,
          visible: tmp_ph,
          auto:3000,
          speed:1500
        });
        SyntaxHighlighter.all();
      });
      $(window).load(function(){
        $('#carousel').flexslider({
          animation: "slide",
          controlNav: false,
          animationLoop: false,
          slideshow: false,
          itemWidth: 176,
          itemMargin: 5,
          asNavFor: '#slider'
        });
      
        $('#slider').flexslider({
          animation: "slide",
          controlNav: false,
          animationLoop: true,
          slideshow: true,
          sync: "#carousel",
          start: function(slider){
            $('body').removeClass('loading');
          }
        });
      });
    </script>   
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      
      ga('create', '{{isset($dataShare['setting']['googleId']) ? $dataShare['setting']['googleId'] : ''}}', 'auto');
      ga('send', 'pageview');
      
    </script> 
  </head>
  <body class="wrap-mobile">
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.9&appId=659874070808764";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <form method="post" action="/" id="form1">
      <div class ="div1">
        <ul class ="utop">
          <li class ="litopl">
            <ul>
              <li>Social Network</li>
              <li><a href ="https://www.facebook.com/Raovatyduoc.vn " target ="_blank" ><img src="{{asset('frontend/images/advert/85.png')}}" alt ="" /></a></li>
              <li><a href ="https://www.facebook.com/Raovatyduoc.vn " target ="_blank" ><img src="{{asset('frontend/images/advert/86.png')}}" alt ="" /></a></li>
              <li><a href ="https://plus.google.com/u/0/b/117485026292714272239/+Muabanthuoctotcom/posts " target ="_blank" ><img src="{{asset('frontend/images/advert/87.png')}}" alt ="" /></a></li>
              <li><a href ="https://www.facebook.com/Raovatyduoc.vn " target ="_blank" ><img src="{{asset('frontend/images/advert/88.png')}}" alt ="" /></a></li>
            </ul>
          </li>
          <li class ="litopr">
            <p class ="tel"><a href="skype:{{isset($dataShare['setting']['skype']) ? $dataShare['setting']['skype'] : ''}}?chat" style="float:left;" title="skype:{{isset($dataShare['setting']['skype']) ? $dataShare['setting']['skype'] : ''}}?chat"><img src="{{asset('frontend/images/bd/skype.png')}}" style="margin-right:3px;width:20px;margin-top:2px;" alt="Skype"></a><i class ="icon_tel"></i><span>HOTLINE:&nbsp;{{isset($dataShare['setting']['phone']) ? $dataShare['setting']['phone'] : ''}}</span></p>
          </li>
        </ul>
      </div>
      <div class ="div2">
        <ul class ="utop2">
          <li class ="litop2l">
            <a href ="/" target ="_parent" ><img src="{{asset('frontend/images/advert/111.jpg')}}" alt ="logo" /></a>
          </li>
        </ul>
      </div>
      <div class ="div3" id="parent-mn">
        <div href="#" id="pull-menu">
          <span class="sp-menu-mobile"></span>
          <span class="sp-menu-mobile"></span>
          <span class="sp-menu-mobile"></span>
        </div>
        <table id="menu-tbl" width ="100%" cellpadding ="0" cellspacing ="0" class ="dmenuH">
          <tr>
            {!!$dataShare['menu'] or ''!!}
          </tr>
        </table>
      </div>
      <div class ="div4"></div>
      <div class ="div5">
        <table cellpadding ="0" cellspacing ="0" class ="uonline">
          <tr>
            <td class ="li1"></td>
            <span id="lblOnline">
              <td class ='i'></td>
              <td class="td-uonline">
                <div class='p1' id='skype1'>Tổng đài tư vấn</div>
                <p class ='p2'>{{isset($dataShare['setting']['phone']) ? $dataShare['setting']['phone'] : ''}}</p>
              </td>
              <td class ='i'></td>
              <td class="td-uonline">
                <div class='p1' id='skype2'>Bán lẻ</div>
                <p class ='p2'>{{isset($dataShare['setting']['phone']) ? $dataShare['setting']['phone'] : ''}}</p>
              </td>
              <td class ='i'></td>
              <td class="td-uonline">
                <div class='p1' id='skype3'>Hỗ trợ nhà thuốc</div>
                <p class ='p2'>{{isset($dataShare['setting']['phone']) ? $dataShare['setting']['phone'] : ''}}</p>
              </td>
            </span>
          </tr>
        </table>
      </div>
      <div class ="wap">
        <ul>
          <li class ="i3">
            <input type="hidden" id="url_search" data-href="{{url('tim-kiem.html')}}">
            <input name="txtKey" type="text" placeholder="Tìm kiếm" id="txtKey" class="textbox"/>
            <input type="image" onclick="javascript: return search();" name="btnKey" id="btnKey" src="{{asset('frontend/images/icon/key.png')}}" />
          </li>
          <li class ="i4">
            <h2 class ="tick">
              <div style="text-align: center;"><span style="color: rgb(0, 0, 0);"><font face="Tahoma" size="2"><b>Độc quyền phần phối&nbsp;</b></font></span><font face="Tahoma" size="2"><b><a href="#"><span style="color: rgb(255, 102, 0);">NANO C150</span></a>&nbsp;</b><span style="color: rgb(0, 0, 0);"><b>hỗ trợ điều trị&nbsp;bệnh dạ d&agrave;y &amp; ung thư!</b></span></font></div>
            </h2>
          </li>
        </ul>
      </div>
      <div id="page">

        @yield("navbar")
        
        <div class ="home">
          
          @yield("content")

        </div>
        <div class ="clr"></div>
        {{-- <div class="auto">
          <a href="#" class="prev">‹</a>
          <div class="carousel1">
            <ul>
              <li><a href ="http://bidupharma.com/70/1010/purtier-dao-nguoc-qua-trinh-lao-hoa-dieu-tri-ung-thu-va-tieu-duong-hieu-qua.html" target ="_parent" ><img src="{{asset('frontend/images/advert/62.jpg')}}" alt ="" /></a></li>
              <li><a href ="http://bidupharma.com/12/1055/beauty-slim.html" target ="_parent" ><img src="{{asset('frontend/images/advert/63.jpg')}}" alt ="" /></a></li>
              <li><a href ="http://bidupharma.com/13/1058/calci-k2.html" target ="_parent" ><img src="{{asset('frontend/images/advert/64.jpg')}}" alt ="" /></a></li>
              <li><a href ="http://bidupharma.com/13/948/canxi-rong-bien-va-vitamin-tong-hop.html" target ="_parent" ><img src="{{asset('frontend/images/advert/65.jpg')}}" alt ="" /></a></li>
              <li><a href ="http://bidupharma.com/13/1051/b-gargin.html" target ="_parent" ><img src="{{asset('frontend/images/advert/66.jpg')}}" alt ="" /></a></li>
              <li><a href ="http://bidupharma.com/11/943/gygurmar.html" target ="_parent" ><img src="{{asset('frontend/images/advert/67.jpg')}}" alt ="" /></a></li>
              <li><a href ="http://bidupharma.com/12/952/tang-vuong-hung-ung-tang-cuong-sinh-ly-nam-nu.html" target ="_parent" ><img src="{{asset('frontend/images/advert/68.jpg')}}" alt ="" /></a></li>
              <li><a href ="http://bidupharma.com/68/994/nam-lim-xanh-tien-phuoc-thanh-thiet-bao-sinh-hop-500g.html" target ="_parent" ><img src="{{asset('frontend/images/advert/69.jpg')}}" alt ="" /></a></li>
            </ul>
          </div>
          <a href="#" class="next">›</a>
        </div> --}}
        <script type="text/javascript">
          /*$(function() {
            $(".auto .carousel1").jCarouselLite({
              hoverPause:true,
              visible: 7,
              auto: 1000,
              speed: 1000,
              btnNext: ".auto .next",
              btnPrev: ".auto .prev"
            });
          });*/
        </script>
      </div>
      <!-- <div class ="div6">
        <ul class ="ulf">
          <li>
            <h2>Thanh toán và mua hàng</h2>
            <ul>
              <li><a href = "/30/mua-hang.html" title ="Mua hàng">Mua hàng</a></li>
              <li><a href = "/31/hinh-thuc-thanh-toan.html" title ="Hình thức thanh toán">Hình thức thanh toán</a></li>
              <li><a href = "/32/giao-nhan-hang.html" title ="Giao nhận hàng">Giao nhận hàng</a></li>
              <li><a href = "/33/doi-tra-hang.html" title ="Đổi trả hàng">Đổi trả hàng</a></li>
            </ul>
          </li>
          <li>
            <h2>Sản phẩm cao cấp</h2>
            <ul>
              <li><a href = "http://bidupharma.com/13/948/canxi-rong-bien-va-vitamin-tong-hop.html" title ="Thuốc canxi cho bà bầu">Thuốc canxi cho bà bầu</a></li>
              <li><a href = "http://bidupharma.com/12/954/super-power-tang-cuong-sinh-ly-dieu-tri-vo-sinh-nam-va-nu.html" title ="Thuốc điều trị vô sinh">Thuốc điều trị vô sinh</a></li>
              <li><a href = "http://bidupharma.com/70/1010/purtier-dao-nguoc-qua-trinh-lao-hoa-dieu-tri-ung-thu-tieu-duong.html" title ="Nhau thai hươu">Nhau thai hươu</a></li>
              <li><a href = "http://muabanthuoctot.com/68/995/nam-lim-xanh-tu-nhien-1kg.html" title ="Nấm Lim Xanh Tiên Phước">Nấm Lim Xanh Tiên Phước</a></li>
            </ul>
          </li>
          <li>
            <h2>Giới tính</h2>
            <ul>
              <li><a href = "/72/yeu-sinh-ly.html" title ="Yếu sinh lý">Yếu sinh lý</a></li>
              <li><a href = "/73/vo-sinh.html" title ="Vô sinh">Vô sinh</a></li>
              <li><a href = "/74/keo-dai-cuoc-yeu.html" title ="Kéo dài cuộc yêu">Kéo dài cuộc yêu</a></li>
              <li><a href = "/75/tren-bao-duoi-khong-nghe.html" title ="Trên bảo dưới không nghe">Trên bảo dưới không nghe</a></li>
            </ul>
          </li>
          <li>
            <h2>Chăm sóc trẻ</h2>
            <ul>
              <li><a href = "/76/lam-gi-khi-be-khong-chiu-an.html" title ="Làm gì khi bé không chịu ăn?">Làm gì khi bé không chịu ăn?</a></li>
              <li><a href = "/77/tre-coi-xuong-cham-lon.html" title ="Trẻ còi xương chậm lớn">Trẻ còi xương chậm lớn</a></li>
              <li><a href = "/78/dinh-duong-cho-be.html" title ="Dinh dưỡng cho bé">Dinh dưỡng cho bé</a></li>
              <li><a href = "/79/san-pham-cho-be.html" title ="Sản phẩm cho bé">Sản phẩm cho bé</a></li>
            </ul>
          </li>
          <li>
            <h2>Người cao tuổi</h2>
            <ul>
              <li><a href = "/80/mat-ngu-keo-dai.html" title ="Mất ngủ kéo dài">Mất ngủ kéo dài</a></li>
              <li><a href = "/81/dau-xuong-khop.html" title ="Đau xương khớp">Đau xương khớp</a></li>
              <li><a href = "/82/huyet-ap-cao.html" title ="Huyết áp cao">Huyết áp cao</a></li>
            </ul>
          </li>
          <li>
            <h2>Bệnh hiểm nghèo</h2>
            <ul>
              <li><a href = "/85/tim-hieu-ve-benh-ung-thu.html" title ="Tìm hiều về bệnh ung thư">Tìm hiều về bệnh ung thư</a></li>
              <li><a href = "/84/benh-ung-thu-gan.html" title ="Bệnh ung thư gan">Bệnh ung thư gan</a></li>
              <li><a href = "/86/xo-gan.html" title ="Xơ gan">Xơ gan</a></li>
            </ul>
          </li>
          <li>
            <h2>Dáng đẹp eo thon</h2>
            <ul>
              <li><a href = "/88/cong-nghe-te-bao-goc.html" title ="Công nghệ tế bào gốc">Công nghệ tế bào gốc</a></li>
              <li><a href = "/89/giam-can-an-toan.html" title ="Giảm cân an toàn">Giảm cân an toàn</a></li>
              <li><a href = "/90/san-pham-giam-can.html" title ="Sản phẩm giảm cân">Sản phẩm giảm cân</a></li>
            </ul>
          </li>
          <li>
            <h2>Quà tặng ngày tết</h2>
            <ul>
              <li><a href = "/92/qua-tang-bo-me-chong-tuong-lai.html" title ="Quà tặng bố mẹ chồng tương lai">Quà tặng bố mẹ chồng tương lai</a></li>
              <li><a href = "/93/qua-tang-ngay-tet-co-truyen.html" title ="Quà tặng ngày tết cổ truyền">Quà tặng ngày tết cổ truyền</a></li>
              <li><a href = "/94/cach-chon-qua-bieu-sep.html" title ="Cách chọn quà biếu sếp">Cách chọn quà biếu sếp</a></li>
              <li><a href = "/95/qua-tang-ban-gai.html" title ="Quà tặng bạn gái">Quà tặng bạn gái</a></li>
            </ul>
          </li>
        </ul>
      </div> -->
      <div class ="div7" style="border-top: 2px solid #99bed1;background: #ecf9ff;">
        <ul class ="ulft">
          <li class ="l">
            <span style="color: rgb(25, 153, 8);">{{isset($dataShare['setting']['site_name']) ? $dataShare['setting']['site_name'] : ''}}</span><br />
            <br />
            Địa chỉ: {{isset($dataShare['setting']['address']) ? $dataShare['setting']['address'] : ''}}<br />
            Điện thoại: {{isset($dataShare['setting']['phone']) ? $dataShare['setting']['phone'] : ''}}<br />
            Email: {{isset($dataShare['setting']['email']) ? $dataShare['setting']['email'] : ''}}<br />
            Website: <a href="{{isset($dataShare['setting']['website']) ? $dataShare['setting']['website'] : ''}}">{{isset($dataShare['setting']['website']) ? $dataShare['setting']['website'] : ''}}</a><br />
            <br />
            {{isset($dataShare['setting']['copyright']) ? $dataShare['setting']['copyright'] : ''}}<br />
          </li>
          <li class ="r">
            <div id="map" style="height: 180px"></div>
            <script>
              function initMap() {
                var uluru = {lat: -25.363, lng: 131.044};
                var map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 4,
                  center: uluru
                });
                var marker = new google.maps.Marker({
                  position: uluru,
                  map: map
                });
              }
            </script>
            <script async defer
              src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDL9lkHXL2PV0Y9U_d0p-dZJ6rfBCRTbLU&callback=initMap">
            </script>
            <em>Website đang ho&agrave;n thiện để đăng k&yacute; với Bộ C&ocirc;ng Thương!</em></span>
          </li>
          <li class ="clr"></li>
        </ul>
        <div class ="alink">
          <span style="color: rgb(255, 0, 0);">
            <strong><u>Ads link:</u></strong>
          </span>&nbsp;
          @if(isset($dataShare['ads_link']))
          @forelse($dataShare['ads_link'] as $key => $item)
          @if($key > 0)
          &nbsp;|&nbsp;
          @endif
          <a href="{{$item->url}}" target="_blank">{{$item->name}}</a>
          @empty
          @endforelse
          @endif
        </div>
      </div>
    </form>
    <script type="text/javascript">
      function motogClose(obj) {
        $(obj).parent().remove();
      }
    </script>
    <div id="divAdLeft" style="position:fixed;z-index:124;left:55px;">
      <div class="cl"></div>
    </div>
    <div id="divAdRight" style="position:fixed;z-index:124; right:55px;">
      <div class="cl"></div>
    </div>
    <a href="#" class="scrollToTop"><img class="img-scrollToTop" src="{{asset('frontend/images/icon/icon_gototop.png')}}"   alt ="Scroll"/></a>
  </body>
</html>
