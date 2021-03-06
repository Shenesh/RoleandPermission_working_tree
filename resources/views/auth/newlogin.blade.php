
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>

  .bg-image {
        background-image: url("https://unsplash.com/photos/vwzWVF54IZo/download?ixid=MnwxMjA3fDB8MXxzZWFyY2h8N3x8aG90JTIwZ2lybHN8fDB8fHx8MTYzODcwMTQzMA&force=true&w=1920");
        background-size: cover;
        background-position: center;
    }
    :root {
      --input-padding-x: 1.5rem;
      --input-padding-y: 0.75rem;
    }
    
    .login,
    .image {
      min-height: 100vh;
    }
        
    .login-heading {
      font-weight: 300;
    }
    
    .btn-login {
      font-size: 0.9rem;
      letter-spacing: 0.05rem;
      padding: 0.75rem 1rem;
      border-radius: 2rem;
    }
    
    .form-label-group {
      position: relative;
      margin-bottom: 1rem;
    }
    
    .form-label-group>input,
    .form-label-group>label {
      padding: var(--input-padding-y) var(--input-padding-x);
      height: auto;
      border-radius: 2rem;
    }
    
    .form-label-group>label {
      position: absolute;
      top: 0;
      left: 0;
      display: block;
      width: 100%;
      margin-bottom: 0;
      /* Override default `<label>` margin */
      line-height: 1.5;
      color: #495057;
      cursor: text;
      /* Match the input under the label */
      border: 1px solid transparent;
      border-radius: .25rem;
      transition: all .1s ease-in-out;
    }
    
    .form-label-group input::-webkit-input-placeholder {
      color: transparent;
    }
    
    .form-label-group input:-ms-input-placeholder {
      color: transparent;
    }
    
    .form-label-group input::-ms-input-placeholder {
      color: transparent;
    }
    
    .form-label-group input::-moz-placeholder {
      color: transparent;
    }
    
    .form-label-group input::placeholder {
      color: transparent;
    }
    
    .form-label-group input:not(:placeholder-shown) {
      padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
      padding-bottom: calc(var(--input-padding-y) / 3);
    }
    
    .form-label-group input:not(:placeholder-shown)~label {
      padding-top: calc(var(--input-padding-y) / 3);
      padding-bottom: calc(var(--input-padding-y) / 3);
      font-size: 12px;
      color: #777;
    }
    
    /* Fallback for Edge
    -------------------------------------------------- */
    
    @supports (-ms-ime-align: auto) {
      .form-label-group>label {
        display: none;
      }
      .form-label-group input::-ms-input-placeholder {
        color: #777;
      }
    }
    
    /* Fallback for IE
    -------------------------------------------------- */
    
    @media all and (-ms-high-contrast: none),
    (-ms-high-contrast: active) {
      .form-label-group>label {
        display: none;
      }
      .form-label-group input:-ms-input-placeholder {
        color: #777;
      }
    }
</style>

<div class="container-fluid">
    <div class="row no-gutter">
      <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image">
       
      </div>
      <div class="col-md-8 col-lg-6">
        <div class="login d-flex align-items-center py-5">
          <div class="container">
            <div class="row">
              <div class="col-md-9 col-lg-8 mx-auto">
                <h3 class="login-heading mb-4">Welcome back!</h3>
                <form method="POST" action="{{ route('login') }}">
                @csrf
                  <div class="form-label-group">
                    <input type="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror" 
                    name="email" value="{{ old('email') }}" 
                    placeholder="Email address" required autocomplete="email" autofocus>
                    <label for="inputEmail">Email address</label>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
  
                  <div class="form-label-group">
                    <input type="password" id="inputPassword" 
                    class="form-control @error('password') is-invalid @enderror" 
                    placeholder="Password" name="password" required autocomplete="current-password">
                    <label for="inputPassword">Password</label>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
  
                  <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input" id="customCheck1"
                     name="remember">
                    <label class="custom-control-label" for="customCheck1">Remember password</label>
                  </div>
                  <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" 
                  type="submit">Sign in</button>
                  <div class="text-center">
                    @if (Route::has('password.request'))
                        <a class="small" href="{{ route('password.request') }}">Forgot password?</a></div>
                    @endif
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
 
  </div>

