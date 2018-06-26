<section id="our-cars" class="page-section">
    <div class="container">

        <h2 class="section-title wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
            <small>Select What You Want</small>
            <span>Our awesome Rental Fleet cars</span>
        </h2>

        @php
            /*preparer les entrées pour rentit/components/carsTabbed1*/
            $nb_cars_per_page = 5;
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

        {{--<div class="tabs awesome wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
            <ul id="tabs1" class="nav"><!--
                        --><li class=""><a href="#tab-x1" data-toggle="tab">Economic cars</a></li><!--
                        --><li class="active"><a href="#tab-x2" data-toggle="tab">Business cars</a></li><!--
                        --><li class=""><a href="#tab-x3" data-toggle="tab">Premium cars</a></li><!--
                        --><li class=""><a href="#tab-x4" data-toggle="tab">Luxury cars</a></li>
            </ul>
        </div>

        <div class="tab-content wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
            <!-- tab 1 -->
            <div class="tab-pane fade" id="tab-x1">
                <div class="car-big-card">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="tabs awesome-sub">
                                <ul id="tabs4" class="nav"><!--
                                            --><li class=""><a href="#tab-x1x1" data-toggle="tab">VW Passat CC 2.0 TDI</a></li><!--
                                            --><li class="active"><a href="#tab-x1x2" data-toggle="tab">VW Polo 1.6 TDI Comfortline</a></li><!--
                                            --><li class=""><a href="#tab-x1x3" data-toggle="tab">Toyota Corolla 1.6 Elegant</a></li><!--
                                            --><li class=""><a href="#tab-x1x4" data-toggle="tab">Honda Civic Elegance</a></li><!--
                                            --><li class=""><a href="#tab-x1x4" data-toggle="tab">Renoult Megane</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">

                            <!-- Sub tabs content -->
                            <div class="tab-content">

                                <div class="tab-content">



                                    <div class="tab-pane fade" id="tab-x1x1">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <!-- Swiper -->
                                                <div class="swiper-container" id="swiperSlider1x1">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <a class="btn btn-zoom" href="/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                            <a href="{{asset('rentit/img/preview/cars/car-600x426x1.jpg')}}" data-gal="prettyPhoto"><img class="img-responsive" src="{{ asset('assets/img/preview/cars/car-600x426x1.jpg')}}" alt=""/></a>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                            <a href="{{asset('assets/img/preview/cars/car-600x426x2.jpg')}}" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                            <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                            <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                        </div>
                                                    </div>
                                                    <!-- Add Pagination -->
                                                    <div class="row car-thumbnails"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="car-details">
                                                    <div class="price">
                                                        <strong>111.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                    </div>
                                                    <div class="list">
                                                        <ul>
                                                            <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                            <li>Under 25,000 Km</li>
                                                            <li>Transmission Manual</li>
                                                            <li>5 Year service included</li>
                                                            <li>Manufacturing Year 2014</li>
                                                            <li>5 Doors and Panorama View</li>
                                                        </ul>
                                                    </div>
                                                    <div class="button">
                                                        <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade active in" id="tab-x1x2">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <!-- Swiper -->
                                                <div class="swiper-container" id="swiperSlider1x2">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                            <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                            <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                            <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                            <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                        </div>
                                                    </div>
                                                    <!-- Add Pagination -->
                                                    <div class="row car-thumbnails"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="car-details">
                                                    <div class="price">
                                                        <strong>112.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                    </div>
                                                    <div class="list">
                                                        <ul>
                                                            <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                            <li>Under 25,000 Km</li>
                                                            <li>Transmission Manual</li>
                                                            <li>5 Year service included</li>
                                                            <li>Manufacturing Year 2014</li>
                                                            <li>5 Doors and Panorama View</li>
                                                        </ul>
                                                    </div>
                                                    <div class="button">
                                                        <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab-x1x3">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <!-- Swiper -->
                                                <div class="swiper-container" id="swiperSlider1x3">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                            <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                            <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                            <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                            <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                        </div>
                                                    </div>
                                                    <!-- Add Pagination -->
                                                    <div class="row car-thumbnails"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="car-details">
                                                    <div class="price">
                                                        <strong>113.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                    </div>
                                                    <div class="list">
                                                        <ul>
                                                            <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                            <li>Under 25,000 Km</li>
                                                            <li>Transmission Manual</li>
                                                            <li>5 Year service included</li>
                                                            <li>Manufacturing Year 2014</li>
                                                            <li>5 Doors and Panorama View</li>
                                                        </ul>
                                                    </div>
                                                    <div class="button">
                                                        <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab-x1x4">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <!-- Swiper -->
                                                <div class="swiper-container" id="swiperSlider1x4">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                            <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                            <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                            <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                            <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                        </div>
                                                    </div>
                                                    <!-- Add Pagination -->
                                                    <div class="row car-thumbnails"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="car-details">
                                                    <div class="price">
                                                        <strong>114.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                    </div>
                                                    <div class="list">
                                                        <ul>
                                                            <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                            <li>Under 25,000 Km</li>
                                                            <li>Transmission Manual</li>
                                                            <li>5 Year service included</li>
                                                            <li>Manufacturing Year 2014</li>
                                                            <li>5 Doors and Panorama View</li>
                                                        </ul>
                                                    </div>
                                                    <div class="button">
                                                        <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab-x1x5">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <!-- Swiper -->
                                                <div class="swiper-container" id="swiperSlider1x5">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                            <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                            <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                            <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                            <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                        </div>
                                                    </div>
                                                    <!-- Add Pagination -->
                                                    <div class="row car-thumbnails"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="car-details">
                                                    <div class="price">
                                                        <strong>115.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                    </div>
                                                    <div class="list">
                                                        <ul>
                                                            <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                            <li>Under 25,000 Km</li>
                                                            <li>Transmission Manual</li>
                                                            <li>5 Year service included</li>
                                                            <li>Manufacturing Year 2014</li>
                                                            <li>5 Doors and Panorama View</li>
                                                        </ul>
                                                    </div>
                                                    <div class="button">
                                                        <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- /Sub tabs content -->

                        </div>
                    </div>
                </div>
            </div>

            <!-- tab 2 -->
            <div class="tab-pane fade active in" id="tab-x2">

                <div class="car-big-card">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="tabs awesome-sub">
                                <ul id="tabs-x2" class="nav"><!--
                                            --><li class=""><a href="#tab-x2x1" data-toggle="tab">VW Passat CC 2.0 TDI</a></li><!--
                                            --><li class="active"><a href="#tab-x2x2" data-toggle="tab">VW Polo 1.6 TDI Comfortline</a></li><!--
                                            --><li class=""><a href="#tab-x2x3" data-toggle="tab">Toyota Corolla 1.6 Elegant</a></li><!--
                                            --><li class=""><a href="#tab-x2x4" data-toggle="tab">Honda Civic Elegance</a></li><!--
                                            --><li class=""><a href="#tab-x2x5" data-toggle="tab">Renoult Megane</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">

                            <!-- Sub tabs content -->
                            <div class="tab-content">

                                <div class="tab-pane fade" id="tab-x2x1">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <!-- Swiper -->
                                            <div class="swiper-container" id="swiperSlider2x1">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                </div>
                                                <!-- Add Pagination -->
                                                <div class="row car-thumbnails"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="car-details">
                                                <div class="price">
                                                    <strong>121.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                </div>
                                                <div class="list">
                                                    <ul>
                                                        <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                        <li>Under 25,000 Km</li>
                                                        <li>Transmission Manual</li>
                                                        <li>5 Year service included</li>
                                                        <li>Manufacturing Year 2014</li>
                                                        <li>5 Doors and Panorama View</li>
                                                    </ul>
                                                </div>
                                                <div class="button">
                                                    <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade active in" id="tab-x2x2">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <!-- Swiper -->
                                            <div class="swiper-container" id="swiperSlider2x2">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                </div>
                                                <!-- Add Pagination -->
                                                <div class="row car-thumbnails"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="car-details">
                                                <div class="price">
                                                    <strong>122.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                </div>
                                                <div class="list">
                                                    <ul>
                                                        <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                        <li>Under 25,000 Km</li>
                                                        <li>Transmission Manual</li>
                                                        <li>5 Year service included</li>
                                                        <li>Manufacturing Year 2014</li>
                                                        <li>5 Doors and Panorama View</li>
                                                    </ul>
                                                </div>
                                                <div class="button">
                                                    <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-x2x3">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <!-- Swiper -->
                                            <div class="swiper-container" id="swiperSlider2x3">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                </div>
                                                <!-- Add Pagination -->
                                                <div class="row car-thumbnails"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="car-details">
                                                <div class="price">
                                                    <strong>123.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                </div>
                                                <div class="list">
                                                    <ul>
                                                        <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                        <li>Under 25,000 Km</li>
                                                        <li>Transmission Manual</li>
                                                        <li>5 Year service included</li>
                                                        <li>Manufacturing Year 2014</li>
                                                        <li>5 Doors and Panorama View</li>
                                                    </ul>
                                                </div>
                                                <div class="button">
                                                    <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-x2x4">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <!-- Swiper -->
                                            <div class="swiper-container" id="swiperSlider2x4">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                </div>
                                                <!-- Add Pagination -->
                                                <div class="row car-thumbnails"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="car-details">
                                                <div class="price">
                                                    <strong>124.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                </div>
                                                <div class="list">
                                                    <ul>
                                                        <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                        <li>Under 25,000 Km</li>
                                                        <li>Transmission Manual</li>
                                                        <li>5 Year service included</li>
                                                        <li>Manufacturing Year 2014</li>
                                                        <li>5 Doors and Panorama View</li>
                                                    </ul>
                                                </div>
                                                <div class="button">
                                                    <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-x2x5">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <!-- Swiper -->
                                            <div class="swiper-container" id="swiperSlider2x5">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                </div>
                                                <!-- Add Pagination -->
                                                <div class="row car-thumbnails"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="car-details">
                                                <div class="price">
                                                    <strong>125.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                </div>
                                                <div class="list">
                                                    <ul>
                                                        <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                        <li>Under 25,000 Km</li>
                                                        <li>Transmission Manual</li>
                                                        <li>5 Year service included</li>
                                                        <li>Manufacturing Year 2014</li>
                                                        <li>5 Doors and Panorama View</li>
                                                    </ul>
                                                </div>
                                                <div class="button">
                                                    <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /Sub tabs content -->

                        </div>
                    </div>
                </div>

            </div>

            <!-- tab 3 -->
            <div class="tab-pane fade" id="tab-x3">

                <div class="car-big-card">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="tabs awesome-sub">
                                <ul id="tabs-x3" class="nav"><!--
                                            --><li class=""><a href="#tab-x3x1" data-toggle="tab">VW Passat CC 2.0 TDI</a></li><!--
                                            --><li class="active"><a href="#tab-x3x2" data-toggle="tab">VW Polo 1.6 TDI Comfortline</a></li><!--
                                            --><li class=""><a href="#tab-x3x3" data-toggle="tab">Toyota Corolla 1.6 Elegant</a></li><!--
                                            --><li class=""><a href="#tab-x3x4" data-toggle="tab">Honda Civic Elegance</a></li><!--
                                            --><li class=""><a href="#tab-x3x5" data-toggle="tab">Renoult Megane</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">

                            <!-- Sub tabs content -->
                            <div class="tab-content">

                                <div class="tab-pane fade" id="tab-x3x1">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <!-- Swiper -->
                                            <div class="swiper-container" id="swiperSlider3x1">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                </div>
                                                <!-- Add Pagination -->
                                                <div class="row car-thumbnails"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="car-details">
                                                <div class="price">
                                                    <strong>131.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                </div>
                                                <div class="list">
                                                    <ul>
                                                        <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                        <li>Under 25,000 Km</li>
                                                        <li>Transmission Manual</li>
                                                        <li>5 Year service included</li>
                                                        <li>Manufacturing Year 2014</li>
                                                        <li>5 Doors and Panorama View</li>
                                                    </ul>
                                                </div>
                                                <div class="button">
                                                    <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade active in" id="tab-x3x2">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <!-- Swiper -->
                                            <div class="swiper-container" id="swiperSlider3x2">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                </div>
                                                <!-- Add Pagination -->
                                                <div class="row car-thumbnails"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="car-details">
                                                <div class="price">
                                                    <strong>132.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                </div>
                                                <div class="list">
                                                    <ul>
                                                        <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                        <li>Under 25,000 Km</li>
                                                        <li>Transmission Manual</li>
                                                        <li>5 Year service included</li>
                                                        <li>Manufacturing Year 2014</li>
                                                        <li>5 Doors and Panorama View</li>
                                                    </ul>
                                                </div>
                                                <div class="button">
                                                    <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-x3x3">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <!-- Swiper -->
                                            <div class="swiper-container" id="swiperSlider3x3">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                </div>
                                                <!-- Add Pagination -->
                                                <div class="row car-thumbnails"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="car-details">
                                                <div class="price">
                                                    <strong>133.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                </div>
                                                <div class="list">
                                                    <ul>
                                                        <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                        <li>Under 25,000 Km</li>
                                                        <li>Transmission Manual</li>
                                                        <li>5 Year service included</li>
                                                        <li>Manufacturing Year 2014</li>
                                                        <li>5 Doors and Panorama View</li>
                                                    </ul>
                                                </div>
                                                <div class="button">
                                                    <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-x3x4">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <!-- Swiper -->
                                            <div class="swiper-container" id="swiperSlider3x4">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                </div>
                                                <!-- Add Pagination -->
                                                <div class="row car-thumbnails"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="car-details">
                                                <div class="price">
                                                    <strong>134.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                </div>
                                                <div class="list">
                                                    <ul>
                                                        <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                        <li>Under 25,000 Km</li>
                                                        <li>Transmission Manual</li>
                                                        <li>5 Year service included</li>
                                                        <li>Manufacturing Year 2014</li>
                                                        <li>5 Doors and Panorama View</li>
                                                    </ul>
                                                </div>
                                                <div class="button">
                                                    <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-x3x5">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <!-- Swiper -->
                                            <div class="swiper-container" id="swiperSlider3x5">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                </div>
                                                <!-- Add Pagination -->
                                                <div class="row car-thumbnails"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="car-details">
                                                <div class="price">
                                                    <strong>135.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                </div>
                                                <div class="list">
                                                    <ul>
                                                        <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                        <li>Under 25,000 Km</li>
                                                        <li>Transmission Manual</li>
                                                        <li>5 Year service included</li>
                                                        <li>Manufacturing Year 2014</li>
                                                        <li>5 Doors and Panorama View</li>
                                                    </ul>
                                                </div>
                                                <div class="button">
                                                    <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /Sub tabs content -->

                        </div>
                    </div>
                </div>

            </div>

            <!-- tab 4 -->
            <div class="tab-pane fade" id="tab-x4">

                <div class="car-big-card">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="tabs awesome-sub">
                                <ul id="tabs-x4" class="nav"><!--
                                            --><li class=""><a href="#tab-x4x1" data-toggle="tab">VW Passat CC 2.0 TDI</a></li><!--
                                            --><li class="active"><a href="#tab-x4x2" data-toggle="tab">VW Polo 1.6 TDI Comfortline</a></li><!--
                                            --><li class=""><a href="#tab-x4x3" data-toggle="tab">Toyota Corolla 1.6 Elegant</a></li><!--
                                            --><li class=""><a href="#tab-x4x4" data-toggle="tab">Honda Civic Elegance</a></li><!--
                                            --><li class=""><a href="#tab-x4x5" data-toggle="tab">Renoult Megane</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">

                            <!-- Sub tabs content -->
                            <div class="tab-content">

                                <div class="tab-pane fade" id="tab-x4x1">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <!-- Swiper -->
                                            <div class="swiper-container" id="swiperSlider4x1">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                </div>
                                                <!-- Add Pagination -->
                                                <div class="row car-thumbnails"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="car-details">
                                                <div class="price">
                                                    <strong>141.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                </div>
                                                <div class="list">
                                                    <ul>
                                                        <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                        <li>Under 25,000 Km</li>
                                                        <li>Transmission Manual</li>
                                                        <li>5 Year service included</li>
                                                        <li>Manufacturing Year 2014</li>
                                                        <li>5 Doors and Panorama View</li>
                                                    </ul>
                                                </div>
                                                <div class="button">
                                                    <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade active in" id="tab-x4x2">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <!-- Swiper -->
                                            <div class="swiper-container" id="swiperSlider4x2">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                </div>
                                                <!-- Add Pagination -->
                                                <div class="row car-thumbnails"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="car-details">
                                                <div class="price">
                                                    <strong>142.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                </div>
                                                <div class="list">
                                                    <ul>
                                                        <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                        <li>Under 25,000 Km</li>
                                                        <li>Transmission Manual</li>
                                                        <li>5 Year service included</li>
                                                        <li>Manufacturing Year 2014</li>
                                                        <li>5 Doors and Panorama View</li>
                                                    </ul>
                                                </div>
                                                <div class="button">
                                                    <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-x4x3">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <!-- Swiper -->
                                            <div class="swiper-container" id="swiperSlider4x3">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                </div>
                                                <!-- Add Pagination -->
                                                <div class="row car-thumbnails"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="car-details">
                                                <div class="price">
                                                    <strong>143.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                </div>
                                                <div class="list">
                                                    <ul>
                                                        <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                        <li>Under 25,000 Km</li>
                                                        <li>Transmission Manual</li>
                                                        <li>5 Year service included</li>
                                                        <li>Manufacturing Year 2014</li>
                                                        <li>5 Doors and Panorama View</li>
                                                    </ul>
                                                </div>
                                                <div class="button">
                                                    <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-x4x4">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <!-- Swiper -->
                                            <div class="swiper-container" id="swiperSlider4x4">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                </div>
                                                <!-- Add Pagination -->
                                                <div class="row car-thumbnails"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="car-details">
                                                <div class="price">
                                                    <strong>144.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                </div>
                                                <div class="list">
                                                    <ul>
                                                        <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                        <li>Under 25,000 Km</li>
                                                        <li>Transmission Manual</li>
                                                        <li>5 Year service included</li>
                                                        <li>Manufacturing Year 2014</li>
                                                        <li>5 Doors and Panorama View</li>
                                                    </ul>
                                                </div>
                                                <div class="button">
                                                    <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-x4x5">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <!-- Swiper -->
                                            <div class="swiper-container" id="swiperSlider4x5">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x1.jpg" alt=""/></a>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <a class="btn btn-zoom" href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                        <a href="assets/img/preview/cars/car-600x426x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="assets/img/preview/cars/car-600x426x2.jpg" alt=""/></a>
                                                    </div>
                                                </div>
                                                <!-- Add Pagination -->
                                                <div class="row car-thumbnails"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="car-details">
                                                <div class="price">
                                                    <strong>145.0</strong> <span>$/per a day</span> <i class="fa fa-info-circle"></i>
                                                </div>
                                                <div class="list">
                                                    <ul>
                                                        <li>Fuel Diesel / 1600 cm3 Engine</li>
                                                        <li>Under 25,000 Km</li>
                                                        <li>Transmission Manual</li>
                                                        <li>5 Year service included</li>
                                                        <li>Manufacturing Year 2014</li>
                                                        <li>5 Doors and Panorama View</li>
                                                    </ul>
                                                </div>
                                                <div class="button">
                                                    <a href="#" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Reservation Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /Sub tabs content -->

                        </div>
                    </div>
                </div>

            </div>
        </div>
--}}

    </div>
</section>