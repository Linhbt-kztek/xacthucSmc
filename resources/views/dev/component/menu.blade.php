<ul id="menuweb" class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li class="active treeview">
      <a href="{{route('dev.site.index')}}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>
    <!-- menu role -->
    <li class="treeview">
      <a href="javascript:void(0);">
        <i class="fa fa-user-plus"></i>
        <span>Role</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
        <ul class="treeview-menu">
          <li><a href="{{route('dev.role.indexGroup')}}"><i class="fa fa-list"></i>List Group Role</a></li>
          <li><a href="{{route('dev.role.vAddGroup')}}"><i class="fa fa-edit"></i>Add New Group Role</a></li>
          <li><a href="{{route('dev.role.indexItem')}}"><i class="fa fa-list"></i>List Role Item</a></li>
          <li><a href="{{route('dev.role.vAddItem')}}"><i class="fa fa-edit"></i>Add New Role Item</a></li>
        </ul>
      </a>
    </li>
    <!-- menu setting -->
    <li class="treeview">
      <a href="{{route('dev.setting.index')}}">
        <i class="fa fa-gears"></i>
        <span>Thiết lập tham số</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
    </li>
  </ul>