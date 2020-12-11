<!DOCTYPE html>
<head>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('resources/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('resources/css/style.css')}}" rel='stylesheet' type='text/css'/>
<link href="{{asset('resources/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('resources/css/font.css')}}" type="text/css"/>
<link href="{{asset('resources/css/font-awesome.css')}}" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="{{asset('resources/js/jquery2.0.3.min.js')}}"></script>
</head>
<body>
<div class="log-w3">
<div class="w3layouts-main">
    <h2>Admin Page</h2>
    @if(session()->has('message'))
      <div class="{{ session()->get('class')}}" role="alert">
        <strong>{{ session()->get('message')}}</strong>
      </div>
    @endif
		<form action="{{route('login.validate')}}" method="post">
            @csrf
            <input type="text" class="ggg" name="account_user" placeholder="ACCOUNT" required="" value="{{session()->get('account_user') ?? old('account_user')}}">
            @error('account_user')
                <div class="help-block">{{$message}}</div>
            @enderror
            <input type="password" class="ggg" name="password" placeholder="PASSWORD" required="" value="{{old('password')}}">
            @error('password')
                <div class="help-block">{{$message}}</div>
            @enderror
			<span><input type="checkbox" />Remember Me</span>
			<h6><a href="#">Forgot Password?</a></h6>
				<div class="clearfix"></div>
				<input type="submit" value="Sign In" name="login">
		</form>
</div>
</div>
<script src="{{asset('resources/js/bootstrap.js')}}"></script>
<script src="{{asset('resources/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('resources/js/scripts.js')}}"></script>
<script src="{{asset('resources/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('resources/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('resources/js/jquery.scrollTo.js')}}"></script>
</body>
</html>