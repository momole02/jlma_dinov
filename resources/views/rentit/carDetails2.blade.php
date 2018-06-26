@extends('rentit/components/sidepage')

@section('title')
    -- JeLoueMonAuto -- Details du vehicule
@endsection

@section('breadcrumbs')
    @include('rentit/components/breadcrumbs', [
       'title' => 'Détails vehicule',
       'pages' => [
           'Accueil' => ['active' => false , 'link' => route('home')],
           'Catalogue' => ['active' => false , 'link' => route('showCars')],
           'Details vehicules' => ['active' => true , 'link' => '#']
        ]
   ])
@endsection


@section('widgets')

    <!-- widget detail reservation -->
    <div class="widget shadow widget-details-reservation">
        <h4 class="widget-title">Reservations</h4>
        <div class="widget-content">

            @foreach( $details->reserv_dates as $date_interval )
                <h5 class="widget-title-sub">  </h5>
                <div class="media">
                    <span class="media-object pull-left"><i class="fa fa-calendar"></i></span>
                    <div class="media-body"><p>Du : <b>{{ $date_interval->loc_datedebut }}</b> au <b>{{ $date_interval->loc_datefin }}</b> </p></div>
                </div>
                <div class="media">
                    <span class="media-object pull-left"><i class="fa fa-location-arrow"></i></span>
                    <div class="media-body"><p>Lieu de remise: <b>{{$date_interval->loc_lieu_remise}}</b></p></div>
                </div>
                {{--<li><i class="fa fa-arrow-right" ></i>  De :<b> {{ $date_interval->loc_datedebut }}</b> A <b>{{ $date_interval->loc_datefin }}</b></li>--}}
            @endforeach


        </div>
    </div>
    <!-- /widget detail reservation -->

    <!-- widget formulaire de reservation-->
    <div class="widget shadow">

        <h4 class="widget-title">Reservez maintenant !</h4>



        <div class="widget-content">
            <!-- Search form -->
            <div class="form-search light">
                <p style="color:red">
                    @include('rentit/components/validation')
                </p>
                <form action="{{route('doCarLeasing')}}" method="post">
                        <input type="hidden" name="leasing-car-slug" value="{{$slug}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group has-icon has-label">
                            <label for="formSearchUpLocation3">Lieu recup. du vehicule</label>
                            <input type="text" class="form-control" name="leasing-place" id="formSearchUpLocation3" placeholder="Ou recupérer voulez vous le vehicule ?">
                            <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                        </div>

                        <div class="form-group has-icon has-label">
                            <label for="formSearchOffLocation3">Lieu de circulation:</label>
                            <input type="text" class="form-control" id="formSearchOffLocation3" name="leasing-roam-place" placeholder="Ou voulez vous déposer le vehicule ?">
                            <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                        </div>

                        <div class="form-group has-icon has-label">
                            <label for="formSearchUpDate3">Date recup. du vehicule</label>
                            <input type="date" class="form-control" name="leasing-begin-date" id="formSearchUpDate3" >
                            <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                        </div>

                        <div class="form-group has-icon has-label selectpicker-wrapper">
                            <label>Heure de récup. du vehicule</label>
                            <input class="form-control" type="time" name="leasing-begin-time" data-live-search="true" data-width="100%"
                                   data-toggle="tooltip" >
                            <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                        </div>

                        <div class="form-group has-icon has-label">
                            <label for="formSearchUpDate3">Date dépot du vehicule</label>
                            <input type="date" class="form-control" name="leasing-end-date" id="formSearchUpDate3" >
                            <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                        </div>

                        <div class="form-group has-icon has-label selectpicker-wrapper">
                            <label>Heure de dépôt du vehicule</label>
                            <input class="form-control" type="time" name="leasing-end-time" data-live-search="true" data-width="100%"
                                   data-toggle="tooltip" >
                            <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <button type="submit" id="formSearchSubmit3" class="btn btn-submit btn-theme btn-theme-dark btn-block">Rerserver </button>

                    </form>
            </div>
            <!-- /Search form -->
        </div>

    </div>
    <!-- /widget formulaire de reservation-->

    <!-- widget testimonials -->
    <div class="widget shadow">
        <div class="widget-title">Testimonials</div>
        <div class="testimonials-carousel">
            <div class="owl-carousel" id="testimonials">
                <div class="testimonial">
                    <div class="media">
                        <div class="media-body">
                            <div class="testimonial-text">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>
                            <div class="testimonial-name">John Doe <span class="testimonial-position">Co- founder at Rent It</span></div>
                        </div>
                    </div>
                </div>
                <div class="testimonial">
                    <div class="media">
                        <div class="media-body">
                            <div class="testimonial-text">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>
                            <div class="testimonial-name">John Doe <span class="testimonial-position">Co- founder at Rent It</span></div>
                        </div>
                    </div>
                </div>
                <div class="testimonial">
                    <div class="media">
                        <div class="media-body">
                            <div class="testimonial-text">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>
                            <div class="testimonial-name">John Doe <span class="testimonial-position">Co- founder at Rent It</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /widget testimonials -->


@endsection


@section('innerContent')
    <!-- INFOS VEHICULE/ -->
    <article class="post-wrap">
        <div class="post-media">
            <div class="owl-carousel img-carousel">

                @php
                    $exp_photos = $details->liste_photos;
                @endphp

                @foreach( $exp_photos as $photo)
                    <div class="item"><a href="{{asset($photo)}}" data-gal="prettyPhoto">
                            <img class="img-responsive" src="{{asset($photo)}}" alt=""/></a>
                    </div>
                @endforeach

                {{--<div class="item"><a href="{{asset('rentit/img/preview/blog/blog-post-870x370x1.jpg')}}" data-gal="prettyPhoto"><img class="img-responsive" src="{{asset('rentit/img/preview/blog/blog-post-870x370x1.jpg')}}" alt=""/></a></div>--}}
                {{--<div class="item"><a href="{{asset('rentit/img/preview/blog/blog-post-870x370x2.jpg')}}" data-gal="prettyPhoto"><img class="img-responsive" src="{{asset('rentit/img/preview/blog/blog-post-870x370x2.jpg')}}" alt=""/></a></div>--}}
                {{--<div class="item"><a href="{{asset('rentit/img/preview/blog/blog-post-870x370x3.jpg')}}" data-gal="prettyPhoto"><img class="img-responsive" src="{{asset('rentit/img/preview/blog/blog-post-870x370x3.jpg')}}" alt=""/></a></div>--}}
                {{--<div class="item"><a href="{{asset('rentit/img/preview/blog/blog-post-870x370x3.jpg')}}" data-gal="prettyPhoto"><img class="img-responsive" src="{{asset('rentit/img/preview/blog/blog-post-870x370x3.jpg')}}" alt=""/></a></div>--}}

            </div>
        </div>
        <div class="post-header">
            <h2 class="post-title"><a href="#">Informations sur le vehicule</a></h2>
            {{--<div class="post-meta">By <a href="#">author name here</a> / 6th June 2014 / in <a href="#">Design</a>, <a href="#">Photography</a> / <a href="#">27 Comments</a> / 18 Likes / <a href="#">Share This Post</a></div>--}}
        </div>
        <div class="post-body">
            <div class="post-excerpt">
                <div>
                <ul class="list-icons">
                    <li><i class="fa fa-arrow-circle-right"></i><b>Immatriculation</b> : {{ $details->vehic_immat }} </li>
                    <li><i class="fa fa-arrow-circle-right"></i><b>Couleur</b> :{{ $details->couleur }} </li>
                    <li><i class="fa fa-arrow-circle-right"></i><b>Année</b>:{{ $details->annee }} </li>
                    <li><i class="fa fa-arrow-circle-right"></i><b>Année immatriculation</b>: {{ $details->annee_immat }} </li>
                    <li><i class="fa fa-arrow-circle-right"></i><b>Modèle</b>: {{ nl2br($details->model->libelle_model) }} </li>
                    <li><i class="fa fa-arrow-circle-right"></i><b>Marque </b>: {{ nl2br($details->marque->libelle_marque) }} </li>
                    <li><i class="fa fa-arrow-circle-right"></i><b>Type </b>: {{ nl2br($details->type->libelle_type_vehic) }} </li>
                </ul>
                    <hr>
                    <p><i>{{ nl2br($details->description) }}</i></p>
                </div>
            </div>
        </div>
        <div class="post-footer">
          {{--  <span class="post-read-more"><a href="#" class="btn btn-theme btn-theme-transparent btn-icon-left">Read more</a></span>--}}
        </div>
    </article>
    <!-- INFOS VEHICULE/ -->

    <!-- VIDEO VEHICULE/ -->
    <article class="post-wrap">
        <div class="post-media">
            <a href="{{$details->lien_video}}" data-gal="prettyPhoto" class="media-link">
                <span class="btn btn-play"><i class="fa fa-play"></i></span>
                <img src="{{asset('rentit/img/preview/blog/blog-post-870x370x3.jpg')}}" alt="">
            </a>
        </div>
        <div class="post-header">
            <h2 class="post-title"><a href="#">Video du vehicule</a></h2>
            {{--<div class="post-meta">By <a href="#">author name here</a> / 6th June 2014 / in <a href="#">Design</a>, <a href="#">Photography</a> / <a href="#">27 Comments</a> / 18 Likes / <a href="#">Share This Post</a></div>--}}
        </div>
        <div class="post-body">
            <div class="post-excerpt">
                <p>{{$details->description}}</p>
            </div>
        </div>
        <div class="post-footer">
            {{--<span class="post-read-more"><a href="#" class="btn btn-theme btn-theme-transparent btn-icon-left">Read more</a></span>--}}
        </div>
    </article>
    <!-- VIDEO VEHICULE/ -->
@endsection