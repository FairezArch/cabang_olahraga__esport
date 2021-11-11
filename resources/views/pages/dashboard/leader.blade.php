@extends('master')
@section('title', '- Dasboards')
@section('content')
<div class="event">
    <div id="owl-carousel" class="owl-carousel owl-theme">
        @foreach($events as $event)
        <div class="item">
            <a href="{{url('dashboard/event/'.$event->slug)}}" target="_blank" rel="noopener noreferrer">
                <img class="owl-lazy img-responsive" data-src="{{url('uploads/'.$event->file)}}" alt="Image" height="220">
            </a>
        </div>
        @endforeach
    </div>
</div>
<div class="row mt-3">
    @if(count($teams) > 0)
    <div class="col-sm-6">
        <div class="team">
            <div class="card shadow-sm rounded">
                <div class="card-header">
                    <h4>List Team</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($teams as $team)
                        <li class="list-group-item">{{$team->team_name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(count($clubs) > 0)
    <div class="col-sm-6">
        <div class="club">
            <div class="card shadow-sm rounded">
                <div class="card-body">
                    <div class="card-header">
                        <h4>List Club</h4>
                    </div>
                    <ul class="list-group">
                        @foreach($clubs as $club)
                        <li class="list-group-item">{{$club->club_name}}</li>
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
    });
</script>
@endsection
@endsection