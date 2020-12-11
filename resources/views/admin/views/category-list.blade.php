@extends('admin.layout.main')
@extends('admin.layout.sidebar')
@extends('admin.layout.header')
@extends('admin.layout.footer')

@section('title','Danh sách thể loại')
@section('content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách các thể loại
    </div>
    @if(session()->has('message'))
      <div class="{{ session()->get('class')}}" role="alert">
        <strong>{{ session()->get('message')}}</strong>
      </div>
    @endif
    <div class="row w3-res-tb">
      <form action="{{route('categories')}}" method="get">
      <div class="col-sm-2">
        <input type="text" id="name_category" name="name_category" class="input-sm form-control" value="{{request()->input('name_category')}}" placeholder="Tìm kiếm theo tên hoặc ID">
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
            <th style="width-max:30px;">Thể loại</th>
            <th style="width-max:30px;">Mô tả</th>
            <th style="width-min:10px;">Chỉnh sửa</th>
            <th style="width-min:10px;">Xóa</th>
          </tr>
        </thead>
        <tbody>
          @foreach($categories as $category)
          <tr>
            <td>{{$category->id_category}}</td>
            <td>{{$category->name_category}} </td>
            <td>{{$category->description}}  </td>
            <td><a href="{{route('category.edit',$category->id_category)}}" class="btn btn-info">Chỉnh sửa</a></td>
            <td>
            <form action="{{route('category.delete',$category->id_category)}}" method="post">
              @csrf
              <button type="submit" class="btn btn-danger">Xóa</button>
            </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing {{$categories->currentPage()}} of {{$categories->lastPage()}} page</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            @if($categories->currentPage()!=1)
            <li><a href="{{ $categories->appends(request()->input())->url($categories->currentPage()-1)}}"><i class="fa fa-chevron-left"></i></a></li>
            @endif
            @if($categories->currentPage() > 3)
            <li><a href=" {{ $categories->appends(request()->input())->url(1) }} ">1</a></li>
            @endif
            @if($categories->currentPage() > 4)
            <li><a disabled>...</a></li>
            @endif

            @for($i=1;$i<=$categories->lastPage();$i++)
            @if($i >= $categories->currentPage() - 2 && $i <= $categories->currentPage() + 2)
                @if ($i == $categories->currentPage())
                    <li><a href="{{ $categories->appends(request()->input())->url($i) }}" class="btn active">{{$i}}</a></li>
                @else
                    <li><a href="{{ $categories->appends(request()->input())->url($i) }}">{{ $i }}</a></li>
                @endif
            @endif
            @endfor
            @if($categories->currentPage() < $categories->lastPage()-3)
            <li><a disabled>...</a></li>
            @endif
            @if($categories->currentPage() < $categories->lastPage()-2)
            <li><a href="{{ $categories->appends(request()->input())->url($movies->lastPage())}}">{{$categories->lastPage()}}</a></li>
            @endif

            @if($categories->currentPage()!= $categories->lastPage() and $categories->lastPage() > 1)
            <li><a href="{{ $categories->appends(request()->input())->url($categories->currentPage()+1)}}"><i class="fa fa-chevron-right"></i></a></li>
            @endif
          </ul>
        </div>
      </div>
    </footer>
@endsection