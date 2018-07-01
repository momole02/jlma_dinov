<section id="our-cars" class="page-section">
    <div class="container">

        <h2 class="section-title wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
            <small>Faites votre choix</small>
            <span>Parmis un ensemble varié de véhicules</span>
        </h2>

        @php
            /*preparer les entrées pour rentit/components/carsTabbed1*/
            $nb_cars_per_page = 4;
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



        @include('rentit/components/carListing/carsTabbed1' ,['list_cars' => $list_cars , 'nb_cars_per_pages' => $nb_cars_per_page])

        <br>

        <a href="{{route('showCars')}}" class="btn btn-theme btn-theme-lg"><i class="fa fa-plus text-lg"></i>   Voir plus</a>

    </div>
</section>