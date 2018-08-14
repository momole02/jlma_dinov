@extends('rentit/layout')


@section('contents')

    <!-- BREADCRUMBS -->
    <section class="page-section breadcrumbs text-right">
        <div class="container">
            <div class="page-header">
                <h1>Acheter véhicule</h1>
            </div>
            <ul class="breadcrumb">
                <li><a href="#">Accueil</a></li>
                <li class="active">Connexion</li>
            </ul>

        </div>


    </section>
    <!-- /BREADCRUMBS -->

@isset( $details )
<section class="page-section color">
    <div class="container">
        <div class="row">

            <div class="col-sm-6" >
                <h3 class="block-title"><span>Informations véhicule</span></h3>
                <div>
                    @if( count($details->liste_photos)>0 )
                        <div style="text-align: center">
                        <a href="{{Storage::url($details->liste_photos[0])}}"><img class="img img-responsive img-thumbnail" src="{{Storage::url($details->liste_photos[0])}}"></a>
                        </div>
                    @endif 
                    @if( $details->prix_vente!=0 )
                    <table class="table table-responsive table-hover">
                        <tr>
                            <th>Marque modèle</th>
                            <th>Immatriculation</th>
                            <th>Prix unitaire</th>
                        </tr>
                        <tr>
                            <td>{{$details->marque->libelle_marque}} {{$details->model->libelle_model}}</td>
                            <td> {{$details->vehic_immat}}</td>
                            <td><span style="color:red">{{\jlma\Front_Utils::formatPrice($details->prix_vente)}}</span> F/CFA</td>
                        </tr>
                    </table>
                    @else 
                        <h4>Ce véhicule n'est pas à vendre</h4>
                    @endif 


                </div>

            </div>

            <div class="col-sm-6" >
                <h3 class="block-title"><span>@yield('rightBlockTitle')</span></h3>
                @yield('rightBlockContent')
            </div>
        </div>
    </div>
</section>
@endisset

@endsection