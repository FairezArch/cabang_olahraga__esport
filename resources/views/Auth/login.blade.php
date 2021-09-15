@include('Auth.components.header')
    <!--================= Main Wrapper ==================-->
    <div class="wrapper">
        <div class="login-thumb" style="background-image:url('{{asset('assets/bg.jpg')}}')"></div>

        <div class="login-form form-input-login">
            <form action="{{ route('tologin') }}" method="post">
            <div class="login-form-title">Account Login</div>
                @csrf
                <div class="card-body">
                    @if(session('errors'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Something it's wrong:
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    @if (Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                    @endif
                    <div class="form__group">
                            <input type="email" class="form__field" placeholder="Email" name="email" required />
                            <label for="email" class="form__label">Email</label>
                        </div>
                        <div class="form__group">
                            <input type="password" class="form__field" placeholder="Password" name="password" required />
                            <label for="password" class="form__label">Password</label>
                        </div>
                </div>
                <div class="card-footer cards-down">
                    <button type="submit" class="btn btn-primary custom-btn">Log In</button>
                </div>
            </form>
        </div>

    </div>
    @include('Auth.components.footer')