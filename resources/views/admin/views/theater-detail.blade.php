@extends('admin.layout.main')
@extends('admin.layout.sidebar')
@extends('admin.layout.header')
@extends('admin.layout.footer')

@section('title',$theater->name_theater)
@section('content')
<link href="{{asset('resources/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
<link href="{{asset('resources/css/style2.css')}}" rel='stylesheet' type='text/css'/>
<link href="{{asset('resources/css/medile.css')}}" rel='stylesheet' type='text/css'/>


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
<div class="row">
    <div class="col-lg-12">
        <section class="panel"> 
            <header class="panel-heading">
                Thông tin rạp chiếu phim
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
                                <img style="max-width:100%;"  width="auto" height="400" @if($theater->image_theater!=null) src="{{$theater->image_theater}}" @else src="{{asset('resources/images/theater.png')}}" @endif alt="image of theater">
                                <p style="margin-top:5px;"><em>Ảnh rạp</em></p>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-sm-7">
                    <section class="panel">
                        <div class="panel-body">
                            <div class="form-horizontal bucket-form">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Mã ID</label>
                                    <div class="col-sm-8">
                                        <p class="form-control-static">{{$theater->id_theater}}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                        <label class="col-sm-3 control-label">Tên rạp</label>
                        <div class="col-sm-8">
                            <p class="form-control-static">{{$theater->name_theater}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Địa chỉ</label>
                        <div class="col-sm-8">
                            <p class="form-control-static">{{$theater->address_theater}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Giới thiệu chung</label>
                        <div class="col-sm-8">
                            <p class="form-control-static">{{$theater->description_theater}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-10">
                            <form action="{{route('theater.delete',$theater->id_theater)}}" method="post">
                                @csrf
                                <a class="btn btn-primary" href="{{route('theater.edit',$theater->id_theater)}}">Chỉnh sửa</a>
                                <a class="btn btn-info" href="{{route('theater-movies',$theater->id_theater)}}">Những phim từng chiếu tại rạp</a>  
                                <button type="submit" class="btn btn-danger">Xóa</button>
                                <a class="btn btn-default" href="{{route('theaters')}}">Về danh sách</a>  
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
                Top 10 bộ phim từng chiếu tại rạp
            </header>
            <div class="w3_agile_banner_bottom_grid">
				<div id="owl-demo" class="owl-carousel owl-theme">
                    @foreach($theater->movies->sortByDesc('score()')->take(10) as $movie)
					<div class="item">
						<div class="w3l-movie-gride-agile w3l-movie-gride-agile1">
							<a href="{{route('movie.detail',$movie->id_movie)}}" class="hvr-shutter-out-horizontal"><img @if($movie->image_movie!=null) src="{{$movie->image_movie}}" @else src="{{asset('resources/images/movie.jpg')}}" @endif title="album-name" class="img-responsive" alt=" " />
								<div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
							</a>
							<div class="mid-1 agileits_w3layouts_mid_1_home">
								<div class="w3l-movie-text">
									<h6><a href="{{route('movie.detail',$movie->id_movie)}}">{{$movie->name_movie}}</a></h6>							
								</div>
								<div class="mid-2 agile_mid_2_home">
									<p>{{ Carbon\Carbon::parse($movie->date_movie)->format('Y')}}</p>
									<div class="block-stars">
										<ul class="w3l-ratings">
                                            <li><i class="fa fa-lg @if($movie->score()<1&&$movie->score()>0) fa-star-half-o @elseif($movie->score()>=1) fa-star @else fa-star-o @endif" aria-hidden="true"></i></li>
									        <li><i class="fa fa-lg @if($movie->score()<2&&$movie->score()>1) fa-star-half-o @elseif($movie->score()>=2) fa-star @else fa-star-o @endif" aria-hidden="true"></i></li>
									        <li><i class="fa fa-lg @if($movie->score()<3&&$movie->score()>2) fa-star-half-o @elseif($movie->score()>=3) fa-star @else fa-star-o @endif" aria-hidden="true"></i></li>
									        <li><i class="fa fa-lg @if($movie->score()<4&&$movie->score()>3) fa-star-half-o @elseif($movie->score()>=4) fa-star @else fa-star-o @endif" aria-hidden="true"></i></li>
									        <li><i class="fa fa-lg @if($movie->score()<5&&$movie->score()>4) fa-star-half-o @elseif($movie->score()>=5) fa-star @else fa-star-o @endif" aria-hidden="true"></i></li>
										</ul>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="ribben">
								<p>NEW</p>
							</div>
						</div>
                    </div>
                    @endforeach
				</div>
            </div>
       </section>
    </div>
<div>
@endsection