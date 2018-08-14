@extends('rentit/components/sidepage')

@section('breadcrumbs')
    @include('rentit/components/breadcrumbs' , [
        'title' => 'Details voiture'
    ])
@endsection 
@section('title')
    JLMA - Details du vehicule
@endsection

@section('ExtraJS')
<script type="text/javascript">
    ok=false;

    $(function(){

        $('#negPanel').hide( );
        $('#negButton').on('click' , function(){
            $('#negPanel').show( );
            $('#negButton').hide( );
            $('#negValue').val('true');
        });
        /////
        $('#reservationForm').on('submit' , function(e){
            
            var now = new Date( );

            var date1 = $('#date1').val();

            var time1 = $('#time1').val();
            var date2 = $('#date2').val();
            var time2 = $('#time2').val();
            var d1 = new Date( date1+'T'+time1 );
            var d2 = new Date( date2+'T'+time2 );

            /* eviter de mettre des dates passées */
            if( now.getTime() < d1.getTime() && now.getTime() < d2.getTime() ){
                ok=true; 
                $('#validationOut').html('');
            }else{
                ok=false;
                $('#validationOut').html('Ne mettez pas de dates passées');
            }

            if( ok ){
                  /* les dates de remise et de recupération doivent etre espaceés d'au moins deux jours */            
                var dayMillsecs  = 24*3600*1000;


                if( d2.getTime()-d1.getTime( )  > dayMillsecs ){
                    ok=true;
                    $('#validationOut').html('');
                }else{
                    ok=false;
                    $('#validationOut').html("Les dates doivent etre espaceés d'au moins deux jours");
                    
                }
            }

            if( !ok ){
                e.preventDefault();
            }
        });    
    })

    
</script>
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

                <form id="reservationForm" action="{{route('doCarLeasing')}}" method="post">
                        <input type="hidden" name="leasing-car-slug" value="{{$slug}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                       
                        <div class="form-group has-icon has-label">
                            <label for="formSearchUpLocation3">Lieu recup. du vehicule(Ex : Cocody Angré Commissariat 22e)</label>
                            <input type="text" class="form-control" name="leasing-place" id="formSearchUpLocation3" placeholder="Ou recupérer voulez vous le vehicule ?"required >
                        </div>

                        <div class="form-group has-icon has-label">
                            <label for="formSearchOffLocation3">Lieu de circulation( Ex : Youpougon Maroc ):</label>
                            <input type="text" class="form-control" id="formSearchOffLocation3" name="leasing-roam-place" placeholder="Ou voulez vous déposer le vehicule ?"required>


                        </div>

                        <div class="form-group has-icon has-label">
                            <label for="formSearchUpDate3">Date recup. du vehicule</label>
                            <input type="date" id="date1" class="form-control" name="leasing-begin-date" id="formSearchUpDate3" required>
                            <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                        </div>

                        <div class="form-group has-icon has-label selectpicker-wrapper">
                            <label>Heure de récup. du vehicule</label>
                            <input class="form-control" id="time1" type="time" name="leasing-begin-time" data-live-search="true" data-width="100%"
                                   data-toggle="tooltip" required>
                            <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                        </div>

                        <div class="form-group has-icon has-label">
                            <label for="formSearchUpDate3">Date dépot du vehicule</label>
                            <input type="date" id="date2" class="form-control" name="leasing-end-date" id="formSearchUpDate3" required>
                            <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                        </div>

                        <div class="form-group has-icon has-label selectpicker-wrapper">
                            <label>Heure de dépôt du vehicule</label>
                            <input class="form-control" id="time2" type="time" name="leasing-end-time" data-live-search="true" data-width="100%"
                                   data-toggle="tooltip" required>
                            <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                        </div>

                        <div class="form-group has-icon has-label selectpicker-wrapper">
                            <label>Raison de la location( Ex:Tourisme,Mariage,... )</label>
                            <input class="form-control" type="text" name="leasing-reason" data-live-search="true" data-width="100%"
                                   data-toggle="tooltip" required>
                            <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <span class="text-danger" style="font-size:20px" id="validationOut"></span>

                        <button type="submit" id="formSearchSubmit3" class="btn btn-submit btn-theme btn-theme-dark btn-block">Reserver </button>

                </form>
            </div>
            <!-- /Search form -->
        </div>
    </div>

    <div class="widget shadow">

    <h4 class="widget-title">Acheter</h4> 


        @php 
            $avail = jlma\CarSellBusiness::isVehicleAvailiableForBuy($slug);
        @endphp 
        @if( $avail == 1  )
            <div class="widget-content">
                @php 
                    $hasBuyRequest =  jlma\CarSellBusiness::currentUserHasBuyRequest( $details->id_vehicul ); 
                @endphp 
                @if( $hasBuyRequest===false )
                <div class="form-search light">
                    Prix unitaire du vehicule:
                    <br>
                    <span style="color:red">{{ \jlma\Front_Utils::formatPrice($details->prix_vente) }}</span> F/CFA
                    <button id="negButton" class="btn btn-success" >Negocier</button>
                    <br><br>
                    <form id="reservationForm" action="{{route('doCarSellRequest')}}" method="post">
                            <input type="hidden" name="slug" value="{{$slug}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="negociate" value="false" id="negValue">

                            <div class="form-group has-icon has-label"> 
                                <div id="negPanel">
                                    <label style="font-size: 12px">A combien voulez vous acheter ? </label><br> 
                                    <input type="number" value="{{$details->prix_vente}}" class="form-control" name="buy-price" required>
                                    <span class="form-control-icon"></i></span>    
                                </div>

                            </div>
                            <div class="form-group has-icon has-label">
                                <label style="font-size: 12px">Quantité : </label>
                                <input type="number" class="form-control" name="buy-amount" required>
                                <span class="form-control-icon"><i class="fa fa-times"></i></span>
                            </div>
                            <button type="submit" id="formSearchSubmit3" class="btn btn-danger" style="width:100%;padding:10px;font-weight: bold;">ACHETER !</button>
                    </form>
                </div>
                @elseif( $hasBuyRequest === true )
                    Vous avez déja commandé ce véhicule. <br>
                    Néanmoins le propriétaire désire négocier avec vous.
                    <a style="color:white" class="btn btn-success" href="{{route('carBuyNegociations' , ['slug' => $details->slug])}}">Voir les négociations</a>
                @else 
                    Vous devez etre connecté pour commander
                @endif  
            </div>
        @elseif( $avail == 2 )
            Véhicule en rupture de stock
        @elseif( $avail == 0 )
            Véhicule non disponible pour la vente
        @endif 

    </div>
    <!-- /widget formulaire de reservation-->
@endsection


@section('innerContent')
    <!-- INFOS VEHICULE/ -->
    <article class="post-wrap">
        <div class="post-media">
            <div class="owl-carousel img-carousel">

                @foreach( $details->liste_photos as $photo)
                    <div class="item"><a href="{{asset(Storage::url($photo))}}" data-gal="prettyPhoto">
                            <img class="img-responsive" src="{{asset(Storage::url($photo))}}" alt=""/></a>
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
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-icons">
                            <li><i class="fa fa-arrow-circle-right"></i><b>Immatriculation</b> : {{ $details->vehic_immat }} </li>
                            <li><i class="fa fa-arrow-circle-right"></i><b>Couleur</b> :<span style="color:{{ $details->couleur }};background:{{ $details->couleur }}">*******</span></li>
                            <li><i class="fa fa-arrow-circle-right"></i><b>Année</b>:{{ $details->annee }} </li>
                            <li><i class="fa fa-arrow-circle-right"></i><b>Année immatriculation</b>: {{ $details->annee_immat }} </li>
                            <li><i class="fa fa-arrow-circle-right"></i><b>Modèle</b>: {{ $details->model->libelle_model }} </li>
                            <li><i class="fa fa-arrow-circle-right"></i><b>Marque </b>: {{ $details->marque->libelle_marque }} </li>
                            <li><i class="fa fa-arrow-circle-right"></i><b>Type </b>: {{ $details->type->libelle_type_vehic }} </li>



                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <ul class="list-icons">

                            <li><i class="fa fa-arrow-circle-right"></i><b>Pays</b> : {{ $details->pays}} </li>
                            <li><i class="fa fa-arrow-circle-right"></i><b>Consommation</b> {{$details->consommation}}</li>
                            <li><i class="fa fa-arrow-circle-right"></i><b>Type d'énergie</b>:{{ $details->energie}} </li>
                            <li><i class="fa fa-arrow-circle-right"></i><b>Boite à vitesse</b>: {{ $details->boite_vitesse }} </li>
                            <li style="color:red"><i class="fa fa-arrow-circle-right"></i><b>Prix /jour</b>: {{$details->prix}} F/CFA</li>
                            <li style="color:red"><i class="fa fa-arrow-circle-right"></i><b>Prix /semaine</b>: {{$details->prix_semaine}} F/CFA</li>
                            <li style="color:red"><i class="fa fa-arrow-circle-right"></i><b>Prix /mois</b>: {{$details->prix_mois}} F/CFA</li>
                            <li style="color:red"><i class="fa fa-arrow-circle-right"></i><b>Prix /an</b>: {{$details->prix_an}} F/CFA</li>

                            @if( jlma\CarSellBusiness::isVehicleAvailiableForBuy( $details->slug ) == 1 )
                            <li ><i class="fa fa-arrow-circle-right"></i><b>Prix de vente </b>: {{$details->prix_vente}} F/CFA</li>
                            <li ><i class="fa fa-arrow-circle-right"></i><b>Quantité dispo </b>: {{$details->stock_dispo}}</li>
                            @endif


                        </ul>
                    </div>
                <hr>
                    <b>Description du véhicule</b>
                <pre>{{ $details->description }}</pre>
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

