@extends('admin.layout.main')
@extends('admin.layout.sidebar')
@extends('admin.layout.header')
@extends('admin.layout.footer')

@section('title','Danh sách rạp chiếu phim')
@section('content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách rạp chiếu phim
    </div>
    @if(session()->has('message'))
      <div class="{{ session()->get('class')}}" role="alert">
        <strong>{{ session()->get('message')}}</strong>
      </div>
    @endif
    <div class="row w3-res-tb">
      <form action="{{route('theaters')}}" method="get">
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" id="name_theater" name="name_theater" class="input-sm form-control" value="{{request()->input('name_theater')}}" placeholder="Tìm kiếm theo tên hoặc ID">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="submit">Tìm kiếm</button>
          </span>
        </div>
      </div>
      </form>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width-min:10px;">ID</th>
            <th style="width-max:60px;">Tên Rạp</th>
            <th style="width-max:60px;">Địa chỉ rạp</th>
            <th style="width:50%">Giới thiệu chung</th>
            <th style="width-min:10px;">Chi tiết</th>
          </tr>
        </thead>
        <tbody>
          @foreach($theaters as $theater)
          <tr>
            <td>{{$theater->id_theater}}</td>
            <td>{{$theater->name_theater}} </td>
            <td>{{$theater->address_theater}}  </td>
            <td>
            {{$theater->description_theater}}
            </td>
            <td><a href="{{route('theater.detail',$theater->id_theater)}}" class="btn btn-info">Chi tiết</a></td>
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