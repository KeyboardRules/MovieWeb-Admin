@extends('admin.layout.main')
@extends('admin.layout.sidebar')
@extends('admin.layout.header')
@extends('admin.layout.footer')

@section('title','Account Edit')
@section('content')
<link href="{{asset('resources/css/medile.css')}}" rel='stylesheet' type='text/css'/>
<link href="{{asset('resources/css/single.css')}}" rel='stylesheet' type='text/css'/>
<div class="row">
    <div class="col-lg-12">
        <section class="panel"> 
            <header class="panel-heading">
                Thông tin tài khoản
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
                            <div class="cover text-center" style="width:100%">
                                <img style="max-width:100%;" width="auto" height="400" @if(Auth::user()->image_user!=null) src="{{Auth::user()->image_user}}" @else src="{{asset('resources/images/avatar.png')}}" @endif alt="image of account">
                                <p style="margin-top:5px;"><em>Ảnh đại diện</em></p>
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
                                        <p class="form-control-static">{{Auth::user()->id_user}}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                        <label class="col-sm-3 control-label">Tên người dùng</label>
                        <div class="col-sm-8">
                            @if(Auth::user()->name_user!=null)
                            <p class="form-control-static">{{Auth::user()->name_user}}</p>
                            @else
                            <p class="form-control-static"><em>{{Auth::user()->auth->name_auth.' '.Auth::user()->id_user}}</em></p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Giới tính</label>
                        <div class="col-sm-8">
                            @if(Auth::user()->id_user==1)
                            <p class="form-control-static">Nam</p>
                            @else
                            <p class="form-control-static">Nữ</p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Ngày sinh</label>
                        <div class="col-sm-8">
                            <p class="form-control-static">{{Carbon\Carbon::parse(Auth::user()->birth_user)->format('M d Y')}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Địa chỉ Email</label>
                        <div class="col-sm-8">
                            @if(Auth::user()->email_user!=null)
                            <p class="form-control-static">{{Auth::user()->email_user}}</p>
                            @else
                            <p class="text-warning" class="form-control-static"><em>Không có</em></p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Quyền hạn</label>
                        <div class="col-sm-8">
                            <p class="form-control-static">{{Auth::user()->auth->name_auth}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-10">
                            <a class="btn btn-info" href="{{route('account.setting')}}">Chỉnh sửa thông tin</a>  
                        </div> 
                    </div>
                            </div>
                        </div>
                    </section>
                </div>
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
				<h3 style="text-align:center;">Người dùng chưa có đánh giá nào.</h3>
				@else
				@foreach($reviews as $review)
				<div class="panel media">
				 <h5>
					<a href="{{route('user.detail',$review->user->id_user)}}"><h3 style="display:inline-block;">{{$review->user->name_user}}   </h3></a> 
				    <a href="{{route('movie.detail',$review->movie->id_movie)}}">{{ Carbon\Carbon::parse($review->created_at)->format('M d Y')}}</a>
                </h5>
					<div class="media-left">
					 <a href="{{route('user.detail',$review->user->id_user)}}">
						<img style="width: 40px;height: 40px;" @if($review->user->image_user!=null) src="{{$review->user->image_user}}" @else src="{{asset('resources/images/avatar.png')}}" @endif title="One movies" alt=" " />
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