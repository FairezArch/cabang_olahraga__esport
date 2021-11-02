@include('frontend.component.header')
@include('frontend.component.menus')
<div class="main">
    <section>
        <div class="jumbotron-fluid">
                <div id="owl-carousel-front" class="owl-carousel owl-theme">
                    @foreach($events as $event)
                    <a href="#"rel="noopener noreferrer">
                        <img src="{{ asset('uploads/'.$event->file) }}" alt="..." class="tesssss" />
                    </a>
                    @endforeach
                    <!-- <a href="{{url('/')}}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ asset('assets/eventtt.jpg') }}" alt="" class="tesssss" />
                    </a>
                    <a href="{{url('/')}}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ asset('assets/fullimage1.jpg') }}" alt="" class="tesssss" />
                    </a>
                    <a href="{{url('/')}}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ asset('assets/fullimage2.jpg') }}" alt="" class="tesssss" />
                    </a>
                    <a href="{{url('/')}}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ asset('assets/fullimage3.jpg') }}" alt="" class="tesssss" />
                    </a> -->
                </div>
        </div>
    </section>
    <section>
        <div class="bg-light">
            <div class="container-fluid">
                <div class="list-news" style="margin: 0 auto; width: 90%">
                    <div class="row">
                        @foreach($news as $artice)
                        <div class="col-md-3 mt-3 mb-3">
                            <div class="card rounded">
                                <img class="card-img-top" style="height: 15vw;object-fit: cover;" src="{{asset('uploads/'.$artice->file)}}" alt="Card image cap">
                                <div class="card-block text-center m-3">
                                    <div class="card-text">{{$artice->title}}</div>
                                    <a href="#" class="border badge badge-info text-light p-2 mt-2">Lihat selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('frontend.component.footer')