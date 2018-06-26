@extends('rentit/layout')

@section('title')
    JeLoueMonAuto.ci - Détails sur la voiture
@endsection

@section('contents')

    @include('rentit/components/breadcrumbs', [
        'title' => 'Détails vehicule',
        'pages' => [
            'Accueil' => ['active' => false , 'link' => route('home')],
            'Catalogue' => ['active' => false , 'link' => route('showCars')],
            'Details vehicules' => ['active' => true , 'link' => '#']
         ]
    ])

    @if( Session::has('post_data') )
        @php
            $post_data = Session::get('post_data');
        @endphp
    @endif

    {{--TODO : mettre le slider des photos ici --}}
    <section class="page-section">
        <div class="container">
            <div class="row">
                <div style="color:red">
                    @include('rentit/components/validation')
                </div>
                <p style="color:#2e802a">
                    @include('rentit/components/dataSuccess')
                </p>


                <div class="col-md-8 col-md-offset-2">
                    <article class="post-wrap">
                        <h2 class="block-title"><span>Photos de la voiture</span></h2>
                        <div class="owl-carousel img-carousel">

                            @php
                                $exp_photos = explode(';' , $details->liste_photos);
                            @endphp

                            @foreach( $exp_photos as $photo)
                                <div class="item"><a href="{{asset($photo)}}" data-gal="prettyPhoto">
                                        <img class="img-responsive" src="{{asset($photo)}}" alt=""/></a>
                                </div>
                            @endforeach

                            {{--
                            <div class="item"><a href="assets/img/preview/blog/blog-post-870x370x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/blog/blog-post-870x370x2.jpg" alt=""/></a></div>
                            <div class="item"><a href="assets/img/preview/blog/blog-post-870x370x3.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/blog/blog-post-870x370x3.jpg" alt=""/></a></div>
                            <div class="item"><a href="assets/img/preview/blog/blog-post-870x370x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/blog/blog-post-870x370x1.jpg" alt=""/></a></div>
                            <div class="item"><a href="assets/img/preview/blog/blog-post-870x370x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/blog/blog-post-870x370x2.jpg" alt=""/></a></div>--}}
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>


    <section class="page-section image subscribe">
        <div class="container">

            <h2 class="section-title wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
                <small></small>
                <span>Plus d'infos sur le vehicule</span>
            </h2>

            <div class="row wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
                <div class="col-md-8">


                    <p>
                        <ul class="list-icons">
                            <li><i class="fa fa-arrow-circle-right"></i><b>Immatriculation</b> : {{ $details->vehic_immat }} </li>
                            <li><i class="fa fa-arrow-circle-right"></i><b>Couleur</b> :{{ $details->couleur }} </li>
                            <li><i class="fa fa-arrow-circle-right"></i><b>Année</b>:{{ $details->annee }} </li>
                            <li><i class="fa fa-arrow-circle-right"></i><b>Année immatriculation</b>: {{ $details->annee_immat }} </li>
                            <li><i class="fa fa-arrow-circle-right"></i><b>Description</b>: {{ nl2br($details->description) }} </li>
                            <li><i class="fa fa-arrow-circle-right"></i><b>Modèle</b>: {{ nl2br($details->model->libelle_model) }} </li>
                            <li><i class="fa fa-arrow-circle-right"></i><b>Marque </b>: {{ nl2br($details->marque->libelle_marque) }} </li>
                            <li><i class="fa fa-arrow-circle-right"></i><b>Type </b>: {{ nl2br($details->type->libelle_type_vehic) }} </li>
                        </ul>

                    </p>

                    @if( count($details->reserv_dates)>0 )
                        <p>
                        @if(count($details->reserv_dates)==1)
                            <h4><b>Le vehicule sera reservé pendant la periode: </b></h4>
                        @else
                            <h4><b>Le vehicule sera reservé pendant les periodes suivantes:</b></h4>
                        @endif

                        <ul style="color:red">
                            @foreach( $details->reserv_dates as $date_interval )
                                <li><i class="fa fa-arrow-right" ></i>  De :<b> {{ $date_interval->loc_datedebut }}</b> A <b>{{ $date_interval->loc_datefin }}</b></li>
                            @endforeach
                        </ul>
                        </p>
                    @else
                        <p>
                        <h4 style="color:green"><b>Vehicule libre</b></h4>
                        </p>
                    @endif

                </div>
            </div>

        </div>
    </section>

    @if(Session::has('client-account-data'))
        <section id="leasing" class="page-section light">

            <div class="container">

                <h2 class="section-title wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">

                    <span>Reservez le vehicule</span>
                    <small>Remplissez le formulaire suivant pour effectuer une demande de location</small>
                </h2>

                <div class="row wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
                    <div class="col-md-8">


                        <!-- Subscribe form -->
                        <form action="{{ route('doCarLeasing') }}" method="post" class="form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="leasing-car-slug" value="{{ $details->slug }}">

                            <div class="form-group ">
                                <label for="leasing-place">Lieu de recupération : </label>
                                <input type="text" id="leasing-place" value="{{ isset($post_data) ? $post_data['leasing-place'] : '' }}" name="leasing-place" class="form-control" placeholder="Ou voulez vous recupérer votre vehicule">
                            </div>

                            <div class="form-group ">
                                <label for="leasing-roam-place">Lieu de circulation : </label>
                                <input type="text" id="leasing-roam-place" value="{{ isset($post_data) ? $post_data['leasing-roam-place'] : '' }}" name="leasing-roam-place" class="form-control" placeholder="Vous roulerez où ?">
                            </div>

                            <div class="form-group">

                                <label for="leasing-begin-date">Date de début de location:   </label>
                                <input type="date" id="leasing-begin-date" value="{{ isset($post_data) ? $post_data['leasing-begin-date'] : '' }}" name="leasing-begin-date" class="form-control" >

                            </div>

                            <div class="form-group">

                                <label for="leasing-begin-time">Heure de début de location:   </label>
                                <input type="time" id="leasing-begin-time" value="{{ isset($post_data) ? $post_data['leasing-begin-time'] : '' }}" name="leasing-begin-time" class="form-control" >

                            </div>

                            <div class="form-group">

                                <label for="leasing-end-date">Date de fin de location:   </label>
                                <input type="date" id="leasing-end-date" value="{{ isset($post_data) ? $post_data['leasing-end-date'] : '' }}" name="leasing-end-date" class="form-control" >

                            </div>

                            <div class="form-group">

                                <label for="leasing-end-time">Heure de fin de location:   </label>
                                <input type="time" id="leasing-end-time" value="{{ isset($post_data) ? $post_data['leasing-end-time'] : '' }}" name="leasing-end-time" class="form-control" >

                            </div>

                            <div class="form-group has-icon has-label">
                                <label for="leasing-reason">Objet de la location:</label>
                                <select style="color:black" class="form-control" name="leasing-reason">
                                    <option value="affaires" {{ (isset($post_data) && $post_data['leasing-reason']=='affaires') ? 'selected' : '' }} >Affaires</option>
                                    <option value="loisirs" {{ (isset($post_data) && $post_data['leasing-reason']=='loisirs') ? 'selected' : '' }}>Loisirs</option>
                                    <option value="mariage" {{ (isset($post_data) && $post_data['leasing-reason']=='mariage') ? 'selected' : '' }}>Mariage</option>
                                    <option value="baptême" {{ (isset($post_data) && $post_data['leasing-reason']=='baptême') ? 'selected' : '' }}>Baptême</option>
                                    <option value="funérailles" {{ (isset($post_data) && $post_data['leasing-reason']=='funérailles') ? 'selected' : '' }}>Funérailles</option>
                                    <option value="autre" {{ (isset($post_data) && $post_data['leasing-reason']=='autre') ? 'selected' : '' }}>Autre(précisez)</option>
                                </select>
                                <span class="form-control-icon"><i class="fa fa-bars"></i></span>
                            </div>

                            <div class="form-group">
                                <label for="leasing-extra-reason">Autre raison : </label>
                                <input type="text" class="form-control" id="leasing-extra-reason" name="leasing-extra-reason" value="{{ isset($post_data) ? $post_data['leasing-extra-reason']:'' }}">
                            </div>

                            <button type="submit" class="btn btn-submit btn-theme ripple-effect btn-theme-dark">Lancer la location</button>
                        </form>
                        <!-- Subscribe form -->

                    </div>
                </div>

            </div>
        </section>
    @else
        <section id="leasing" class="page-section light">

            <div class="container">

                <h2 class="section-title wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">

                    <span>Reserver le vehicule</span>
                    <small><i>Vous devez être connecté(ou inscrit) pour louer un vehicule</i></small>
                </h2>

                <div class="row wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
                    <div class="col-md-8">
                    </div>
                </div>

            </div>
        </section>
    @endif

@endsection