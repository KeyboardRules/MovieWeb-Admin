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
                Thêm rạp đã chiếu phim {{$movie->name_movie}}
            </header>
            <div class="panel-body">
                <form action="{{route('movie-theaters.editSubmit',$movie->id_movie)}}" class="form-horizontal bucket-form" method="post">
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
                    <div class="form-group @error('theater') has-error @enderror">
                        <label class="col-sm-3 control-label">Rạp phim</label>
                        <div class="col-sm-8">
                            <input autocomplete="off" type="text" class="form-control" id="theater" name="theater" value="">
                            @error('theater')
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
      Danh sách rạp chiếu phim {{$movie->name_movie}}
    </div>
    @if(session()->has('delete_message'))
      <div class="{{ session()->get('class')}}" role="alert">
        <strong>{{ session()->get('delete_message')}}</strong>
      </div>
    @endif
    <div class="row w3-res-tb">
      <form action="{{route('movie-theaters',$movie->id_movie)}}" method="get">
        <div class="col-sm-2">
          <input type="text" id="id_theater" name="id_theater" class="input-sm form-control" value="" placeholder="Tìm kiếm theo ID">
        </div>
        <div class="col-sm-2">
          <input type="text" id="name_theater" name="name_theater" class="input-sm form-control" value="" placeholder="Tìm kiếm theo tên">
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
            <th style="width-max:60px;">Tên Rạp</th>
            <th style="width-max:60px;">Từ ngày</th>
            <th style="width-max:60px;">Đến ngày</th>
            <th style="width-min:10px;">Chi tiết rạp</th>
            <th style="width-min:10px;">Xóa</th>
          </tr>
        </thead>
        <tbody>
        @foreach($theaters as $theater)
          <tr>
            <td>{{$theater->id_theater}}</td>
            <td>{{$theater->name_theater}} </td>
            <td>{{Carbon\Carbon::parse($theater->pivot->from_date)->format('M d Y')}}</td>
            <td>{{Carbon\Carbon::parse($theater->pivot->to_date)->format('M d Y')}}</td>
            <td><a href="{{route('theater.detail',$theater->id_theater)}}" class="btn btn-info">Chi tiết</a></td>
            <td><a href="{{route('movies-theaters.delete',['theater'=>$theater->id_theater,'movie'=>$movie->id_movie])}}" class="btn btn-danger">Xóa</a></td>
          </tr> 
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing {{$theaters->currentPage()}} of {{$theaters->lastPage()}} page</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            @if($theaters->currentPage()!=1)
            <li><a href="{{ $theaters->appends(request()->input())->url($theaters->currentPage()-1)}}"><i class="fa fa-chevron-left"></i></a></li>
            @endif
            @if($theaters->currentPage() > 3)
            <li><a href=" {{ $theaters->appends(request()->input())->url(1) }} ">1</a></li>
            @endif
            @if($theaters->currentPage() > 4)
            <li><a disabled>...</a></li>
            @endif

            @for($i=1;$i<=$theaters->lastPage();$i++)
            @if($i >= $theaters->currentPage() - 2 && $i <= $theaters->currentPage() + 2)
                @if ($i == $theaters->currentPage())
                    <li><a href="{{ $theaters->appends(request()->input())->url($i) }}" class="btn active">{{$i}}</a></li>
                @else
                    <li><a href="{{ $theaters->appends(request()->input())->url($i) }}">{{ $i }}</a></li>
                @endif
            @endif
            @endfor

            @if($theaters->currentPage() < $theaters->lastPage()-3)
            <li><a disabled>...</a></li>
            @endif
            @if($theaters->currentPage() < $theaters->lastPage()-2)
            <li><a href="{{ $theaters->appends(request()->input())->url($theaters->lastPage())}}">{{$theaters->lastPage()}}</a></li>
            @endif

            @if($theaters->currentPage()!= $theaters->lastPage() and $theaters->lastPage() > 1)
            <li><a href="{{ $theaters->appends(request()->input())->url($theaters->currentPage()+1)}}"><i class="fa fa-chevron-right"></i></a></li>
            @endif
          </ul>
        </div>
      </div>
    </footer>
@endsection