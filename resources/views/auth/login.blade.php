@include('layouts.head')

@section('scripts')
{!! NoCaptcha::renderJs() !!}
@stop
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<body data-col="1-column" class=" 1-column  blank-page blank-page" style="background-image: url('app-assets/img/1677cf10220405.560e155f03bb0.jpg'); " >
    <div class="layer"></div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="wrapper nav-collapsed menu-collapsed">
    <div class="main-panel">
      <div class="main-content">
        <div class="content-wrapper"><!--Login Page Starts-->
  <div class="container-fluid">
      <div class="row full-height-vh">
          <div class="col-12 d-flex align-items-center justify-content-center">
              <div class="card gradient-purple-bliss text-center width-400">
                  <div class="card-img overlap">
                      <img alt="element 06" class="mb-1" src="{{ asset('website/thump_1589874137.png')}}" width="100">
                  </div>
                  <div class="card-body">
                      <div class="card-block">
                          <h2 class="black font-weight-normal">Login</h2>
                          <form method="post" action="{{ route('login') }}">
                        @csrf

                              <div class="form-group">
                                  <div class="col-md-12">
                                      {{-- <input type="text" class="form-control" name="email" id="email" placeholder="Email" required > --}}
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>

                                      @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                  </div>
                              </div>

                              <div class="form-group">
                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                      @error('password')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                </div>
                              </div>

                              {{-- <div class="form-group">
                                <div class="col-md-12">
                                    <div class="captcha">
                                        <span>{!! captcha_img() !!}</span>
                                        <button type="button" class="btn btn-success"><i class="fa fa-refresh" id="refresh"></i></button>
                                    </div>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-md-12">
                                    <input id="captcha" type="text" class="form-control" @error('captcha') is-invalid @enderror placeholder="Enter Captcha" name="captcha" required>
                                    @error('captcha')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                </div>
                              </div> --}}

                              {{-- <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Captcha</label>
                                <div class="col-md-6 pull-center">
                                {!! app('captcha')->display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block">
                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                </span>
                                @endif
                                </div>
                                </div> --}}



                            {{-- <div class="form-group">
                                <div class="col-md-12">
                                <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY')}}"></div>
                                <div class="g-recaptcha" data-sitekey= 6LcNrKoaAAAAAOxc10x1ftYphsK5PFHwECep3iye></div>

                                @if($errors->has('g-recaptcha-response'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                                        </span>
                                @endif
                                </div>
                            </div> --}}

                            <div class="form-group">
                                <div class="col-md-12">
                                    {!! NoCaptcha::display() !!}
                                </div>
                            </div>



                              <div class="form-group">
                                  <div class="col-md-12">
                                      <button type="submit" name="sub_log" class="btn btn-pink btn-block btn-dark">Login</button>

                                  </div>
                              </div>
                          </form>
                      </div>

                  </div>


              </div>
          </div>
      </div>
  </div>
</section>
{{-- <script type="text/javascript">
    $('#refresh').click(function(){
      $.ajax({
         type:'GET',
         url:'refreshcaptcha',
         success:function(data){
            $(".captcha span").html(data.captcha);
         }
      });
    });
</script> --}}
{{-- <script type="text/javascript">
    var onloadCallback = function() {
      grecaptcha.render('html_element', {
        'sitekey' : 6Lf3s6kaAAAAAFAc4BUgzUXvWz6LstbKml3u69Kj
      });
    };
</script> --}}
