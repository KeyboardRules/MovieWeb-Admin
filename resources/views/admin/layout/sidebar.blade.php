@section('sidebar')
<div id="sidebar" class="nav-collapse">
    <!-- sidebar menu start-->
    <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a href="{{route('main')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Thông tin chung</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-film"></i>
                        <span>Phim</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('movies')}}">Danh sách phim</a></li>
						<li><a href="{{route('movie.create')}}">Thêm mới phim</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-list-alt"></i>
                        <span>Thể loại phim</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('categories')}}">Danh sách thể loại</a></li>
						<li><a href="{{route('category.create')}}">Thêm mới thể loại</a></li>
                    </ul>
                </li>
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-video-camera"></i>
                        <span>Rạp phim</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('theaters')}}">Danh sách rạp</a></li>
						<li><a href="{{route('theater.create')}}">Thêm mới rạp</a></li>
                    </ul>
                </li>
				<li>
                    <a href="{{route('users')}}">
                        <i class="fa fa-users"></i>
                        <span>Danh sách người dùng</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="fa fa-file-text"></i>
                        <span>Danh sách Blog</span>
                    </a>
                </li>
            </ul>            
		</div>
    <!-- sidebar menu end-->
</div>
    @endsection