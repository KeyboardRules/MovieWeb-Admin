@extends('admin.layout.main')
@extends('admin.layout.sidebar')
@extends('admin.layout.header')
@extends('admin.layout.footer')

@section('title','Danh sách phim')
@section('content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách các bộ phim
    </div>
    @if(session()->has('message'))
      <div class="{{ session()->get('class')}}" role="alert">
        <strong>{{ session()->get('message')}}</strong>
      </div>
    @endif
    <div class="row w3-res-tb">
      <form action="{{route('movies')}}" method="get">
      <div class="col-sm-2">
        <input type="text" id="name_movie" name="name_movie" class="input-sm form-control" value="{{request()->input('name_movie')}}" placeholder="Tìm kiếm theo tên hoặc ID">
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
            <th style="width-max:30px;">Tên Phim</th>
            <th style="width-max:30px;">Ngày công chiếu</th>
            <th style="width-max:50px;">Thể loại</th>
            <th style="width:40%">Giới thiệu chung</th>
            <th style="width-min:10px;">Chi tiết</th>
          </tr>
        </thead>
        <tbody>
          @foreach($movies as $movie)
          <tr>
            <td>{{$movie->id_movie}}</td>
            <td>{{$movie->name_movie}} </td>
            <td>{{$movie->date_movie}}  </td>
            <td>
            @foreach($movie->categories as $category)
            {{$category->name_category}},
            @endforeach
            </td>
            <td>
            {{$movie->content_movie}}
            </td>
            <td><a href="{{route('movie.detail',$movie->id_movie)}}" class="btn btn-info">Chi tiết</a></td>
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