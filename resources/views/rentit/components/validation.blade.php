
<ul>

    @if($errors->any())
        Quelques erreurs sont survenues lors de la validation de votre formulaire.<br/>
        Verifiez vos champs <br/>
        @foreach($errors->all() as $error)
            <li><b>{{ $error  }}</b></li>
        @endforeach
    @endif

</ul>

@if(Session::has('data') )
    <?php $data=Session::get('data')?>
    @if( array_key_exists('success' , $data) && $data['success']==false)
        <b>{{ $data['result']  }}</b>
    @endif
@endif