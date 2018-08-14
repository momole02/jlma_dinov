

@isset( $cars_by_categories )
<section id="offers" class="page-section">
    <div class="container">

        <h2 class="section-title wow fadeInUp" data-wow-offset="70" data-wow-delay="100ms">
            <small>Quel modèle voulez vous ?</small>
            <span>Classement par catégories</span>
        </h2>


        <div class="tabs wow fadeInUp" data-wow-offset="70" data-wow-delay="300ms">

            <ul id="tabs" class="nav">


                @php
                    $categories = array_keys( $cars_by_categories );
                    $intervalLength = min( 3,count($categories) );
                    $slicedCategories = array_slice( $categories , 0 , $intervalLength  );

                @endphp

                    @for($i=0;$i<count($slicedCategories);++$i)
                        <li class="{{$i==0?'active':''}}"><a href="#tab-{{1+$i}}" data-toggle="tab">{{ $slicedCategories[$i]}}</a></li>
                    @endfor

            </ul>
        </div>

        <div class="tab-content wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">

            @php
                $swiperClasses = [ 'swiper--offers-best' , 'swiper--offers-popular' , 'swiper--offers-economic' ];


            @endphp
            @for($i=0;$i<count($slicedCategories);++$i)
                @php
                    $carsList = $cars_by_categories[$slicedCategories[$i]];
                @endphp

                <div class="tab-pane fade {{ $i==0?'active in':'' }}" id="tab-{{1+$i}}">

                    <div class="swiper {{ $swiperClasses[$i] }}">
                        <div class="swiper-container">

                            <div class="swiper-wrapper">
                                <!-- Slides -->

                                @for( $j=0;$j<count($carsList);++$j )
                                    @php
                                        $currentCar = $carsList[$j];
                                    @endphp

                                    <div class="swiper-slide">
                                        <div class="thumbnail no-border no-padding thumbnail-car-card">
                                            <div style="height:300px" class="media">
                                                <a class="media-link" data-gal="prettyPhoto" href="{{ asset($currentCar->picture) }}">
                                                    <img src="{{ asset($currentCar->picture) }}" alt=""/>
                                                    <span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>
                                                </a>
                                            </div>
                                            <div class="caption text-center">
                                                <h4 class="caption-title"><a href="#">{{ $currentCar->marque->libelle_marque.' '.$currentCar->model->libelle_model }}</a></h4>
                                                <div class="caption-text">Louez à {{$currentCar->prix}} FCFA /jour </div>
                                                <div class="buttons">
                                                    <a class="btn btn-theme ripple-effect" href="{{route('carDetails' , ['slug'=>$currentCar->slug])}}">Louer !</a>
                                                </div>
                                                <table class="table">
                                                    <tr>
                                                        <td><i class="fa fa-car"></i> {{$currentCar->annee_immat}}</td>
                                                        <td><i class="fa fa-dashboard"></i> {{$currentCar->energie}}</td>
                                                        <td><i class="fa fa-cog"></i> {{$currentCar->boite_vitesse}}</td>
                                                        <td><i class="fa fa-road"></i> {{$currentCar->kilometrage}}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endfor

                            </div>

                        </div>

                        <div class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
                        <div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>

                    </div>

                </div>

        @endfor

        </div>


    </div>
</section>
@endisset