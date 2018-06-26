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

@foreach( $list_cars as $car )
    <div class="thumbnail no-border no-padding thumbnail-car-card clearfix">
    <div class="media">

        @php
        $defpic = null ;
        if( count($car['photos'])!=0 )
            $defpic = $car['photos'][0];
        if($defpic==='<null>')
            $defpic='rentit/img/preview/cars/car-370x220x1.jpg';

        @endphp
       <a class="media-link" data-gal="prettyPhoto" href="{{asset($defpic)}}">
            <img style="width:370px;height:220px" src="{{asset($defpic)}}" alt=""/>
            <span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>
        </a>
    </div>
    <div class="caption">
        <div class="rating">
            <span class="star"></span><!--
                                            --><span class="star active"></span><!--
                                            --><span class="star active"></span><!--
                                            --><span class="star active"></span><!--
                                            --><span class="star active"></span>
        </div>
        <h4 class="caption-title"><a href="#">{{ $car['name'] }}</a></h4>
        <h5 class="caption-title-sub">Matricule : {{ $car['register'] }}</h5>
        <div class="caption-text" style="height:75px">
            <ul>
                @foreach($car['characs'] as $characs)
                    {{$characs}},
                @endforeach
            </ul>
        </div>

        <table class="table">
            <tr>
                <td><i class="fa fa-car"></i> 2013</td>
                <td><i class="fa fa-dashboard"></i> Diesel</td>
                <td><i class="fa fa-cog"></i> Auto</td>
                <td><i class="fa fa-road"></i> 25000</td>
                <td class="buttons"><a class="btn btn-theme" href="{{ route('carDetails',['slug' => $car['slug']]) }}">Details</a></td>
            </tr>
        </table>
    </div>
</div>
@endforeach
