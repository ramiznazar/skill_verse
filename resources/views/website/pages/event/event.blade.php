@extends('website.layouts.main')
@section('content')
    <div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="{{asset('assets/website/images/institute/26.jpg')}}">
            <div class="container pt-70 pb-20">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="title text-white">Events</h3>
                                <ol class="breadcrumb text-center text-black mt-10">
                                    <li><a href="{{ route('event') }}">Home</a></li>
                                    {{-- <li><a href="#">Pages</a></li> --}}
                                    <li class="active text-theme-colored">Events</li>
                                </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: event calendar -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        @foreach ($events as $event)
                            <div class="upcoming-events bg-white-f3 mb-20">
                                <div class="row">
                                    <div class="col-sm-4 pr-0 pr-sm-15">
                                        <div class="thumb p-15">
                                            <img class="img-fullwidth" src="{{ $event->image }}" alt="..." height="220">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 pl-0 pl-sm-15">
                                        <div class="event-details p-15 mt-20">
                                            <h4 class="mt-0 text-uppercase font-weight-500">{{ $event->title }}</h4>
                                            <p>{{ Str::words($event->description, 30, '...') }}</p>
                                            <a href="{{ route('event.detail',$event->id) }}"
                                                class="btn btn-flat btn-dark btn-theme-colored btn-sm mt-10">Details <i
                                                    class="fa fa-angle-double-right"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="event-count p-15 mt-15">
                                            @php
                                                $date = \Carbon\Carbon::parse($event->date);
                                            @endphp

                                            <ul class="event-date list-inline font-16 text-uppercase mt-10 mb-20">
                                                <li class="p-15 mr-5 bg-lightest">{{ $date->format('M') }}</li>
                                                <li class="p-15 pl-20 pr-20 mr-5 bg-lightest">{{ $date->format('d') }}</li>
                                                <li class="p-15 bg-lightest">{{ $date->format('Y') }}</li>
                                            </ul>

                                            <ul>
                                                <li class="mb-10"><a href="#"><i class="fa fa-clock-o mr-5"></i> at
                                                        {{ $event->start_time }} - {{ $event->end_time }}</a></li>
                                                <li><a href="#"><i class="fa fa-map-marker mr-5"></i>{{$event->address}}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
