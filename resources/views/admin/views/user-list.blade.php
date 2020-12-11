@extends('admin.layout.main')
@extends('admin.layout.sidebar')
@extends('admin.layout.header')
@extends('admin.layout.footer')

@section('title','Danh sách người dùng')
@section('content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách Người dùng
    </div>
    @if(session()->has('message'))
      <div class="{{ session()->get('class')}}" role="alert">
        <strong>{{ session()->get('message')}}</strong>
      </div>
    @endif
    <div class="row w3-res-tb">
      <form action="{{route('users')}}" method="get">
      <div class="col-sm-2">
          <input type="text" id="name_user" name="name_user" class="input-sm form-control" value="{{request()->input('name_user')}}" placeholder="Tìm kiếm theo tên hoặc ID">
      </div>
      <div class="col-sm-2">
            <select id="auth_user" name="auth_user" class="form-control input-sm">
                <!-- <option value="0" disabled selected hidden>Chọn quyền hạn của người dùng</option> -->
                @if(request()->input('auth_user')=="")
                <option value="" selected>Tất cả quyền hạn</option>
                @else
                <option value="">Tất cả</option>
                @endif
                @foreach($auths as $auth)
                @if($auth->id_auth==request()->input('auth_user'))
                <option value="{{$auth->id_auth}}" selected>{{$auth->name_auth}}</option>
                @else
                <option value="{{$auth->id_auth}}">{{$auth->name_auth}}</option>
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
            <th style="width-max:60px;">Tên người dùng</th>
            <th style="width-max:10px;">Giới tính</th>
            <th style="width-max:30px;">Sinh nhật</th>
            <th style="width-max:10px;">Quyền hạn</th>
            <th style="width-min:10px;">Chi tiết</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr>
            <td>{{$user->id_user}}</td>
            <td>{{$user->name_user}} </td>
            @if($user->gender_user==1)
            <td>Nam</td>
            @else
            <td>Nữ</td>
            @endif
            <td>{{$user->birth_user}} </td>
            <td>{{$user->auth->name_auth}}</td>
            <td><a href="{{route('user.detail',$user->id_user)}}" class="btn btn-info">Detail</a></td>
          </tr> 
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing {{$users->currentPage()}} of {{$users->lastPage()}} page</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            @if($users->currentPage()!=1)
            <li><a href="{{ $users->appends(request()->input())->url($users->currentPage()-1)}}"><i class="fa fa-chevron-left"></i></a></li>
            @endif
            @if($users->currentPage() > 3)
            <li><a href=" {{ $users->appends(request()->input())->url(1) }} ">1</a></li>
            @endif
            @if($users->currentPage() > 4)
            <li><a disabled>...</a></li>
            @endif

            @for($i=1;$i<=$users->lastPage();$i++)
            @if($i >= $users->currentPage() - 2 && $i <= $users->currentPage() + 2)
                @if ($i == $users->currentPage())
                    <li><a href="{{ $users->appends(request()->input())->url($i) }}" class="btn active">{{$i}}</a></li>
                @else
                    <li><a href="{{ $users->appends(request()->input())->url($i) }}">{{ $i }}</a></li>
                @endif
            @endif
            @endfor

            @if($users->currentPage() < $users->lastPage()-3)
            <li><a disabled>...</a></li>
            @endif
            @if($users->currentPage() < $users->lastPage()-2)
            <li><a href="{{ $users->appends(request()->input())->url($users->lastPage())}}">{{$users->lastPage()}}</a></li>
            @endif

            @if($users->currentPage()!= $users->lastPage() and $users->lastPage() > 1)
            <li><a href="{{ $users->appends(request()->input())->url($users->currentPage()+1)}}"><i class="fa fa-chevron-right"></i></a></li>
            @endif
          </ul>
        </div>
      </div>
    </footer>
@endsection