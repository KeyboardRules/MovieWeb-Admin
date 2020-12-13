@extends('admin.layout.main')
@extends('admin.layout.sidebar')
@extends('admin.layout.header')
@extends('admin.layout.footer')

@section('title','Danh sách rạp chiếu phim')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm phim đã chiếu tại rạp {{$theater->name_theater}}
            </header>
            <div class="panel-body">
                <form action="{{route('theater-movies.editSubmit',$theater->id_theater)}}" class="form-horizontal bucket-form" method="post">
                    @csrf
                    @if(session()->has('add_message'))
                    <div class="{{ session()->get('class')}}" role="alert">
                      <strong>{{ session()->get('add_message')}}</strong>
                    </div>
                    @endif
                    @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <strong>Please fix the following errors<strong>
                    </div>
                    @endif
                    <div class="form-group @error('movie') has-error @enderror">
                        <label class="col-sm-3 control-label">Tên phim</label>
                        <div class="col-sm-8">
                            <input autocomplete="off" type="text" class="form-control" id="movie" name="movie" value="">
                            @error('movie')
                                 <div class="help-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('from_date') has-error @enderror">
                        <label class="col-sm-3 control-label">Từ ngày</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="from_date" name="from_date">
                            @error('from_date')
                                 <div class="help-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('to_date') has-error @enderror">
                        <label class="col-sm-3 control-label">Đến ngày</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="to_date" name="to_date">
                            @error('to_date')
                                 <div class="help-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-4 col-lg-10">
                            <button type="submit" class="btn btn-info">Xác nhận</button>
                            <a class="btn btn-default" href="{{ route('categories') }}">Hủy</a>  
                        </div> 
                        <div class="col-lg-offset-6">
                        </div> 
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách những bộ phim của rạp {{$theater->name_theater}}
    </div>
    @if(session()->has('delete_message'))
      <div class="{{ session()->get('class')}}" role="alert">
        <strong>{{ session()->get('delete_message')}}</strong>
      </div>
    @endif
    <div class="row w3-res-tb">
      <form action="{{route('theater-movies',$theater->id_theater)}}" method="get">
        <div class="col-sm-2">
          <input type="text" id="id_movie" name="id_movie" class="input-sm form-control" value="" placeholder="Tìm kiếm theo ID">
        </div>
        <div class="col-sm-2">
          <input type="text" id="name_movie" name="name_movie" class="input-sm form-control" value="" placeholder="Tìm kiếm theo tên">
        </div>
        <div class="col-sm-2">
            <select id="category" name="category" class="form-control input-sm">
                <!-- <option value="0" disabled selected hidden>Chọn thể loại</option> -->
                @if(request()->input('category')=="")
                <option value="" selected>Tất cả thể loại</option>
                @else
                <option value="">Tất cả</option>
                @endif
                @foreach($categories as $category)
                @if($category->id_category==request()->input('category'))
                <option value="{{$category->id_category}}" selected>{{$category->name_category}}</option>
                @else
                <option value="{{$category->id_category}}">{{$category->name_category}}</option>
                @endif
                @endforeach
            </select>
      </div>
        <div class="col-sm-2">
          <button class="btn btn-sm btn-default" type="submit">Tìm kiếm</button>
        </div>
      </form>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width-min:10px;">ID</th>
            <th style="width-max:60px;">Tên Phim</th>
            <th style="width-max:30px;">Từ ngày</th>
            <th style="width-max:30px;">Đến ngày</th>
            <th style="width-max:60px;">Thể loại</th>
            <th style="width-min:10px;">Chi tiết phim</th>
            <th style="width-min:10px;">Xóa</th>
          </tr>
        </thead>
        <tbody>
        @foreach($movies as $movie)
          <tr>
            <td>{{$movie->id_movie}}</td>
            <td>{{$movie->name_movie}} </td>
            <td>{{Carbon\Carbon::parse($movie->pivot->from_date)->format('M d Y')}}</td>
            <td>{{Carbon\Carbon::parse($movie->pivot->to_date)->format('M d Y')}}</td>
            <td>
            @foreach($movie->categories as $category)
            {{$category->name_category}},
            @endforeach
            </td>
            <td><a href="{{route('movie.detail',$movie->id_movie)}}" class="btn btn-info">Chi tiết</a></td>
            <td><a href="{{route('movies-theaters.delete',['movie'=>$movie->id_movie,'theater'=>$theater->id_theater])}}" class="btn btn-danger">Xóa</a></td>
          </tr> 
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing {{$movies->currentPage()}} of {{$movies->lastPage()}} page</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            @if($movies->currentPage()!=1)
            <li><a href="{{ $movies->appends(request()->input())->url($movies->currentPage()-1)}}"><i class="fa fa-chevron-left"></i></a></li>
            @endif
            @if($movies->currentPage() > 3)
            <li><a href=" {{ $movies->appends(request()->input())->url(1) }} ">1</a></li>
            @endif
            @if($movies->currentPage() > 4)
            <li><a disabled>...</a></li>
            @endif

            @for($i=1;$i<=$movies->lastPage();$i++)
            @if($i >= $movies->currentPage() - 2 && $i <= $movies->currentPage() + 2)
                @if ($i == $movies->currentPage())
                    <li><a href="{{ $movies->appends(request()->input())->url($i) }}" class="btn active">{{$i}}</a></li>
                @else
                    <li><a href="{{ $movies->appends(request()->input())->url($i) }}">{{ $i }}</a></li>
                @endif
            @endif
            @endfor

            @if($movies->currentPage() < $movies->lastPage()-3)
            <li><a disabled>...</a></li>
            @endif
            @if($movies->currentPage() < $movies->lastPage()-2)
            <li><a href="{{ $movies->appends(request()->input())->url($movies->lastPage())}}">{{$movies->lastPage()}}</a></li>
            @endif

            @if($movies->currentPage()!= $movies->lastPage() and $movies->lastPage() > 1)
            <li><a href="{{ $movies->appends(request()->input())->url($movies->currentPage()+1)}}"><i class="fa fa-chevron-right"></i></a></li>
            @endif
          </ul>
        </div>
      </div>
    </footer>
@endsection