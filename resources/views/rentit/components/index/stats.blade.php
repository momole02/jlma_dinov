<section class="page-section image">
    <div class="container">

        <div class="row">

            @isset( $stats )
                @for( $i=0;$i<min(4,count($stats));++$i )
                    @php
                        $statEntry = $stats[$i];
                    @endphp
                    <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
                        <div class="thumbnail thumbnail-counto no-border no-padding">
                            <div class="caption">
                                <div class="caption-icon"><i class="fa {{$statEntry->icone_stat}}"></i></div>
                                <div class="caption-number">{{$statEntry->valeur_stat}}</div>
                                <h4 class="caption-title">{{$statEntry->variable_stat}}</h4>
                            </div>
                        </div>
                    </div>
                @endfor
            @endisset

        </div>

    </div>
</section>