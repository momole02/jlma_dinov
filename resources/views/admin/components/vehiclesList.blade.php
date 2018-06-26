@if(isset($vehicles))
    @foreach( $vehicles as $vehicleEntry )
        <table >
            <tr >
                <td style="width:250px;padding:5px;background:#cccccc;font-size:20px;color:white" colspan="2" >{{$vehicleEntry->marque->libelle_marque.' '.$vehicleEntry->model->libelle_model}}</td>
            </tr>
            <tr>
                <td style="width:250px;padding:5px;background:#dddddd">
                    <div align="center">
                        @if(isset($vehicleEntry->liste_photos) && count($vehicleEntry->liste_photos)>0)
                            <img width="200" src="{{asset(Storage::url($vehicleEntry->liste_photos[0]))}}">
                        @endif
                    </div>
                </td>
                <td style="width:500px;padding:5px;background:#eeeeee">
                    <ul>
                        <li><b>Marque/Modèle</b> : {{$vehicleEntry->marque->libelle_marque.' '.$vehicleEntry->model->libelle_model}}</li>
                        <li><b>Type</b> : {{$vehicleEntry->type->libelle_type_vehic}}</li>
                        <li><b>Immatriculation</b> :<b style="color:blue">{{$vehicleEntry->vehic_immat}} </b></li>
                        <li><b>Couleur</b>: <span style="background:{{$vehicleEntry->couleur}};color:{{$vehicleEntry->couleur}}">********</span></li>
                        <li><b>Année</b>: {{$vehicleEntry->annee}}</li>
                        <li><b>Description</b>: {{nl2br($vehicleEntry->description)}}</li>
                        <li><b>Nombre de places</b>: {{nl2br($vehicleEntry->nb_place)}}</li>
                        <li><b>Nombre de portes</b>: {{$vehicleEntry->nb_porte}}</li>
                        <li><b>Pays d'origine</b>: {{$vehicleEntry->pays}}</li>
                        <li><b>Consomation</b>: {{$vehicleEntry->consommation}}</li>
                        <li><b>Energie</b>: {{$vehicleEntry->energie}}</li>
                        <li><b>Boite à vitesse</b>: {{$vehicleEntry->boite_vitesse}}</li>
                        <li><b>Nombre de chevaux</b>: {{$vehicleEntry->cv_fiscaux}}</li>
                    </ul>
                    <ul>
                        <li><b>Propriétaire : </b><i style="color:green">{{$vehicleEntry->ownerName}}</i></li>
                        <li><b>Contact: </b><i style="color:green">{{$vehicleEntry->ownerContact}}</i></li>
                    </ul>
                    <br>

                    <table border="1" align="right">
                        <tr style="background:white;color:#5c92ed;font-weight:bold">
                            <td style="padding:3px">Prix par jour</td>
                            <td style="padding:3px">Prix par mois</td>
                            <td style="padding:3px">Prix par an</td>
                        </tr>
                        <tr style="background:white;color:red">
                            <td style="padding:3px"><b>{{$vehicleEntry->prix}}</b> F/CFA</td>
                            <td style="padding:3px"><b>{{$vehicleEntry->prix_mois}}</b> F/CFA</td>
                            <td style="padding:3px"><b>{{$vehicleEntry->prix_an}}</b> F/CFA</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding:5px;background:#cccccc;font-size:20px;color:white" colspan="2">
                    <a class="btn btn-info" href="{{route('adminEditVehicle' , ['slug' => $vehicleEntry->slug ])}}">Modifier</a>
                    <a class="btn btn-warning" href="{{route('adminVehicleImages' , ['slug'=>$vehicleEntry->slug ])}}">Gérer les médias</a>
                    <div class="pull-right">
                        <a class="btn btn-danger" href="{{route('adminDropVehicle' , ['slug'=>$vehicleEntry->slug ])}}">Supprimer</a>
                    </div>
                </td>
            </tr>
        </table>

        <br/>
        <br/>
    @endforeach
@endif
