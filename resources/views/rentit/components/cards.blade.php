{{--

$cards = tableau scalaire contenan les données des cartes
chaque donnée est un tableau associatif de la forme
[
    'photo' => chemin vers la photo
    'title' => titre
    'subtitle' => sous titre
    'data' => tableau scalaire enumérant les données
    'endmark' => element en rouge à droite
    'ops' => tableaux scalaire des opérations
    ou chaque opération est comme suit
    [
        'title' => titre
        'link' => 'lien'
    ]
}

 --}}

@foreach( $cards as $card )

    <div class="row">
        <div class="col-md-12 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
            <div class="thumbnail thumbnail-team no-border no-padding">
                <div class="media">
                    <img src="{{asset($card['photo'])}}" alt=""/>
                </div>
                <div class="caption">
                    <h4 class="caption-title">{{$card['title']}}<small>{{$card['subtitle']}}</small></h4>
                    <ul class="team-details">
                        @foreach($card['data'] as $data)
                            <li>{!! $data  !!} </li>
                        @endforeach
                    </ul>
                    <h4 align="right" style="color:#ff9800"><b>{{$card['endmark']}}</b></h4>
                    @foreach($card['ops'] as $ops)
                        <a href="{{ $ops['link'] }}" class="btn btn-theme">{{$ops['title']}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endforeach

