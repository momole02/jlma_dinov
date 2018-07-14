
@extends('admin/skeleton')

@section('title')
    --JLMA-- Médias des vehicules
@endsection

@section('headerTitle')

    Médias du vehicule
@endsection

@section('headerDescription')
    Ajouter,supprimer des images/vidéos au véhicule
@endsection

@section('breadcrumbs')

@endsection

@section('content')

    <div class="row">

        <div class="col-lg-7">
            <div class="col-lg-12">
                <div class="box box-info box-solid ">
                    <div class="box-header with-border">
                        <h3 class="box-title">informations sur le vehicule</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">

                        @if(isset($readonly) && $readonly==true)
                            <p style="font-weight:bold;color:red">
                                <i>Vos droits sur ce véhicule sont restreints</i><br/>
                            </p>
                        @endif
                        @isset($vehicle)
                            @php
                                $vehicleEntry=$vehicle
                            @endphp

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

                            <table border="1" align="right">
                                <tr style="background:white;color:#5c92ed;font-weight:bold">
                                    <td style="padding:3px">Prix par jour</td>
                                    <td style="padding:3px">Prix par semaine</td>
                                    <td style="padding:3px">Prix par mois</td>
                                    <td style="padding:3px">Prix par an</td>
                                </tr>
                                <tr style="background:white;color:red">
                                    <td style="padding:3px"><b>{{$vehicleEntry->prix}}</b> F/CFA</td>
                                    <td style="padding:3px"><b>{{$vehicleEntry->prix_semaine}}</b> F/CFA</td>
                                    <td style="padding:3px"><b>{{$vehicleEntry->prix_mois}}</b> F/CFA</td>
                                    <td style="padding:3px"><b>{{$vehicleEntry->prix_an}}</b> F/CFA</td>
                                </tr>
                            </table>
                        @endisset
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                    </div>

                    </form>
                </div>
            </div>

            <div class="col-lg-12">

                <div class="box box-info box-solid ">
                    <div class="box-header with-border">
                        <h3 class="box-title">Listing des images</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="row">

                            <div class="col-lg-12">
                                <table class="table table-responsive table-hover">
                                    <tr>
                                        <th>Image</th>
                                        <th>Supprimer</th>
                                    </tr>
                                    @isset($pictures_list)
                                        @foreach( $pictures_list as $picture )
                                            <tr>
                                                <td>
                                                    <div style="width:150px" >
                                                        <a href="{{asset(Storage::url($picture['path']))}}">
                                                            <img src="{{asset(Storage::url($picture['path']))}}" class="img img-responsive img-thumbnail">
                                                        </a>
                                                    </div>

                                                </td>
                                                <td>
                                                    @if(!isset($readonly) || $readonly==false)
                                                        <a href="{{ route('adminDropVehicleImage' , ['id'=>$picture['id']]) }}" class="btn btn-danger">Supprimer</a>
                                                    @endif
                                                </td>
                                            </tr>

                                        @endforeach
                                    @endisset

                                </table>
                            </div>

                        </div>

                        <hr>



                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                    </div>

                    </form>
                </div>
            </div>

            @if( !isset($readonly) || $readonly==false )
                <div class="col-lg-12">
                <div class="box box-info box-solid ">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ajouter une nouvelle image </h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">


                        <form class="form" method="post" action="{{route('adminDoAddVehicleImage')}}"enctype="multipart/form-data">
                            @csrf
                            @isset( $car_slug )
                                <input type="hidden" value="{{$car_slug}}" name="car-slug">
                            @endisset

                            <div class="form-group">
                                <label>Fichier image: </label>
                                <input class="form-control" type="file" name="picture">
                            </div>
                            <input type="submit" class="btn btn-info" value="Ajouter"></form>
                        </form>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                    </div>

                    </form>
                </div>
            </div>
            @endif

        </div>

        <div class="col-lg-5">
            <div class="col-lg-12">
                <div class="box box-danger box-solid ">
                    <div class="box-header with-border">
                        <h3 class="box-title">Vidéo du véhicule</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">

                        <iframe height="315"  {{isset($video_link) ? 'src="'.$video_link.'"' : ''}} >

                        </iframe>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                    </div>

                    </form>
                </div>
            </div>

            @if(!isset($readonly) || $readonly==false)
                <div class="col-lg-12">
                <div class="box box-danger box-solid ">
                    <div class="box-header with-border">
                        <h3 class="box-title">Modifier la vidéo</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">

                        <form class="form" method="post" action="{{route('adminDoChangeVehicleVideoLink')}}">
                            @csrf

                            @isset( $car_slug )
                                <input type="hidden" value="{{$car_slug}}" name="car-slug">
                            @endisset
                            <div class="form-group">
                                <label>Lien vidéo: </label>
                                <input class="form-control" type="text" value="{{isset($video_link)?$video_link:''}}" name="video-link">
                            </div>
                            <input class="btn btn-danger" type="submit" value="Modifier la vidéo">
                        </form>
                        </form>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                    </div>

                    </form>
                </div>
            </div>
            @endif
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-warning box-solid ">
                <div class="box-header with-border">
                    <h3 class="box-title">Documents du véhicule</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Lien de téléchargement</th>
                            @if(!isset($readonly) || $readonly==false)
                                <th>Supprimer</th>
                            @endif
                        </tr>
                        @isset($vehicle_docs)
                            @foreach( $vehicle_docs as $vehicleDocEntry )
                                <tr>
                                    <td>{{$vehicleDocEntry->id_doc}}</td>
                                    <td>{{nl2br($vehicleDocEntry->titre_doc)}}</td>
                                    <td>{{nl2br($vehicleDocEntry->description_doc)}}</td>
                                    @php
                                        $route = route('adminDropVehicleDocument' ,
                                        [
                                            'docSlug' => $vehicleDocEntry->slug
                                        ]
                                        );

                                    @endphp
                                    <td><a href="{{asset(Storage::url($vehicleDocEntry->chemin_doc))}}" class="btn btn-info">Télécharger</a></td>
                                    @if(!isset($readonly) || $readonly==false)
                                        <td><a href="{{$route}}" class="btn btn-danger">Supprimer</a></td>
                                    @endif
                                </tr>
                            @endforeach
                        @endisset

                        </tbody>
                    </table>

                    @if(!isset($readonly) || $readonly==false)
                    <h3>Ajouter un document</h3>
                    <form class="form" action="{{route('adminDoAddVehicleDocument')}}"method="post" enctype="multipart/form-data">

                        @csrf
                        @isset( $return_page )
                            <input type="hidden" value="{{$return_page}}" name="return-page">
                        @endisset

                        @isset( $car_slug )
                            <input type="hidden" value="{{$car_slug}}" name="car-slug">
                        @endisset

                        <div class="form-group">
                            <label for="doc-title">Intitulé du document:</label>
                            <input type="text" class="form-control" name="doc-title" id="doc-title" required>
                        </div>
                        <div class="form-group">
                            <label for="doc-file">Fichier:</label>
                            <input type="file" class="form-control" name="doc-file" id="doc-file" required>
                        </div>

                        <div class="form-group">
                            <label for="doc-description">Description</label>
                            <textarea cols="40" rows="10" class="form-control"  name="doc-description" id="doc-description"></textarea>
                        </div>

                        <input type="submit" class="btn btn-warning" value="Ajouter">
                    </form>
                    @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                </div>

                </form>
            </div>
        </div>
    </div>

@endsection