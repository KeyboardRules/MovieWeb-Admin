@extends('admin.layout.main')
@extends('admin.layout.sidebar')
@extends('admin.layout.header')
@extends('admin.layout.footer')


@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thông tin thể loại
            </header>
            <div class="panel-body">
            @if($id!=0)
            @section('title','Edit '.$category->name_category)
                <form action="{{route('category.editSubmit',$id)}}"  class="form-horizontal bucket-form" method="post">
            @else
            @section('title','Thêm mới thể loại')
                <form action="{{route('category.createSubmit')}}" class="form-horizontal bucket-form" method="post">
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
                            <p class="form-control-static">{{$category->id_category}}</p>
                        </div>
                    </div>
                    @endif
                    <div class="form-group @error('name_category') has-error @enderror">
                        <label class="col-sm-3 control-label">Thể loại</label>
                        <div class="col-sm-8">
                            <input type="text" id="name_category" name="name_category" class="form-control" value="{{$category->name_category ?? old('name_category')}}">
                            @error('name_category')
                                 <div class="help-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('description') has-error @enderror">
                        <label class="col-sm-3 control-label">Mô tả</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="description" name="description" type="text">{{$category->description ?? old('description')}}</textarea>
                            @error('description')
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
@endsection