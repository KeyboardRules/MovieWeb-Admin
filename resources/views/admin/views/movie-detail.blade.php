@extends('admin.layout.main')
@extends('admin.layout.sidebar')
@extends('admin.layout.header')
@extends('admin.layout.footer')

@section('title',$movie->name_movie)
@section('content')
<link href="{{asset('resources/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
<link href="{{asset('resources/css/medile.css')}}" rel='stylesheet' type='text/css'/>
<link href="{{asset('resources/css/single.css')}}" rel='stylesheet' type='text/css'/>

<link href="{{asset('resources/css/owl.carousel.css')}}" rel="stylesheet" type="text/css" media="all">
<script src="{{asset('resources/js/owl.carousel.js')}}"></script>
<script>
	$(document).ready(function() { 
		$("#owl-demo").owlCarousel({
	 
		  autoPlay: 3000, //Set AutoPlay to 3 seconds
	 
		  items : 5,
		  itemsDesktop : [640,4],
		  itemsDesktopSmall : [414,3]
	 
		});
	 
	}); 
</script> 
<!-- //banner-bottom-plugin -->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300' rel='stylesheet' type='text/css'>
<div class="row">
    <div class="col-lg-12">
        <section class="panel"> 
            <header class="panel-heading">
                Thông tin phim
            </header>
            <div class="panel-body">
            @if(session()->has('message'))
            <div class="{{ session()->get('class')}}" role="alert">
                <strong>{{ session()->get('message')}}</strong>
            </div>
            @endif
                <div class="col-sm-5">
                    <section class="panel">
                        <div class="panel-body">
                            <div class="cover text-center" style="width=100%">
                                <img style="max-width:100%;" width="auto" height="400" src="{{$movie->image_movie}}" alt="image of movie">
                                <p style="margin-top:5px;"><em>Ảnh poster</em></p>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-sm-7">
                    <section class="panel">
                        <div class="panel-body">
                            <div class="form-horizontal bucket-form">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Mã Phim</label>
                                    <div class="col-sm-8">
                                        <p class="form-control-static">{{$movie->id_movie}}</p>
                                    </div>
                                </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tên phim</label>
                        <div class="col-sm-8">
                            <p class="form-control-static">{{$movie->name_movie}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Thể loại</label>
                        <div class="col-sm-8">
                        <p class="form-control-static">
                        @foreach($movie->categories as $category)
                        {{$category->name_category}},
                        @endforeach
                        </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Độ dài</label>
                        <div class="col-sm-8">
                            <p class="form-control-static">{{$movie->length_movie}} phút</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Ngày công chiếu</label>
                        <div class="col-sm-8">
                        <p class="form-control-static">{{$movie->date_movie}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Số lượt đánh giá</label>
                        <div class="col-sm-8">
                        <p class="form-control-static">{{$movie->reviews->count()}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Điểm số</label>
                        <div class="col-sm-8" style="margin:5px 0px;">
                            <div class="block-stars" style="float:left;">
								<ul class="w3l-ratings">
									<li><i class="fa fa-lg @if($movie->score()<1&&$movie->score()>0) fa-star-half-o @elseif($movie->score()>=1) fa-star @else fa-star-o @endif" aria-hidden="true"></i></li>
									<li><i class="fa fa-lg @if($movie->score()<2&&$movie->score()>1) fa-star-half-o @elseif($movie->score()>=2) fa-star @else fa-star-o @endif" aria-hidden="true"></i></li>
									<li><i class="fa fa-lg @if($movie->score()<3&&$movie->score()>2) fa-star-half-o @elseif($movie->score()>=3) fa-star @else fa-star-o @endif" aria-hidden="true"></i></li>
									<li><i class="fa fa-lg @if($movie->score()<4&&$movie->score()>3) fa-star-half-o @elseif($movie->score()>=4) fa-star @else fa-star-o @endif" aria-hidden="true"></i></li>
									<li><i class="fa fa-lg @if($movie->score()<5&&$movie->score()>4) fa-star-half-o @elseif($movie->score()>=5) fa-star @else fa-star-o @endif" aria-hidden="true"></i></li>
								</ul>
							</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-10">
                            <form action="{{route('movie.delete',$movie->id_movie)}}" method="post">
                                @csrf
                                <a class="btn btn-primary" href="{{route('movie.edit',$movie->id_movie)}}">Chỉnh sửa</a>  
                                <button type="submit" class="btn btn-danger">Xóa</button>
                                <a class="btn btn-default" href="{{route('movies')}}">Về danh sách</a>  
                            </form>
                        </div> 
                    </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
        <section class="panel">
            <header class="panel-heading">
                Giới thiệu phim
            </header>
            <div class="panel-body">
            <h3 class="hdg">Trailer</h3>
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
            <div class="embed-responsive embed-responsive-16by9">
            <iframe width="560" height="315" src="{{$movie->trailer_movie}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            </div>
            <div class="col-sm-2"></div>
            <div class="col-sm-12" style="margin-top:50px;">
            <h3 class="hdg">Nội dung</h3>
				<div class="tab-content">
					<div class="tab-pane active" id="domprogress">
                        <p>{{$movie->content_movie}}</P>
                    </div>
                </div>
            </div>
        </section>
        <section class="panel">
            <header class="panel-heading">
                Những rạp đang chiếu phim {{$movie->name_movie}}
            </header>
            <div class="w3_agile_banner_bottom_grid">
                @if($movie->theaters->count()==0)
                <h3 style="text-align:center;">Hiện tại không có rạp nào chiếu bộ phim này</h3>
                @endif
				<div id="owl-demo" class="owl-carousel owl-theme">
                    @foreach($movie->theaters as $theater)
					<div class="item">
						<div class="w3l-movie-gride-agile w3l-movie-gride-agile1">
							<a href="{{route('theater.detail',$theater->id_theater)}}" class="hvr-shutter-out-horizontal"><img src="{{$theater->image_theater}}" title="album-name" class="img-responsive" alt=" " />
								<div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
							</a>
							<div class="mid-1 agileits_w3layouts_mid_1_home">
								<div class="w3l-movie-text">
									<h6><a href="{{route('theater.detail',$theater->id_theater)}}">{{$theater->name_theater}}</a></h6>							
								</div>
							</div>
							<!-- <div class="ribben">
								<p>NEW</p>
							</div> -->
						</div>
                    </div>
                    @endforeach
			</div>
        </section>
        <!-- comment -->
        <section class="panel">
            <header class="panel-heading">
                Đánh giá và bình luận
            </header>
            <div class="panel-body">
               @if($reviews->count()==0)
                </br>
				<h3 style="text-align:center;">Phim chưa có đánh giá nào.</h3>
				@else
				@foreach($reviews as $review)
				<div class="panel media">
				 <h5>
					<a href="{{route('user.detail',$review->user->id_user)}}"><h3 style="display:inline-block;">{{$review->user->name_user}}   </h3></a> 
				    <a href="{{route('movie.detail',$review->movie->id_movie)}}">{{ Carbon\Carbon::parse($review->created_at)->format('M d Y')}}</a>
                </h5>
					<div class="media-left">
					 <a href="{{route('user.detail',$review->user->id_user)}}">
						<img style="width: 40px;height: 40px;" src="{{$review->user->image_user}}" title="One movies" alt=" " />
						</a>
					</div>
						<div class="media-body">
							<p>{{$review->content_review}}</p>
						<div class="block-stars" style="float:left;">
							<ul class="w3l-ratings">
								<li><i class="fa @if($review->score_review<1&&$review->score_review>0) fa-star-half-o @elseif($review->score_review>=1) fa-star @else fa-star-o @endif" aria-hidden="true"></i></li>
								<li><i class="fa @if($review->score_review<2&&$review->score_review>1) fa-star-half-o @elseif($review->score_review>=2) fa-star @else fa-star-o @endif" aria-hidden="true"></i></li>
								<li><i class="fa @if($review->score_review<3&&$review->score_review>2) fa-star-half-o @elseif($review->score_review>=3) fa-star @else fa-star-o @endif" aria-hidden="true"></i></li>
								<li><i class="fa @if($review->score_review<4&&$review->score_review>3) fa-star-half-o @elseif($review->score_review>=4) fa-star @else fa-star-o @endif" aria-hidden="true"></i></li>
								<li><i class="fa @if($review->score_review<5&&$review->score_review>4) fa-star-half-o @elseif($review->score_review>=5) fa-star @else fa-star-o @endif" aria-hidden="true"></i></li>
							</ul>
						</div>
						</div>
						</div>
						@endforeach
						@endif
		@if($reviews->count()!=0)
        <div class="blog-pagenat-wthree">                
          <ul>
            @if($reviews->currentPage()!=1)
            <li><a href="{{ $reviews->appends(request()->input())->url($reviews->currentPage()-1)}}"><i class="fa fa-chevron-left"></i></a></li>
            @endif
            @if($reviews->currentPage() > 3)
            <li><a href=" {{ $reviews->appends(request()->input())->url(1) }} ">1</a></li>
            @endif
            @if($reviews->currentPage() > 4)
            <li><a disabled>...</a></li>
            @endif

            @for($i=1;$i<=$reviews->lastPage();$i++)
            @if($i >= $reviews->currentPage() - 2 && $i <= $reviews->currentPage() + 2)
                @if ($i == $reviews->currentPage())
                    <li><a href="{{ $reviews->appends(request()->input())->url($i) }}" class="frist">{{$i}}</a></li>
                @else
                    <li><a href="{{ $reviews->appends(request()->input())->url($i) }}">{{ $i }}</a></li>
                @endif
            @endif
            @endfor
            @if($reviews->currentPage() < $reviews->lastPage()-3)
            <li><a disabled>...</a></li>
            @endif
            @if($reviews->currentPage() < $reviews->lastPage()-2)
            <li><a href="{{ $reviews->appends(request()->input())->url($reviews->lastPage())}}">{{$movies->lastPage()}}</a></li>
            @endif
            @if($reviews->currentPage()!= $reviews->lastPage() and $reviews->lastPage() > 1)
            <li><a href="{{ $reviews->appends(request()->input())->url($reviews->currentPage()+1)}}"><i class="fa fa-chevron-right"></i></a></li>
            @endif
          </ul>
        </div>
        @endif
        </div>
        </section>
    </div>
<div>

@endsection