@extends('admin.layout.main')
@extends('admin.layout.sidebar')
@extends('admin.layout.header')
@extends('admin.layout.footer')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thông tin rạp chiếu phim
            </header>
            <div class="panel-body">
            @if($id!=0)
            @section('title','Edit '.$theater->name_theater)
                <form action="{{route('theater.editSubmit',$id)}}"  class="form-horizontal bucket-form" method="post" enctype="multipart/form-data">
            @else
            @section('title','Thêm mới rạp')
                <form action="{{route('theater.createSubmit')}}" class="form-horizontal bucket-form" method="post" enctype="multipart/form-data">
            @endif
                    @csrf
                    @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <strong>Please fix the following errors<strong>
                    </div>
                    @endif
                    @if($id!=0)
                    <div class="form-group">
                        <label class="col-sm-3 control-label">ID</label>
                        <div class="col-sm-8">
                            <p class="form-control-static">{{$theater->id_theater}}</p>
                        </div>
                    </div>
                    @endif
                    <div class="form-group @error('name_theater') has-error @enderror">
                        <label class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" id="name_theater" name="name_theater" class="form-control" value="{{$theater->name_theater ?? old('name_theater')}}">
                            @error('name_theater')
                                 <div class="help-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('address_theater') has-error @enderror">
                        <label class="col-sm-3 control-label">Address</label>
                        <div class="col-sm-8">
                            <input type="text" id="address_theater" name="address_theater" class="form-control" value="{{$theater->address_theater ?? old('address_theater')}}">
                            @error('address_theater')
                                 <div class="help-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('image_file') has-error @enderror">
                        <label class="col-sm-3 control-label" for="image_file">Image File</label>
                        <div class="col-sm-8">
                            <input class="form-control-file" type="file" id="image_file" name="image_file">
                            @error('image_file')
                                <div class="help-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('description_theater') has-error @enderror">
                        <label class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="description_theater" name="description_theater" type="text">{{$theater->description_theater ?? old('description_theater')}}</textarea>
                            @error('description_theater')
                                 <div class="help-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-4 col-lg-10">
                            <button type="submit" class="btn btn-info">Xác nhận</button>
                            <a class="btn btn-default" href="{{ route('theater.detail',$id) }}">Hủy</a>  
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