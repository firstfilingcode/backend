<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Accounting Software</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('public/assets/accounts/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('public/assets/accounts/css/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/assets/accounts/css/adminlte.min.css') }}">
  
  <style>
      .login-card-body, .register-card-body {
  background-color: #00000000;
  border-top: 0;
  color: #fff;
  padding: 20px;
box-shadow: -1px 4px 28px 0px rgb(9 197 242);
}

.card1 {
  position: relative;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-flex-direction: column;
  -ms-flex-direction: column;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  background-color: #00000091 !important;
  background-clip: border-box;
  border: 0 solid rgba(0,0,0,.125);
  border-radius: .25rem;
}
span {
    color: #09c5f2;
}
.btn.btn-primary {
    background: #09c5f2;
    border: 1px solid #09c5f2;
    color: #fff;
}
.btn.btn-primary:hover {
    border: 1px solid #ffffff;
    background: transparent;
    color: #ffffff;
}
  </style>
</head>
<body class="hold-transition login-page" style="background-image: url('{{ env('IMAGE_SHOW_PATH').'logo/login_background.jpg' }}'); background-repeat: no-repeat;
  background-size: 100% 100%;">
<div class="login-box">

    <div class="card card1 mt-4">
      <div class="card-body login-card-body">
          
          <center><img src="{{ env('IMAGE_SHOW_PATH').'/logo/'.setting()->logo }}" width="60%"></center>
        <div>
            <h1 class="pt-3 pb-3 text-center">Accounting Software</h1>
            
         

        <form action="{{ route('admin.login') }}" method="post">
            @csrf
           
          <div class="input-group mb-3">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email address">
				
            <div class="input-group-append">
                	
              <div class="input-group-text">
                <span>&#9993;</span>
              </div>
            </div>
            @error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
          </div>
          
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid  @enderror" placeholder="Password" value="{{old('Password')}}">
            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div> 
            @enderror
            <div class="input-group-append">
              <div class="input-group-text">
                <span>&#128274;</span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-10">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                 Remember Me
                </label>
              </div>
            </div><br><br>
            <!-- /.col -->
            <div class="col-4"></div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <div class="col-4"></div>
            <!-- /.col -->
          </div>
        </form>
                <br>

        <!-- /.social-auth-links -->
  
        <!--<p class="mb-1">-->
        <!--  <a href="forgot-password.html">I forgot my password</a>-->
        <!--</p>-->

      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
 </div>
 <!-- jQuery -->
<script src="{{URL::asset('public/assets/school/js/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{URL::asset('public/assets/school/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{URL::asset('public/assets/school/js/adminlte.min.js')}}"></script>
</body>
</html>

