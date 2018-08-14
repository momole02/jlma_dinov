 @extends('rentit/carFormLayout')

@section('title')
    JLMA - Négociations
@endsection

@section('ExtraJS')
<script type="text/javascript">
	$('#negForm').hide( );
	$('#negButton').on('click',function(){
		$('#negButton').hide( );
		$('#negForm').show( );
	} );
</script>
@endsection



@section('rightBlockTitle')
Négociations
@endsection

@section('rightBlockContent')
    <div style="color:red">
        @if( $errors->any() ) 
            @foreach( $errors->all() as $err )
                <p>{{$err}}</p>
            @endforeach
        @endif
    </div>
    @isset( $negociations )
    	@isset( $details )
    	<a href="{{ route('dropBuyRequest' , ['slug' => $details->slug])}}" class="btn btn-danger" style="color:white">Retirer la demande d'achat</a><br>
    	@endisset 
    	<br>
    	<br>
    	@foreach( $negociations as $negEntry )
    		@if( $negEntry->prop_neg==0 )
    		<div style="background:#88ff88;border:1px solid green;padding:5px">
    		[ {{$negEntry->date_neg}} ] Vous demander à acheter {{ $negEntry->qte_neg }} unité(s) du véhicule à {{ $negEntry->prix_neg }} F/CFA <br>
    		</div>
    		@else 

    		<div style="background:white;border:1px solid red;padding:5px">
    		[ {{$negEntry->date_neg}} ] Le propriétaire vous propose d'acheter  {{ $negEntry->qte_neg }} unité(s) à {{ $negEntry->prix_neg }} F/CFA <br>
    		<br>
    		<a href="#" class="btn btn-primary" style="color:white">Accepter la proposition</a>
    		<a href="#" id="negButton" class="btn btn-success" style="color:white">Négocier à nouveau</a>
    		<form id="negForm">
    			Que souhaitez vous ? 

    			<div class="form-group">
    			<label>Prix:</label>
    			<input type="number" class="form-control" name="buy-price" placeholder="Quel prix proposez vous?" required >     				
    			</div>

    			<div class="form-group">
    			<label>Quantité:</label>
    			<input type="number" class="form-control" name="buy-amount" placeholder="Pour quelle quantité" required>    				
    			</div>
    			<button type="submit" class="btn btn-success">Négocier</button>
    		</form>
    		</div>


    		@endif 
    		<hr>
    	@endforeach
    @endisset

    
@endsection

