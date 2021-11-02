@extends('master')
@section('title', '- Dashboard')
@section('content')
<div class="event">
    <div id="owl-carousel" class="owl-carousel owl-theme">
        @foreach($events as $event)
        <div class="item">
            <a href="{{url('dasboard/event/'.$event->slug)}}" target="_blank" rel="noopener noreferrer">
                <img class="owl-lazy img-responsive" data-src="{{url('uploads/'.$event->file)}}" alt="Image">
            </a>
        </div>
        @endforeach
    </div>
</div>
<div class="mt-4">
    <h4 class="">Games</h4>
    <div id="owl-carousel-games" class="owl-carousel owl-theme">
        @foreach($games as $game)
        <div>
            <a href="{{url('dasboard/game/'.$game->slug)}}" target="_blank" rel="noopener noreferrer">
                <img class="owl-lazy img-responsive clopimg" data-src="{{url('uploads/'.$game->image_game)}}" alt="Image">
            </a>
        </div>
        @endforeach
    </div>
</div>
<div class="row">
    @if(count($awards) > 0)
    <div class="col-sm-6">
        <div class="mt-4">
            <h4 class="">Award</h4>
            <div id="owl-carousel-awards" class="owl-carousel owl-theme">
                @foreach($awards as $award)
                <div>
                    <a href="{{url('dasboard/award/'.$award->slug)}}" target="_blank" rel="noopener noreferrer">
                        <img class="owl-lazy img-responsive clopimg" data-src="{{url('uploads/'.$award->award_logo)}}" alt="Image">
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    @if(count($clubs) > 0)
    <div class="col-sm-6">
        <div class="mt-4">
            <h4>List Club</h4>
            <div class="card shadow-sm rounded">
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($clubs as $club)
                        <li class="list-group-item"><a href="{{url('dashboard/joinClub/'.$club->slug)}}">{{$club->club_name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@section('script-footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<Script>
    $(document).ready(function() {
        $("#owl-carousel").owlCarousel({
            autoplay: true,
            slideSpeed: 300,
            paginationSpeed: 400,
            items: 1,
            itemsDesktop: false,
            itemsDesktopSmall: false,
            itemsTablet: false,
            itemsMobile: false,
            loop: true,
            lazyLoad: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                768: {
                    items: 1,
                }
            }
        });

        $("#owl-carousel-games").owlCarousel({
            items: 1,
            loop: true,
            lazyLoad: true,
            margin: 10,
            autoHeight: true,
            responsiveClass: true,
            responsive: {
                600: {
                    items: 3,
                    nav: false
                }
            }
        });

        $("#owl-carousel-awards").owlCarousel({
            items: 3,
            loop: true,
            lazyLoad: true,
            margin: 10,
            autoHeight: true,
            responsiveClass: true,
            responsive: {
                600: {
                    items: 2,
                    nav: false
                },
                450: {
                    items: 1,
                    nav: false
                }
            }
        });

    });
</Script>
@endsection
@endsection