@extends('rentit/layout')

@section('title')
    JLMA - Service de location de vehicules
@endsection

@section('contents')

    @if(Session::has('data'))
        @php
            if(Session::has('data')) $data=Session::get('data');
        @endphp
        @if(isset($data) && $data['success'] == true)
            <section id="who-we-are" class="page-section image">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 wow fadeInLeft">
                            <h2 class="section-title text-left">
                                <span> Statuts </span>
                                <small>{{ $data['result'] }} </small>
                            </h2>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endif

    <!-- PAGE-->
    @include('rentit/components/index/findBestCarSlide')
    <!-- /PAGE-->

    @include('rentit/components/index/carTypesSlide')

    <!-- PAGE-->
    @include('rentit/components/index/bigThumbs')
    <!-- /PAGE-->

    <!-- PAGE-->
    <section id="who-we-are" class="page-section image">
        <div class="container">
            <div class="row">
                <div class="col-md-6 wow fadeInLeft">
                    <h2 class="section-title text-left">
                        <small> Bienvenue sur JeLoueMonAuto.ci</small>
                        <span>Qu'est-ce que JeLoueMonAuto ?</span>
                    </h2>
                    <p>
                       
                        <p>
                        <b>Je Loue Mon Auto</b> est le premier réseau social de location de voitures et un service de covoiturage.
                        <b>Je Loue Mon Auto</b> permet de louer - près de chez soi et au meilleur prix
                        - des voitures à des particuliers qui ont le sens du service.
                        </p>
                        <p>
                            <b>Je Loue Mon Auto</b> permet aussi à chaque propriétaire de voiture de la louer à des
                        particuliers respectueux, sans aucun risque. Les locations
                        se font entre personnes de confiance qui partagent des affinités, des amis en communs ou
                        à des personnes inconnues de notre cercle d'amis.
                        </p>
                    <p>
                        <b>Je Loue Mon Auto</b> c'est aussi un espace de covoiturage destiné à mettre en relation des conducteurs
                        se rendant à une destination donnée pour leur propre compte avec des passageés allant dans
                        la même direction afin de leur permettre de partager le trajet et donc les frais qui y sont associés
                        à moindre coût.
                    </p>

                    <p>
                        <i style="font-size:20px;color:#3595ff" >Entre nous ça roule et tout le monde est gagnant!</i>
                    </p>

                    <p class="btn-row">
                        <a href="{{route('howitworks')}}" class="btn btn-theme ripple-effect btn-theme-md">Plus d'infos !</a>
                    </p>

                    </p>

                </div>
            </div>
        </div>
    </section>
    <!-- /PAGE -->


    <!-- PAGE -->
    <section class="page-section testimonials">
        <div class="container wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
            <div class="testimonials-carousel">
                <div class="owl-carousel" id="testimonials">

                    @isset($testimonials)


                        @for( $i=0;$i<min(6,count($testimonials));++$i)

                            @php
                                $testimonialEntry = $testimonials[$i];
                            @endphp

                            <div class="testimonial">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="media-object testimonial-avatar " style="width:170px;" src="{{ url($testimonialEntry->photo_tem) }}" alt="Testimonial avatar">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <div class="testimonial-text">{{$testimonialEntry->contenu_tem}}</div>
                                        <div class="testimonial-name">{{$testimonialEntry->nom_tem}} -  <span class="testimonial-position">{{$testimonialEntry->prof_tem}}</span></div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    @endisset

                </div>
            </div>
        </div>
    </section>

    <!-- PAGE-->
    @include('rentit/components/index/ourCars')
    <!-- /PAGE-->

    <!-- PAGE-->
    @include('rentit/components/index/stats')
    <!-- /PAGE-->

    <!-- PAGE-->
    @include('rentit/components/index/faqs')
    <!-- /PAGE-->

    <!-- PAGE-->
    @include('rentit/components/index/helpDesk')
    <!-- /PAGE-->

    <!-- PAGE-->
    @include('rentit/components/index/contactUs')
    <!-- /PAGE-->

@endsection



@section('ExtraJS')
    <script type="text/javascript">
        $(function(){

            $('#price-slider').val(10000,10000000);
            $('#price-slider').jRange({
                from:10000,
                to:10000000,
                format:'%s FCFA',
                step:1,
                width:500,
                showScale:true,
                isRange:true,
                theme:'theme-blue',
                onstatechange:function (){
                    console.log('Test');
                    val=$('#price-slider').val();
                    $('#price-slider-info').text(val.replace(',',' à '));
                }
            });

        });
    </script>
@endsection