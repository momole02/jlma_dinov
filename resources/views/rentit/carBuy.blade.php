@extends('rentit/carFormLayout')

@section('title')
    JLMA - Acheter véhicule
@endsection

@section('ExtraJS')
<script type="text/javascript">
    $(function(){
       $('#negPanel').hide( );
        $('#negButton').on('click' , function(){
            $('#negPanel').show( );
            $('#negButton').hide( );
            $('#negValue').val('true');
        });
    });
</script>
@endsection

@section('rightBlockTitle')
Formulaire d'achat
@endsection

@section('rightBlockContent')
    <div style="color:red">
        @if( $errors->any() ) 
            @foreach( $errors->all() as $err )
                <p>{{$err}}</p>
            @endforeach
        @endif
        
    </div>
    @if( $details->prix_vente!=0 )
    <div>
        Prix unitaire du vehicule:
        <span style="color:red">{{ \jlma\Front_Utils::formatPrice($details->prix_vente) }}</span> F/CFA
        <br>
        <button id="negButton" class="btn btn-success" >Cliquez ici pour négocier</button>
        <br><br>
    </div>
    <form id="reservationForm" action="{{route('doCarSellRequest')}}" method="post">
                <input type="hidden" name="slug" value="{{$details->slug}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="negociate" value="false" id="negValue" >

                <div class="form-group has-icon has-label"> 
                    <div id="negPanel">
                        <label style="font-size: 12px">A combien voulez vous acheter ?</label><br> 
                        <input type="number" value="{{$details->prix_vente}}" class="form-control" name="buy-price" required>
                        <span class="form-control-icon"></i></span>    
                    </div>

                </div>
                <div class="form-group has-icon has-label">
                    <label style="font-size: 12px">Quantité : </label>
                    <input type="number" class="form-control" name="buy-amount" required>
                    <span class="form-control-icon"><i class="fa fa-times"></i></span>
                </div>
                <button type="submit" id="formSearchSubmit3" class="btn btn-danger" style="width:100%;padding:10px;font-weight: bold;">ACHETER !</button>
        </form>
    @else
    <h4>Ce véhicule n'est pas à vendre</h4>
    @endif 

@endsection

