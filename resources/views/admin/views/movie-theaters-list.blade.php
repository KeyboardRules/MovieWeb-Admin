@extends('admin.layout.main')
@extends('admin.layout.sidebar')
@extends('admin.layout.header')
@extends('admin.layout.footer')

@section('title','Danh sách rạp chiếu phim')
@section('content')
<link href="{{asset('resources/css/autocomplete.css')}}" rel='stylesheet' type='text/css'/>
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
  </div>
</div>
<script>
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].name_theater.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].name_theater.substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].name_theater.substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i].name_theater + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
var theaters = {!! json_encode(App\Models\Theater::all()->toArray()) !!};

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("theater"), theaters);
</script>
@endsection