<header class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light container">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="https://images.unsplash.com/photo-1631541647718-e7589282cc57?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=334&q=80" width="30" height="30" class="d-inline-block align-top rounded" alt="">
            KONI
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-1">
                    <a class="nav-link active badge badge-danger text-white p-2" href="{{route('register.member')}}">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link badge badge-success text-white p-2" href="{{route('login')}}">Login</a>
                </li>
            </ul>
        </div>
    </nav>
</header>