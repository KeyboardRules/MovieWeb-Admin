@extends('admin.layout.main')
@extends('admin.layout.sidebar')
@extends('admin.layout.header')
@extends('admin.layout.footer')

@section('title','Account Detail')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Chỉnh sửa thông tin
            </header>
            <div class="panel-body">
            @if(session()->has('message'))
            <div class="{{ session()->get('class')}}" role="alert">
                <strong>{{ session()->get('message')}}</strong>
            </div>
            @endif
                <form action="{{route('account.update')}}"  class="form-horizontal bucket-form" method="post">
                    @csrf
                    @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <strong>Please fix the following errors<strong>
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="col-sm-3 control-label">ID</label>
                        <div class="col-sm-8">
                            <p class="form-control-static">{{Auth::user()->id_user}}</p>
                        </div>
                    </div>
                    <div class="form-group @error('name_theater') has-error @enderror">
                        <label class="col-sm-3 control-label">Tên người dùng</label>
                        <div class="col-sm-8">
                            <input type="text" id="name_user" name="name_user" class="form-control" value="{{Auth::user()->name_user}}">
                            @error('name_user')
                                 <div class="help-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('gender_user') has-error @enderror">
                        <label class="col-sm-3 control-label">Giới tính</label>
                        <div class="col-sm-8">
                        <div class="radio">
                                <label>
                                    <input type="radio" name="gender_user" id="gender1" value="1" @if(Auth::user()->gender_user=='1') checked @endif>
                                    Nam
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="gender_user" id="gender2" value="0" @if(Auth::user()->gender_user=='0') checked @endif>
                                    Nữ
                                </label>
                            </div>
                            @error('gender_user')
                                 <div class="help-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('birth_user') has-error @enderror">
                        <label class="col-sm-3 control-label">Sinh nhật</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="birth_user" name="birth_user" value="{{Auth::user()->birth_user}}">
                            @error('birth_user')
                                 <div class="help-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="image_file">Image File</label>
                        <div class="col-sm-8">
                        <input class="form-control-file" type="file" id="image_file" disabled>
                        </div>
                    </div>                       
                    <div class="form-group @error('image_user') has-error @enderror">
                        <label class="col-sm-3 control-label">Image</label>
                        <div class="col-sm-8">
                            <input type="url" id="image_user" name="image_user" class="form-control " placeholder="URL" value="{{Auth::user()->image_user}}">
                            @error('image_user')
                                 <div class="help-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('email_user') has-error @enderror">
                        <label class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="email_user" name="email_user" placeholder="abcd@email.com" value="{{Auth::user()->email_user}}">
                            @error('email_user')
                                 <div class="help-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                         <h3 class="col-sm-offset-2 ">Thông tin đăng nhập</h3>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tài khoản</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control " id="account_user" name="account_user" value="{{Auth::user()->account_user}}" disabled>
                            @error('account_user')
                                 <div class="help-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('old_password') has-error @enderror">
                        <label class="col-sm-3 control-label">Mật khẩu cũ</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="old_password" name="old_password">
                            @error('old_password')
                                 <div class="help-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('new_password') has-error @enderror">
                        <label class="col-sm-3 control-label">Mật khẩu mới</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control " id="new_password" name="new_password">
                            @error('new_password')
                                 <div class="help-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('confirm_password') has-error @enderror">
                        <label class="col-sm-3 control-label">Xác nhận mật khẩu mới</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                            @error('confirm_password')
                                 <div class="help-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-4 col-lg-10">
                            <button type="submit" class="btn btn-info">Xác nhận</button>
                            <a class="btn btn-default" href="{{route('account')}}">Hủy</a>  
                        </div> 
                        <div class="col-lg-offset-6">
                        </div> 
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection