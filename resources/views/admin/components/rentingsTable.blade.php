{{--
    Tableau permettant de faire le listing des
    reservations à partir d'une collection qui les contient.

    $rentings <= collection contenant les données


--}}

@php
    $decodedFlags = [];
    if( isset($flags) ){
        $decodedFlags = explode('|',$flags);
    }
@endphp

<table class="table table-hover">
    <tbody>
    <tr>
        <th>Locataire</th>
        <th>Contact loc.</th>
        <th>Debut location</th>
        <th>Fin location</th>
        <th>Lieu remise</th>
        <th>Prix</th>
        <th>Vehicule</th>

        <th>+info location</th>

        @if(!in_array('no-client-info',$decodedFlags))
            <th>+info client</th>
        @endif

        <th>+info vehicule</th>
        <th>Verdict</th>
    </tr>

    @isset($rentings)
        @foreach( $rentings as $rentingEntry )
            <tr>
                <td>{{$rentingEntry->clientName}}</td>
                <td>{{$rentingEntry->clientContact}}</td>
                <td>{{$rentingEntry->loc_datedebut}}</td>
                <td>{{$rentingEntry->loc_datefin}}</td>
                <td>{{$rentingEntry->loc_lieu_remise}}</td>
                <td>{{$rentingEntry->loc_prix}}</td>
                <td>{{$rentingEntry->vehicleBrandModel}} - {{$rentingEntry->vehicleRegistrationNumber}}</td>
                <td><a href="{{route('adminRentingCard',['slug'=>$rentingEntry->slug])}}" class="btn btn-info">+Reservation</a></td>
                @if(!in_array('no-client-info',$decodedFlags))
                <td><a href="#" class="btn btn-info">+Client</a></td>
                @endif

                <td><a href="{{route('adminVehicleImages',['slug'=>$rentingEntry->vehicleSlug])}}" class="btn btn-info">+Vehicule</a></td>

                <td>
                    @if(isset($readonly) && $readonly==true)

                        @if( $rentingEntry->accepte!=1 )
                            <b style="color:red">Pas encore accepté</b>
                        @else
                            <b style="color:green">Reservation acceptée</b>
                        @endif

                    @else
                        @if( $rentingEntry->accepte!=1 )
                            <a href="{{route('adminAcceptRenting',['slug'=>$rentingEntry->slug]) }}" class="btn btn-info"><i class="fa fa-check"></i>  Accepter</a>
                            <br>
                            <br>
                            <a href="{{route('adminDropRenting',['slug'=>$rentingEntry->slug])}}" class="btn btn-danger"><i class="fa fa-minus"></i>  Supprimer</a>
                        @else
                            <b class="btn btn-default"style="color:green">Accepté</b><br><br>
                            <a href="{{route('adminDropRenting',['slug'=>$rentingEntry->slug])}}" class="btn btn-danger"><i class="fa fa-minus"></i>  Supprimer</a>
                        @endif

                    @endif


                </td>
            </tr>
        @endforeach
    @endisset
    </tbody></table>