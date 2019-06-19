  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="active treeview">
          <a href="{{ url('/backend/dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file-o"></i> <span>Bangla News</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('backend/bn-contents/create') }}"><i class="fa fa-plus-square"></i> Add news</a></li>
            <li><a href="{{ url('backend/bn-contents') }}"><i class="fa fa-file-o"></i> News list</a></li>
            <li><a href="{{ url('backend/bn-content-position') }}"><i class="fa fa-file-o"></i> News position</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file-text-o"></i> <span>English News</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('backend/en-contents/create') }}"><i class="fa fa-plus-square"></i> Add English News</a></li>
            <li><a href="{{ url('backend/en-contents') }}"><i class="fa fa-file-o"></i> English News list</a></li>
            <li><a href="{{ url('backend/en-content-position') }}"><i class="fa fa-file-o"></i> English News position</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-picture-o"></i> <span>Media Libary</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('backend/manual-photos/create') }}"><i class="fa fa-plus-square"></i> Add New Photo</a></li>
            <li><a href="{{ url('backend/manual-photos') }}"><i class="fa fa-file-o"></i> Photo list</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder-open-o"></i> <span>Documents</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('backend/manual-docs/create') }}"><i class="fa fa-plus-square"></i> Add New Document</a></li>
            <li><a href="{{ url('backend/manual-docs') }}"><i class="fa fa-file-o"></i> Documents list</a></li>
          </ul>
        </li>
        {{--<li class="treeview">--}}
          {{--<a href="#">--}}
            {{--<i class="fa fa-table"></i> <span>Photo</span>--}}
            {{--<span class="pull-right-container">--}}
              {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
          {{--</a>--}}
          {{--<ul class="treeview-menu">--}}
            {{--<li><a href="{{ url('backend/photo-albums') }}"><i class="fa fa-plus-square"></i> Photo Album</a></li>--}}
            {{--<li><a href="{{ url('backend/photo-gallery') }}"><i class="fa fa-file-o"></i> Photo Gallery</a></li>--}}
            {{--<li><a href="{{ url('backend/photo-comments') }}"><i class="fa fa-file-o"></i> Photo Comment List</a></li>--}}
            {{--<li><a href="{{ url('backend/photo-comment-reply') }}"><i class="fa fa-file-o"></i> Photo Comment Reply List</a></li>--}}
          {{--</ul>--}}
        {{--</li>--}}
        {{--<li class="treeview">--}}
          {{--<a href="#">--}}
            {{--<i class="fa fa-table"></i> <span>Video</span>--}}
            {{--<span class="pull-right-container">--}}
              {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
          {{--</a>--}}
          {{--<ul class="treeview-menu">--}}
            {{--<li><a href="{{ url('backend/videos/create') }}"><i class="fa fa-plus-square"></i> Add video</a></li>--}}
            {{--<li><a href="{{ url('backend/videos') }}"><i class="fa fa-file-o"></i> Video list</a></li>--}}
            {{--<li><a href="{{ url('backend/video-comments') }}"><i class="fa fa-file-o"></i> Video Comment List</a></li>--}}
            {{--<li><a href="{{ url('backend/video-comment-reply') }}"><i class="fa fa-file-o"></i> Video Comment Reply List</a></li>--}}
          {{--</ul>--}}
        {{--</li>--}}
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>Bn Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('backend/bn-tags') }}"><i class="fa fa-tag"></i> Bn Tag</a></li>
            <li><a href="{{ url('backend/bn-categories') }}"><i class="fa fa-plus-square"></i> Bn Category</a></li>
            <li><a href="{{ url('backend/bn-subcategories') }}"><i class="fa fa-file-o"></i> Bn Subcategory</a></li>
            <li><a href="{{ url('backend/bn-authors') }}"><i class="fa fa-file-o"></i> Bn Author</a></li>
            <li><a href="{{ url('backend/countries') }}"><i class="fa fa-plus-square"></i> Country</a></li>
            <li><a href="{{ url('backend/divisions') }}"><i class="fa fa-file-o"></i> Division list</a></li>
            <li><a href="{{ url('backend/districts') }}"><i class="fa fa-file-o"></i> District list</a></li>
            <li><a href="{{ url('backend/upozillas') }}"><i class="fa fa-file-o"></i> Upozilla list</a></li>
            <li><a href="{{ url('backend/monthly-folders') }}"><i class="fa fa-file-o"></i> Monthly folder</a></li>
            <li><a href="{{ url('backend/bn-site-settings') }}"><i class="fa fa-file-o"></i> Bn Site Settings</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>En Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('backend/en-tags') }}"><i class="fa fa-tag"></i> En Tag</a></li>
            <li><a href="{{ url('backend/en-categories') }}"><i class="fa fa-plus-square"></i> En Category</a></li>
            <li><a href="{{ url('backend/en-subcategories') }}"><i class="fa fa-file-o"></i> En Subcategory</a></li>
            <li><a href="{{ url('backend/en-authors') }}"><i class="fa fa-file-o"></i> En Author</a></li>
            <li><a href="{{ url('backend/en-site-settings') }}"><i class="fa fa-file-o"></i> En Site Settings</a></li>
          </ul>
        </li>
        {{--<li class="treeview">--}}
          {{--<a href="#">--}}
            {{--<i class="fa fa-table"></i> <span>Photo & Video Settings</span>--}}
            {{--<span class="pull-right-container">--}}
              {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
          {{--</a>--}}
          {{--<ul class="treeview-menu">--}}
            {{--<li><a href="{{ url('backend/photo-categories') }}"><i class="fa fa-file-o"></i> Photo Category</a></li>--}}
            {{--<li><a href="{{ url('backend/photo-subcategories') }}"><i class="fa fa-file-o"></i> Photo Subcategory</a></li>--}}
            {{--<li><a href="{{ url('backend/video-categories') }}"><i class="fa fa-file-o"></i> Video Category</a></li>--}}
            {{--<li><a href="{{ url('backend/video-subcategories') }}"><i class="fa fa-file-o"></i> Video Subcategory</a></li>--}}
          {{--</ul>--}}
        {{--</li>--}}
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            {{--<li><a href="{{ url('backend/authors') }}"><i class="fa fa-plus-square"></i> Author</a></li>--}}
            <li><a href="{{ url('backend/mis-users') }}"><i class="fa fa-file-o"></i> MIS user</a></li>
            @if(auth()->user()->role == 1)
              <li><a href="{{ url('backend/users') }}"><i class="fa fa-plus-square"></i> User</a></li>
            @endif
          </ul>
        </li>
        {{--<li class="treeview">--}}
          {{--<a href="#">--}}
            {{--<i class="fa fa-table"></i> <span>Video</span>--}}
            {{--<span class="pull-right-container">--}}
              {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
          {{--</a>--}}
          {{--<ul class="treeview-menu">--}}
            {{--<li><a href="{{ url('backend/videos/create') }}"><i class="fa fa-plus-square"></i> Add video</a></li>--}}
            {{--<li><a href="{{ url('backend/videos') }}"><i class="fa fa-file-o"></i> Video list</a></li>--}}
          {{--</ul>--}}
        {{--</li>--}}
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>