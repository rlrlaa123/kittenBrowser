@extends('layouts.app')
@section('style')
    <style>
        .branch-selector {
            margin: 0 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: left;
            /*border: 1px solid #e3e3e3;*/
        }

        .branch-btn {
            border-right: 1px solid #e3e3e3;
            padding: 10px;
            background-color: darkgrey;
            color: white;
            width: 150px;
        }

        h3 {
            font-size: 2vw;
            margin: 0 50px;
        }

        hr {
            margin: 50px;
        }

        @media screen and (min-width: 1024px) and (max-width: 1440px) {
            .carousel {
                margin: 0 50px;
                height: 650px;
            }

            .carousel-inner {
                height: 650px;
            }

            .phone-image {
                width: 25px;
                margin-right: 5px;
            }
        }

        @media screen and (min-width: 768px) and (max-width: 1024px) {
            .carousel {
                margin: 0 50px;
                height: 450px;
            }

            .carousel-inner {
                height: 450px;
            }

            .phone-image {
                width: 25px;
                margin-right: 5px;
            }
        }

        @media screen and (min-width: 1441px) {
            .carousel {
                margin: 0 50px;
                height: 900px;
            }

            .carousel-inner {
                height: 900px;
            }

            .phone-image {
                width: 40px;
                margin-right: 5px;
            }
        }

        @media screen and (max-width: 768px) and (orientation: landscape) {
            .carousel {
                margin: 0 50px;
                height: 450px;
            }

            .carousel-inner {
                height: 450px;
            }

            .phone-image {
                width: 25px;
                margin-right: 5px;
            }
        }

        .carousel-indicators li {
            background-color: white;
        }

        .carousel-indicators .active {
            background-color: orange;
        }

        .branch-location {
            display: grid;
            display: -ms-grid;
            grid-template-columns: 50% 50%;
            -ms-grid-columns: 50% 50%;
            margin: 50px;
            border-left: 2px solid orange;
            text-align: left;
        }

        .branch-location-text {
            text-align: left;
            padding: 0 20px;
            -ms-grid-column: 1;
        }

        .branch-location-map {
            padding: 20px;
            width: 100%;
            display: flex;
            justify-content: center;
            -ms-grid-column: 2;
        }

        .branch-info-wrapper {
            text-align: left;
            margin: 0 50px;
            margin-bottom: 50px;
        }

        .branch-info {
            margin: 20px 0;
            border-bottom: 1px solid #e3e3e3;
        }

        .branch-info img {
            width: 25px;
        }

        .active {
            background-color: grey;
            border: none;
        }

        @media (orientation: portrait) {
            .carousel {
                margin: 0 50px;
                height: 200px;
            }

            .carousel-inner {
                height: 200px;
            }

            .carousel-indicators {
                bottom: 30px;
            }

            .carousel-item img {
                height: 200px;
            }

            .branch-selector {
                display: block;
                grid-template-columns: repeat(1, 1fr);
                width: 100%;
                margin-bottom: 50px;
            }

            .branch-btn {
                padding: 10px;
                width: unset;
            }

            .branch-location {
                display: block;
                border: none;
            }

            .branch-location-text {
                text-align: left;
                padding: 0 20px;
                border-left: 2px solid orange;
                margin: 50px 0;
            }

            .branch-location-map {
                padding: 20px;
                width: 100%;
                display: flex;
                justify-content: center;
                height: 200px;
            }

            .branch-info img {
                width: 20px;
            }

            .phone-image {
                width: 15px;
                margin-right: 5px;
            }
        }
    </style>
@endsection
@section('content')
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=dvfelyaqt6&submodules=geocoder"></script>
    <h3 style="margin: 50px 0; font-weight: bold;">바디웍 지점 소개</h3>
    <hr>
    <div style="display: flex; width: 100%;">
        <div class="branch-selector">
            @for($i = 1; $i <= count($branches); $i++)
                @if($i == 1)
                    <a href="/branch/1/{{ $i }}">
                    @php($pattern = '/\/branch\/1\/' . $i . '/')
                        <div class="branch-btn {{ $i }} {{ preg_match($pattern, $_SERVER['REQUEST_URI']) ? ' active' : '' }}">
                            {{ $i }}호점
                        </div>
                    </a>
                @else
                    @php($pattern = '/\/branch\/1\/' . $i . '/')
                    <a href="/branch/1/{{ $i }}">
                        <div class="branch-btn {{ $i }} {{ preg_match($pattern, $_SERVER['REQUEST_URI']) ? ' active' : '' }}">
                            {{ $i }}호점
                        </div>
                    </a>
                @endif
            @endfor
        </div>
    </div>
    <div class="branch-location-wrapper" style="display: block;">
        <div id="carouselMainIndicators" class="carousel slide" data-ride="carousel">
            <ol id="main-carousel-indicator" class="carousel-indicators">
                <li data-target="#carouselMainIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselMainIndicators" data-slide-to="1"></li>
                <li data-target="#carouselMainIndicators" data-slide-to="2"></li>
                <li data-target="#carouselMainIndicators" data-slide-to="3"></li>
                <li data-target="#carouselMainIndicators" data-slide-to="4"></li>
                <li data-target="#carouselMainIndicators" data-slide-to="5"></li>
                <li data-target="#carouselMainIndicators" data-slide-to="6"></li>
                <li data-target="#carouselMainIndicators" data-slide-to="7"></li>
            </ol>
            <div id="main-carousel-inner" class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="/{{ $branch->image1 }}" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/{{ $branch->image2 }}" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/{{ $branch->image3 }}" alt="Third slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/{{ $branch->image4 }}" alt="Third slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/{{ $branch->image5 }}" alt="Third slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/{{ $branch->image6 }}" alt="Third slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/{{ $branch->image7 }}" alt="Third slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/{{ $branch->image8 }}" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselMainIndicators" role="button"
               data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselMainIndicators" role="button"
               data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="branch-location">
            <div class="branch-location-text">
                <h3 style="text-align: center;">Location</h3>
                <p>
                    {!! nl2br($branch->description) !!}
                </p>
                <p>{{ $branch->location }}</p>
            </div>
            <div id="map" class="branch-location-map"></div>
        </div>
        <div class="branch-info-wrapper">
            <h6>바디웍 {{ $branch->number }}호점 운영시간</h6>
            <div class="branch-info">
                <img src="/img/branch/time.png">
                {{ $branch->time1 }}
            </div>
            <div class="branch-info">
                <img src="/img/branch/time.png">
                {{ $branch->time2 }}
            </div>
            <div class="branch-info">
                <img src="/img/branch/time.png">
                {{ $branch->time3 }}
            </div>
            <div class="note">Note: {{ $branch->note }}</div>
            <p><a href="tel:{{ $branch->phone }}"><img src="/img/phone-call.png" class="phone-image"> {{ $branch->phone }} &nbsp;<b>[전화하기]</b></a></p>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var map = new naver.maps.Map("map", {
		center: new naver.maps.LatLng(37.3595316, 127.1052133),
		zoom: 10,
		mapTypeControl: true
            });
	
	var marker = new naver.maps.Marker({
		position: new naver.maps.LatLng(37.3595316, 127.1052133),
		map: map
		});

	naver.maps.Service.geocode({
		query: '{{ $branch->location }}'
	}, function(status, response) {
		if (status === naver.maps.Service.Status.ERROR) {
			return alert('Something Wrong!');
		}
		
		if (response.v2.meta.totalCount === 0) {
			return alert('totalCount' + response.v2.meta.totalCount);
		}
		
		var htmlAddresses = [],
			item = response.v2.addresses[0],
			point = new naver.maps.Point(item.x, item.y);

		if (item.roadAddress) {
			htmlAddresses.push('<h6>' + item.roadAddress + '</h6>');
		}

		map.setCenter(point);
		marker.setPosition({x: item.x, y: item.y})
	});
    </script>
@endsection
