@include('frontend.component.header')
@include('frontend.component.menus')
<div class="main">
    <section>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Fluid jumbotron</h1>
                <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
            </div>
        </div>
    </section>
    <section>
        <div class="bg-light">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card rounded">
                            <img class="card-img-top" style="height: 15vw;object-fit: cover;" src="https://images.unsplash.com/photo-1631476767348-5c7b63a29993?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1534&q=80" alt="Card image cap">
                            <div class="card-block text-center">
                                <div class="card-text">Game 1</div>
                                <div class="card-text">Game 2</div>
                                <div class="card-text">Game 2</div>
                                <div class="card-text">Game 2</div>
                                <a href="#" class="border badge badge-info text-light p-2 mt-2">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('frontend.component.footer')