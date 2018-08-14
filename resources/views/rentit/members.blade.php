@extends('rentit/membersLayout')


@section('content')

    <div class="post-wrap">

        {{--<div class="post-media">
            <a href="assets/img/preview/blog/blog-post-870x370x1.jpg" data-gal="prettyPhoto"><img src="assets/img/preview/blog/blog-post-870x370x1.jpg" alt=""></a>
        </div> --}}

        <div class="post-header">
            <strong>
                <p style="color:green">
                    @include('rentit/components/dataSuccess')
                </p>
            </strong>
            <h2 class="post-title">Profil connecté </h2>

        </div>
        <div class="post-body">
            <div class="post-excerpt">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            @if( isset($reservation_validated) )
                                <b class="text-success">Votre reservation à été prise en compte</b>
                            @endif
                            <ul class="list-icons">
                                <li><i class="fa fa-arrow-circle-right"></i><b>N° CNI : </b>  {{ $client_data->numcni }}</li>
                                <li><i class="fa fa-arrow-circle-right"></i><b>Nom : </b>  {{ $client_data->civilite }} {{ $client_data->nom }}</li>
                                <li><i class="fa fa-arrow-circle-right"></i><b>Prénom : </b>  {{ $client_data->prenom }}</li>
                                <li><i class="fa fa-arrow-circle-right"></i><b>Date de naissance :</b>{{ $client_data->date_naiss}}</li>
                                <li><i class="fa fa-arrow-circle-right"></i><b>Contact : </b>{{ $client_data->contact}}</li>
                                <li><i class="fa fa-arrow-circle-right"></i><b>Email : </b>{{ $client_data->email }}</li>
                                <li><i class="fa fa-arrow-circle-right"></i><b>Lieu d'habitation : </b>{{ $client_data->situationgeo }}</li>
                            </ul>
                        </div><div class="col-md-6">
                            <ul class="list-icons">
                                <li><i class="fa fa-arrow-circle-right"></i><b>Pseudo  :</b>{{ $account_data->login}}</li>
                                <li><i class="fa fa-arrow-circle-right"></i><b>Date de création du compte :</b>{{ $account_data->cpte_datecreate}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="post-footer">
            <span class="post-read-more"><a href="{{ route('editProfile') }}" class="btn btn-theme btn-theme-transparent btn-icon-left">Modifier le profil</a></span>
        </div>
    </div>

    <div class="post-wrap">

        {{--<div class="post-media">
            <a href="assets/img/preview/blog/blog-post-870x370x1.jpg" data-gal="prettyPhoto"><img src="assets/img/preview/blog/blog-post-870x370x1.jpg" alt=""></a>
        </div> --}}

        <div class="post-header">
            <h2 class="post-title">Vos demandes de location</h2>

        </div>
        <div class="post-body">
            <div class="post-excerpt">
                <div class="container-fluid">

                    @php
                    $cards = [];
                    foreach( $car_leasings as $leas){
                        $card_data['photo'] = $leas->photo_vehicule;
                        $card_data['title'] = 'Date de la demande: '.$leas->loc_date;
                        $card_data['subtitle'] = 'Date de et heure de la remise : '.$leas->loc_datedebut;
                        $card_data['data'] = [];
                        $card_data['data'][] = 'Lieu de remise : '.$leas->loc_lieu_remise;
                        $card_data['data'][] = 'Lieu de circulation : '.$leas->loc_lieu_circulation;
                        $card_data['data'][] = ($leas->accepte==0) ? '<b>Demande en attente...</b>' : '<b style="color:blue"> Demande de location acceptée - <a href="#">CLIQUEZ ICI!!</a></b>';
                        $card_data['endmark'] = 'Prix de la location : '.$leas->loc_prix.' FCFA';

                        $card_data['ops']=[];
                        if($leas->accepte==0)
                            $card_data['ops'][]=['title'=>'Retirer' , 'link' => route('dropLeasing' , ['slug'=>$leas->slug])];

                        $card_data['ops'][]=['title'=>'Details vehicule' , 'link'=>route('carDetails',['slug'=>$leas->slug_vehicule]) ];

                        $cards[] = $card_data;
                    }
                    @endphp

                @include('rentit/components/cards',$cards)
                </div>
            </div>
            <br>
        </div>
        <div class="post-footer">

        </div>
    </div>





@endsection