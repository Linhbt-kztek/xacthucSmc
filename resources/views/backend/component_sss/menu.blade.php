<ul id="menuweb" class="sidebar-menu">
   
    <li class="active treeview">
      <a href="{{route('backend.site.index')}}">
        <i class="fa fa-dashboard"></i> <span>Trang chủ</span>
      </a>
    </li>
    <!-- menu diemthi -->
    @if(Auth::user()->hasAnyRole([1]))
    <!-- <li class="treeview">
      <a href="javascript:void(0);">
        <i class="fa fa-database"></i>
        <span>HỆ THỐNG</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
        <ul class="treeview-menu">
        
        <li><a href=""><i class="fa fa-list"></i> Danh sách điểm thi</a></li>
        
        
        <li><a href="javascript: void(0);"><i class="fa fa-edit"></i> Import điểm thi</a></li>
        
        </ul>
    </li> -->
    @endif
    <!-- menu company -->
    @if(Auth::user()->hasAnyRole([1,2]))
    <li class="treeview">
      <a href="javascript:void(0);">
        <i class="fa fa-database"></i>
        <span>DOANH NGHIỆP</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        @if(Auth::user()->hasAnyRole([1,2]))
        <li><a href="{{route('backend.company.index')}}"><i class="fa fa-list"></i> Danh sách doanh nghiệp</a></li>
        @endif
        @if(Auth::user()->hasAnyRole([1]))
        <li><a href="{{route('backend.company.vAdd')}}"><i class="fa fa-edit"></i> Thêm doanh nghiệp</a></li>
        @endif
      </ul>
    </li>
    @endif
    <!-- menu partner -->
    @if(Auth::user()->hasAnyRole([1,2]))
    <li class="treeview">
      <a href="javascript:void(0);">
        <i class="fa fa-database"></i>
        <span>NHÀ PHÂN PHỐI</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        @if(Auth::user()->hasAnyRole([1,2]))
        <li><a href="{{route('backend.partner.index')}}"><i class="fa fa-list"></i> Danh sách nhà phân phối</a></li>
        @endif
        @if(Auth::user()->hasAnyRole([1,2]))
        <li><a href="{{route('backend.partner.vAdd')}}"><i class="fa fa-edit"></i>Thêm nhà phân phối</a></li>
        @endif
      </ul>
    </li>
    @endif
    <!-- menu product -->
    @if(Auth::user()->hasAnyRole([1,2]))
    <li class="treeview">
      <a href="javascript:void(0);">
        <i class="fa fa-calendar"></i>
        <span>SẢN PHẨM</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        @if(Auth::user()->hasAnyRole([1,2]))
        <li><a href="{{route('backend.product.index')}}"><i class="fa fa-list"></i> Danh sách sản phẩm</a></li>
        @endif
        @if(Auth::user()->hasAnyRole([1,2]))
        <li><a href="{{route('backend.product.vAdd')}}"><i class="fa fa-edit"></i> Thêm sản phẩm</a></li>
        @endif
      </ul>
    </li>
    @endif
    
       <!-- menu user -->
    @if(Auth::user()->hasAnyRole([1,2]))
    <li class="treeview">
      <a href="javascript: void(0);">
        <i class="fa fa-users"></i>
        <span>BẢO HÀNH</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        @if(Auth::user()->hasAnyRole([1,2]))
        <li><a href="{{route('backend.warranty.index')}}"><i class="fa fa-list"></i> Danh sách bảo hành</a></li>
        @endif
       
      </ul>
    </li>
    @endif
    
    <!-- menu qrcode -->
    @if(Auth::user()->hasAnyRole([1,2]))
    <li class="treeview">
      <a href="javascript:void(0);">
        <i class="fa fa-calendar"></i>
        <span>MÃ QRCODE</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        @if(Auth::user()->hasAnyRole([1,2]))
        <li><a href="{{route('backend.qrcode.index')}}"><i class="fa fa-list"></i> Nhật ký in</a></li>
        @endif
        @if(Auth::user()->hasAnyRole([1]))
        <li><a href="{{route('backend.qrcode.vAdd')}}"><i class="fa fa-edit"></i> Tạo mới khối QRCODE</a></li>
        @endif
        @if(Auth::user()->hasAnyRole([1,2]))
        <li><a href="{{route('backend.qrcode.islock')}}"><i class="fa fa-list"></i> Khóa code</a></li>
        @endif
        @if(Auth::user()->hasAnyRole([1,2]))
        <li><a href="{{route('backend.qrcode.active')}}"><i class="fa fa-list"></i> Lịch sử quét</a></li>
        @endif
        
      </ul>
    </li>
    @endif
    <!-- winning product -->
    
    @if(Auth::user()->hasAnyRole([1,2]))
    <li class="treeview">
      <a href="javascript:void(0);">
        <i class="fa fa-calendar"></i>
        <span>GIẢI THƯỞNG</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        @if(Auth::user()->hasAnyRole([1,2]))
        <li><a href="{{route('backend.winning.index')}}"><i class="fa fa-list"></i> Tạo quay số</a></li>
        @endif
      </ul>
       <ul class="treeview-menu">
        @if(Auth::user()->hasAnyRole([1,2]))
        <li><a href="{{route('backend.winning.index')}}"><i class="fa fa-list"></i> Danh sách giải thưởng</a></li>
        @endif
      </ul>
    </li>
    @endif
    <!-- menu role -->
    
    @if(Auth::user()->hasAnyRole([3]))
    <li class="treeview">
      <a href="javascript:void(0);">
        <i class="fa fa-user-plus"></i>
        <span>NHÓM QUYỀN</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
        <ul class="treeview-menu">
          <li><a href="{{route('backend.role.index')}}"><i class="fa fa-list"></i>Danh sách nhóm quyền</a></li>
          <li><a href="{{route('backend.role.vAdd')}}"><i class="fa fa-edit"></i>Thêm mới nhóm quyền</a></li>
        </ul>
      </a>
    </li>
    @endif
    <!-- menu report -->
    @if(Auth::user()->hasAnyRole([1,2]))
    <li class="treeview">
      <a href="javascript:void(0);">
        <i class="fa fa-file-text-o"></i>
        <span>BÁO CÁO</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        @if(Auth::user()->hasAnyRole([1,2]))
        <li><a href="{{route('backend.report.indexGiahantem')}}"><i class="fa fa-list"></i> Gia hạn tem</a></li>
        @endif
      </ul>
    </li>
    @endif
    <!-- menu user -->
    @if(Auth::user()->hasAnyRole([1,2]))
    <li class="treeview">
      <a href="javascript: void(0);">
        <i class="fa fa-users"></i>
        <span>TÀI KHOẢN</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        @if(Auth::user()->hasAnyRole([1]))
        <li><a href="{{route('backend.user.index')}}"><i class="fa fa-list"></i> Danh sách tài khoản</a></li>
        @endif
        @if(Auth::user()->hasAnyRole([1]))
        <li><a href="{{route('backend.user.vAdd')}}"><i class="fa fa-edit"></i> Thêm tài khoản</a></li>
        @endif
        @if(Auth::user()->hasAnyRole([1,2]))
        <li><a href="{{route('backend.user.profile')}}"><i class="fa fa-user"></i>Hồ sơ cá nhân</a></li>
        <li><a href="{{route('backend.site.logout')}}" ><i class="fa fa-sign-out" aria-hidden="true"></i>Thoát</a></li>
        @endif
      </ul>
    </li>
    @endif
    
    
  
    
    
  </ul>