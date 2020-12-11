@extends('admin.layout.main')
@extends('admin.layout.sidebar')
@extends('admin.layout.header')
@extends('admin.layout.footer')


@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thông tin phim
            </header>
            <div class="panel-body">
            @if($id!=0)
            @section('title','Edit '.$movie->name_movie)
                <form action="{{route('movie.editSubmit',$id)}}"  class="form-horizontal bucket-form" method="post">
            @else
            @section('title','Thêm mới phim')
                <form action="{{route('movie.createSubmit')}}" class="form-horizontal bucket-form" method="post">
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
                            <p class="form-control-static">{{$movie->id_movie}}</p>
                        </div>
                    </div>
                    @endif
                    <div class="form-group @error('name_movie') has-error @enderror">
                        <label class="col-sm-3 control-label">Tên phim</label>
                        <div class="col-sm-8">
                            <input type="text" id="name_movie" name="name_movie" class="form-control" value="{{$movie->name_movie ?? old('name_movie')}}">
                            @error('name_movie')
                                 <div class="help-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('length_movie') has-error @enderror">
                        <label class="col-sm-3 control-label">Độ dài</label>
                        <div class="col-sm-8">
                            <input type="number" id="length_movie" name="length_movie" class="form-control" value="{{$movie->length_movie ?? old('length_movie')}}">
                            @error('length_movie')
                                 <div class="help-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('date_movie') has-error @enderror">
                        <label class="col-sm-3 control-label">Ngày ra mắt</label>
                        <div class="col-sm-8">
                            <input type="date" id="date_movie" name="date_movie" class="form-control" value="{{$movie->date_movie ?? old('date_movie')}}">
                            @error('date_movie')
                                 <div class="help-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label col-lg-3">Thể loại</label>
                        <div class="col-lg-8">
                            @foreach(App\Models\Category::all() as $category)
                            <label class="checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox1" name="categories[]" value="{{$category->id_category}}" @if(isset($movie) && $movie->categories->contains('id_category',$category->id_category) ) checked @endif> {{$category->name_category}}
                            </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="image_file">Ảnh</label>
                        <div class="col-sm-8">
                        <input class="form-control-file" type="file" id="image_file" disabled>
                        </div>
                    </div>
                                                
                    <div class="form-group @error('image_movie') has-error @enderror">
                        <label class="col-sm-3 control-label">Ảnh</label>
                        <div class="col-sm-8">
                            <input type="url" id="image_movie" name="image_movie" class="form-control" placeholder="URL" value="{{$movie->image_movie ?? old('image_movie')}}">
                            @error('image_movie')
                                 <div class="help-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('trailer_movie') has-error @enderror">
                        <label class="col-sm-3 control-label">Trailer</label>
                        <div class="col-sm-8">
                            <input type="url" id="trailer_movie" name="trailer_movie" class="form-control" placeholder="URL/embed" value="{{$movie->trailer_movie ?? old('trailer_movie')}}">
                            @error('trailer_movie')
                                 <div class="help-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('content_movie') has-error @enderror">
                        <label class="col-sm-3 control-label">Nội dung</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="content_movie" name="content_movie" type="text">{{$movie->content_movie ?? old('content_movie')}}</textarea>
                            @error('content_movie')
                                 <div class="help-block">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- <div class="form-group has-success">
                        <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Input with success</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="inputSuccess">
                        </div>
                    </div>
                    <div class="form-group has-warning">
                        <label class="col-sm-3 control-label col-lg-3" for="inputWarning">Input with warning</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="inputWarning">
                        </div>
                    </div>
                    <div class="form-group has-error">
                        <label class="col-sm-3 control-label col-lg-3" for="inputError">Input with error</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="inputError">
                        </div>
                    </div> -->
                    <div class="form-group">
                        <div class="col-lg-offset-4 col-lg-10">
                            <button type="submit" class="btn btn-info">Xác nhận</button>
                            <a class="btn btn-default" href="{{ route('movie.detail',$id) }}">Hủy</a>  
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