@extends('rentit/layout')


@section('title')
    JLMA - Catalogue des voitures
@endsection

@section('contents')

    @if(isset( $useSearch ) && $useSearch==true)

        @include('rentit/components/breadcrumbs' , ['title' => 'Resultats recherche' ,
       'pages' => [
           'Accueil' => ['active' => false , 'link' => route('home')],
           'resultats Recherche' => ['active' => true, 'link' => "#"],

            ]
        ])
        @else
            @include('rentit/components/breadcrumbs' , ['title' => 'Catalogue des voitures' ,
            'pages' => [
                'Accueil' => ['active' => false , 'link' => route('home')],
                'Catalogue des voitures' => ['active' => true , 'link' => '#']
            ]
        ])
    @endif
    @php
        /*preparer les entrées pour rentit/components/carsTabbed1*/
        $nb_cars_per_page = 5; /*5 voitures par pages*/
        $list_cars = [];

        foreach($cars as $car){

            $exp_photos = $car->liste_photos;

            /*ajouter à 'cars' */
            $list_cars[] = [
                'register' => $car->vehic_immat,
                'name'=>$car->id_vehicul.' '.$car->marque->libelle_marque.' '.$car->model->libelle_model,
                'slug' =>$car->slug,
                'photos' => $exp_photos,
                'characs' => [  'Pays  '.$car->pays ,
                                'Annee immat '.$car->annee_immat ,
                                'Annee '.$car->annee,
                                'Transmission '.$car->boite_vitesse],
                'price' => $car->prix
            ];
        }
    @endphp



   @include('rentit/components/carListing/sidebarPanel' ,[
        'list_cars' => $list_cars ,
        'cars_count' => $carsCount ,
        'nb_cars_per_page' => $nbCarsPerPage,
        'current_page' => $page,
          ])

   @include('rentit/components/index/contactUs')

@endsection