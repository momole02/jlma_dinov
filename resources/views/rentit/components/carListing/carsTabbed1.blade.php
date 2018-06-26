{{--

    $list_cars = tableau associatif contenant la liste des vehicules
    chaque vehicule est ennuméré sous forme de tableau comme suit:
    [
        'name' => nom et modèle du vehicule
        'photos' => tableau scalaire contenant les différents chemins des photos
        'characs' => liste d'au plus 5 caractéristiques d'un vehicule
        'price' => prix de la location par jours
    ]
    $nb_cars_per_page = nombre voitures par pages

 --}}

@php
/*calculer le nombre de pages*/
$cars_count = count($cars);
$nb_pages =(int)(ceil($cars_count/$nb_cars_per_page));

@endphp

<div class="tabs awesome wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
    <ul id="tabs1" class="nav">
        @for($i=0;$i<$nb_pages;++$i)
            <li {{ ($i==0)?"class=active":'' }} ><a href="#tab-x{{$i+1}}" data-toggle="tab">{{$i+1}}</a></li>
        @endfor

    </ul>
</div>

<div class="tab-content wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">

    @for($page=0;$page<$nb_pages;++$page)
        <!-- tab 1 -->
            <div class="tab-pane fade {{ ($page==0)? 'active in' : '' }}" id="tab-x{{$page+1}}">
                <div class="car-big-card">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="tabs awesome-sub">
                                <ul id="tabs4" class="nav">
                                    {{-- Ajouter la navigation de gauche --}}
                                    @for($index=0;$index<min($cars_count-$page*$nb_cars_per_page,$nb_cars_per_page);++$index)
                                        @php
                                            $car_index=$page*$nb_cars_per_page+$index;
                                        @endphp
                                        <li {{ ($index==0) ? 'class=active' : '' }} ><a href="#tab-x{{$page+1}}x{{$car_index+1}}" data-toggle="tab">{{ $list_cars[$car_index]['name'] }}</a></li>
                                    @endfor

                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">

                            <!-- Sub tabs content -->
                            <div class="tab-content">

                                <div class="tab-content">

                                    {{-- remplir chaque info de navigation--}}
                                    @for($index=0;$index<min($cars_count-$page*$nb_cars_per_page,$nb_cars_per_page);++$index)
                                        @php
                                            $car_index=$page*$nb_cars_per_page+$index;
                                            $current_car = $list_cars[$car_index];
                                        @endphp
                                        <div class="tab-pane fade {{ ($index==0) ? 'active in' : '' }}" id="tab-x{{$page+1}}x{{$car_index+1}}">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <!-- Swiper -->
                                                    <div class="swiper-container" id="swiperSlider{{$page+1}}x{{$index+1}}">
                                                        <div class="swiper-wrapper">
                                                            @foreach( $current_car['photos'] as $photo )
                                                                <div class="swiper-slide">
                                                                    @if($photo !=='<null>')
                                                                        <a class="btn btn-zoom" href="{{asset($photo)}}" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                        <a href="{{asset($photo)}}" data-gal="prettyPhoto"><img class="img-responsive" src="{{asset($photo)}}" alt=""/></a>
                                                                    @else
                                                                        @php $photo = 'rentit/img/preview/cars/car-600x426x1.jpg'; @endphp
                                                                        <a class="btn btn-zoom" href="{{asset($photo)}}" data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                                                                        <a href="{{asset($photo)}}" data-gal="prettyPhoto"><img class="img-responsive" src="{{asset($photo)}}" alt=""/></a>
                                                                    @endif
                                                                </div>
                                                            @endforeach

                                                        </div>

                                                        <!-- Add Pagination -->
                                                        <div class="row car-thumbnails"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="car-details">
                                                        <div class="price">
                                                            <strong>{{ $current_car['price'] }}</strong> <span>F/par jour</span> <i class="fa fa-info-circle"></i>
                                                        </div>
                                                        <div class="list">
                                                            <ul>
                                                                {{-- Lister les caractéristiques --}}
                                                                @foreach( $current_car['characs'] as $charac )
                                                                    <li>{{$charac}}</li>
                                                                @endforeach

                                                            </ul>
                                                        </div>

                                                        <div class="button">
                                                            <a href="{{ route('carDetails' , ['slug' => $current_car['slug']]) }}" class="btn btn-theme ripple-effect btn-theme-dark btn-block">Plus d'infos</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endfor


                                </div>

                            </div>
                            <!-- /Sub tabs content -->

                        </div>
                    </div>
                </div>
            </div>
    @endfor


</div>
