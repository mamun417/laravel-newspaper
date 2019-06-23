  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      @php
        $cur_route_name = Route::currentRouteName();
        $cur_controller_name = class_basename(Route::current()->controller);
      @endphp

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="treeview {{ $cur_controller_name == 'BnDashboardController'?'active':'' }}">
          <a href="{{ url('/backend/dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview {{ $cur_controller_name == 'BnContentController' || $cur_controller_name == 'BnContentPositionController'?'active':'' }}">
          <a href="#">
            <i class="fa fa-file-o"></i> <span>Bangla News</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ $cur_route_name == 'bn-contents.create'? 'active':'' }}">
              <a href="{{ url('backend/bn-contents/create') }}"><i class="fa fa-plus-square"></i> Add news</a>
            </li>
            <li class="{{ $cur_route_name == 'bn-contents.index' || $cur_route_name == 'bn-contents.edit'? 'active':'' }}">
              <a href="{{ url('backend/bn-contents') }}"><i class="fa fa-file-o"></i> News list</a>
            </li>
            <li class="{{ $cur_route_name == 'bn-content-position.index' || $cur_route_name == 'bn-content-position.create' || $cur_route_name == 'bn-content-position.edit'? 'active':'' }}">
              <a href="{{ url('backend/bn-content-position/change/1') }}"><i class="fa fa-file-o"></i> News position</a>
            </li>
          </ul>
        </li>
        <li class="treeview {{ $cur_controller_name == 'EnContentController' || $cur_controller_name == 'EnContentPositionController'? 'active':'' }}">
          <a href="#">
            <i class="fa fa-file-text-o"></i> <span>English News</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ $cur_route_name == 'en-contents.create'? 'active':'' }}">
              <a href="{{ url('backend/en-contents/create') }}"><i class="fa fa-plus-square"></i> Add English News</a>
            </li>
            <li class="{{ $cur_route_name == 'en-contents.index'? 'active':'' }}">
              <a href="{{ url('backend/en-contents') }}"><i class="fa fa-file-o"></i> English News list</a>
            </li>
            <li class="{{ $cur_route_name == 'en-content-position.index' || $cur_route_name == 'en-content-position.create' || $cur_route_name == 'en-content-position.edit'? 'active':'' }}">
              <a href="{{ url('backend/en-content-position/change/3') }}"><i class="fa fa-file-o"></i> English News position</a>
            </li>
          </ul>
        </li>
        <li class="treeview {{ $cur_controller_name == 'ManualPhotoController'? 'active':'' }}">
          <a href="#">
            <i class="fa fa-picture-o"></i> <span>Media Libary</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ $cur_route_name == 'manual-photos.create'? 'active':'' }}">
              <a href="{{ url('backend/manual-photos/create') }}"><i class="fa fa-plus-square"></i> Add New Photo</a>
            </li>
            <li class="{{ $cur_route_name == 'manual-photos.index' || $cur_route_name == 'manual-photos.edit'? 'active':'' }}">
              <a href="{{ url('backend/manual-photos') }}"><i class="fa fa-file-o"></i> Photo list</a>
            </li>
          </ul>
        </li>
        <li class="treeview {{ $cur_controller_name == 'ManualDocController'? 'active':'' }}">
          <a href="#">
            <i class="fa fa-folder-open-o"></i> <span>Documents</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ $cur_route_name == 'manual-docs.create'? 'active':'' }}">
              <a href="{{ url('backend/manual-docs/create') }}"><i class="fa fa-plus-square"></i> Add New Document</a>
            </li>
            <li class="{{ $cur_route_name == 'manual-docs.index' || $cur_route_name == 'manual-docs.edit'? 'active':'' }}">
              <a href="{{ url('backend/manual-docs') }}"><i class="fa fa-file-o"></i> Documents list</a>
            </li>
          </ul>
        </li>
        {{--<li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Photo</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('backend/photo-albums') }}"><i class="fa fa-plus-square"></i> Photo Album</a></li>
            <li><a href="{{ url('backend/photo-gallery') }}"><i class="fa fa-file-o"></i> Photo Gallery</a></li>
            <li><a href="{{ url('backend/photo-comments') }}"><i class="fa fa-file-o"></i> Photo Comment List</a></li>
            <li><a href="{{ url('backend/photo-comment-reply') }}"><i class="fa fa-file-o"></i> Photo Comment Reply List</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Video</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('backend/videos/create') }}"><i class="fa fa-plus-square"></i> Add video</a></li>
            <li><a href="{{ url('backend/videos') }}"><i class="fa fa-file-o"></i> Video list</a></li>
            <li><a href="{{ url('backend/video-comments') }}"><i class="fa fa-file-o"></i> Video Comment List</a></li>
            <li><a href="{{ url('backend/video-comment-reply') }}"><i class="fa fa-file-o"></i> Video Comment Reply List</a></li>
          </ul>
        </li>--}}

        @php
          $bn_setting_active =  $cur_controller_name == 'BnTagController' ||
              $cur_controller_name == 'BnCategoryController' ||
              $cur_controller_name == 'BnSubcategoryController' ||
              $cur_controller_name == 'BnAuthorController' ||
              $cur_controller_name == 'CountryController' ||
              $cur_controller_name == 'DivisionController' ||
              $cur_controller_name == 'DistrictController' ||
              $cur_controller_name == 'UpozillaController' ||
              $cur_controller_name == 'MonthlyFolderController' ||
              $cur_controller_name == 'BnSiteSettingsController'? 'active':'';
        @endphp

        <li class="treeview {{$bn_setting_active}}">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>Bn Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ $cur_route_name == 'bn-tags.index' || $cur_route_name == 'bn-tags.create' || $cur_route_name == 'bn-tags.edit'? 'active':'' }}">
              <a href="{{ url('backend/bn-tags') }}"><i class="fa fa-tag"></i> Bn Tag</a>
            </li>
            <li class="{{ $cur_route_name == 'bn-categories.index' || $cur_route_name == 'bn-categories.create'  || $cur_route_name == 'bn-categories.edit'? 'active':'' }}">
              <a href="{{ url('backend/bn-categories') }}"><i class="fa fa-plus-square"></i> Bn Category</a>
            </li>
            <li class="{{ $cur_route_name == 'bn-subcategories.index' || $cur_route_name == 'bn-subcategories.create'  || $cur_route_name == 'bn-subcategories.edit'? 'active':'' }}">
              <a href="{{ url('backend/bn-subcategories') }}"><i class="fa fa-file-o"></i> Bn Subcategory</a>
            </li>
            <li class="{{ $cur_route_name == 'bn-authors.index' || $cur_route_name == 'bn-authors.create'  || $cur_route_name == 'bn-authors.edit'? 'active':'' }}">
              <a href="{{ url('backend/bn-authors') }}"><i class="fa fa-file-o"></i> Bn Author</a>
            </li>
            <li class="{{ $cur_route_name == 'countries.index' || $cur_route_name == 'countries.create' || $cur_route_name == 'countries.edit'? 'active':'' }}">
              <a href="{{ url('backend/countries') }}"><i class="fa fa-plus-square"></i> Country</a>
            </li>
            <li class="{{ $cur_route_name == 'divisions.index' || $cur_route_name == 'divisions.create' || $cur_route_name == 'divisions.edit'? 'active':'' }}">
              <a href="{{ url('backend/divisions') }}"><i class="fa fa-file-o"></i> Division list</a>
            </li>
            <li class="{{ $cur_route_name == 'districts.index' || $cur_route_name == 'districts.create'? 'active':'' }}">
              <a href="{{ url('backend/districts') }}"><i class="fa fa-file-o"></i> District list</a>
            </li>
            <li class="{{ $cur_route_name == 'upozillas.index' || $cur_route_name == 'upozillas.create' || $cur_route_name == 'upozillas.edit'? 'active':'' }}">
              <a href="{{ url('backend/upozillas') }}"><i class="fa fa-file-o"></i> Upozilla list</a>
            </li>
            <li class="{{ $cur_route_name == 'monthly-folders.index' || $cur_route_name == 'monthly-folders.create' || $cur_route_name == 'monthly-folders.edit'? 'active':'' }}">
              <a href="{{ url('backend/monthly-folders') }}"><i class="fa fa-file-o"></i> Monthly folder</a>
            </li>
            <li class="{{ $cur_route_name == 'bn-site-settings.index'? 'active':'' }}"><a href="{{ url('backend/bn-site-settings') }}">
                <i class="fa fa-file-o"></i> Bn Site Settings</a>
            </li>
          </ul>
        </li>

        @php
          $en_setting_active = $cur_controller_name == 'EnTagController' ||
            $cur_controller_name == 'EnCategoryController' ||
            $cur_controller_name == 'EnSubcategoryController' ||
            $cur_controller_name == 'EnAuthorController' ||
            $cur_controller_name == 'EnSiteSettingsController'? 'active':'';
        @endphp

        <li class="treeview {{$en_setting_active}}">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>En Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ $cur_route_name == 'en-tags.index' || $cur_route_name == 'en-tags.create' || $cur_route_name == 'en-tags.edit'? 'active':'' }}">
              <a href="{{ url('backend/en-tags') }}"><i class="fa fa-tag"></i> En Tag</a>
            </li>
            <li class="{{ $cur_route_name == 'en-categories.index' || $cur_route_name == 'en-categories.create' || $cur_route_name == 'en-categories.edit'? 'active':'' }}">
              <a href="{{ url('backend/en-categories') }}"><i class="fa fa-plus-square"></i> En Category</a>
            </li>
            <li class="{{ $cur_route_name == 'en-subcategories.index' || $cur_route_name == 'en-subcategories.create' || $cur_route_name == 'en-subcategories.edit'? 'active':'' }}">
              <a href="{{ url('backend/en-subcategories') }}"><i class="fa fa-file-o"></i> En Subcategory</a>
            </li>
            <li class="{{ $cur_route_name == 'en-authors.index' || $cur_route_name == 'en-authors.create' || $cur_route_name == 'en-authors.edit'? 'active':'' }}">
              <a href="{{ url('backend/en-authors') }}"><i class="fa fa-file-o"></i> En Author</a>
            </li>
            <li class="{{ $cur_route_name == 'en-site-settings.index'? 'active':'' }}"><a href="{{ url('backend/en-site-settings') }}">
                <i class="fa fa-file-o"></i> En Site Settings</a>
            </li>
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
        <li class="treeview {{ $cur_controller_name == 'MisUserController' || $cur_controller_name == 'UserController'? 'active':'' }}">
          <a href="#">
            <i class="fa fa-users"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
            {{--<li><a href="{{ url('backend/authors') }}"><i class="fa fa-plus-square"></i> Author</a></li>--}}
            <li class="{{ $cur_route_name == 'mis-users.index' || $cur_route_name == 'mis-users.create' || $cur_route_name == 'mis-users.edit'? 'active':'' }}">
              <a href="{{ url('backend/mis-users') }}"><i class="fa fa-file-o"></i> MIS user</a>
            </li>
            @if(auth()->user()->role == 1)
              <li class="{{ $cur_route_name == 'users.index' || $cur_route_name == 'users.create' || $cur_route_name == 'users.edit' || $cur_route_name == 'users.changePassword'? 'active':'' }}">
                <a href="{{ url('backend/users') }}"><i class="fa fa-plus-square"></i> User</a>
              </li>
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