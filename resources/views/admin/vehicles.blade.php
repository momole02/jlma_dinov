@extends('admin/skeleton')

@section('title')
    --JLMA-- Vehicules
@endsection

@section('headerTitle')
    Liste des vehicules
@endsection

@section('headerDescription')
    Ajoutez,modifiez,supprimez des vehicules
@endsection

@section('breadcrumbs')

@endsection

@section('content')


    <div class="row">

        <div class="col-lg-12">
            <div class="box box-info box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Vehicules</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">


                    @if(isset($vehicles))
                        <form method="post" action="{{route('adminDoDropVehicleList')}}">
                            @csrf
                        <table class="table table-hover">
                                <tr>
                                    <th>Sel.</th>
                                    <th>Immatriculation </th>
                                    <th>Marque/Modèle</th>
                                    <th>Type</th>
                                    <th>Couleur</th>
                                    <th>Propriétaire</th>
                                    <th>Plus d'infos</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                @foreach( $vehicles as $vehicleEntry )
                                    <tr>
                                        <td><input type="checkbox" name="vehicles-slugs[]" value="{{$vehicleEntry->slug}}"></td>
                                        <td>{{$vehicleEntry->vehic_immat}}</td>
                                        <td>{{$vehicleEntry->marque->libelle_marque.' '.$vehicleEntry->model->libelle_model}}</td>
                                        <td>{{$vehicleEntry->type->libelle_type_vehic}}</td>
                                        <td><span style="background:{{$vehicleEntry->couleur}};color:{{$vehicleEntry->couleur}}">********</span></td>
                                        <td>{{$vehicleEntry->ownerName}}</td>
                                        <td><a class="btn btn-warning" href="{{route('adminVehicleImages' , ['slug'=>$vehicleEntry->slug ])}}">+Infos</a></td>
                                        <td><a class="btn btn-info" href="{{route('adminEditVehicle' , ['slug' => $vehicleEntry->slug ])}}">Modifier</a></td>
                                        <td><a class="btn btn-danger" href="{{route('adminDropVehicle' , ['slug'=>$vehicleEntry->slug ])}}">Supprimer</a></td>
                                    </tr>
                                @endforeach
                        </table>
                            <button type="submit" class="btn btn-danger">Supprimer séléction</button>
                        </form>
                    @endif



                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">


                    <ul class="pagination pagination-sm no-margin pull-right">

                        @if(isset($page_list))

                            @if($current_page>0 )
                                <li><a href="{{route('adminVehicles',['page' , $current_page-1])}}">«</a></li>
                            @endif

                            @foreach($page_list as $pageEntry)
                                <li>
                                    @if($pageEntry['num']!==$current_page+1)
                                        <a href="{{$pageEntry['link']}}">{{ $pageEntry['num'] }}</a>
                                    @else
                                        <a href="{{$pageEntry['link']}}"><b>{{ $pageEntry['num'] }}</b></a>
                                    @endif
                                </li>
                            @endforeach
                            @if($current_page<count($page_list)-1 )
                                <li><a href="{{route('adminVehicles',['page' => $current_page+1])}}">»</a></li>
                            @endif

                        @endif
                    </ul>
                </div>
            </div>
            <!-- /.box -->
        </div>

    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="box box-warning box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Ajouter vehicule</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>

                <!-- /.box-header -->
                <div class="box-body">


                    @php

                        if(isset($_brand_list)){
                            $brandList = array();
                            foreach( $_brand_list as $brandEntry ){
                                $brandList[] = ['name' => $brandEntry->libelle_marque , 'value' => $brandEntry->pk_id ];
                            }
                        }

                        if(isset($_model_list)){
                            $modelList = array();
                            foreach( $_model_list as $modelEntry ){
                                $modelList[] = ['name' => $modelEntry->libelle_model , 'value' => $modelEntry->id_model];
                            }
                        }

                        if( isset($_energy_list) ){
                            $energyList = array();
                            foreach( $_energy_list as $energyEntry ){
                                $energyList[] = ['name' =>$energyEntry->lib_energie , 'value'=> $energyEntry->lib_energie];
                            }
                        }

                        if( isset($_types_list) ){
                            $typesList = array();
                            foreach( $_types_list as $typeEntry ){
                                $typesList[] = ['name' =>$typeEntry->libelle_type_vehic , 'value'=>$typeEntry->id_type_vehic];
                            }
                        }



                    @endphp

                    @include('admin/forms/vehicleForm' ,
                    [
                        'brand_list'=>isset($brandList) ? $brandList : null ,
                        'model_list'=>isset($modelList) ? $modelList : null,
                        'energy_list'=>isset($energyList) ? $energyList : null,
                        'types_list'=>isset($typesList) ? $typesList :null,
                        'speed_box_list' => [
                            ['name'=>'Automatique','value'=>'Automatique'],
                            ['name'=>'Manuelle','value'=>'Manuelle'],
                            ['name'=>'Sequentielle','value'=>'Sequentielle']
                        ],
                        'form_target' => route('adminDoAddVehicle'),
                        'car_brand' => '',
                        'car_energy' => '',
                        'car_model' => '',
                        'car_registration_number' => '3322CI09',
                        'car_country' => 'Allemagne',
                        'car_year' => '2008',
                        'car_registration_year' => '2008',
                        'car_places_count' => '4',
                        'car_doors_count' => '4',
                        'car_km' => '350000',
                        'car_consumption' => '3.5',
                        'car_horses_count' => '3',
                        'car_type' => 'Breakout',
                        'car_speed_box' => 'Manuelle',
                        'car_color' => '#ffccaa',
                        'car_day_price' => '100000',
                        'car_month_price' => '200000',
                        'car_year_price' => '300000',

                    ])

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                </div>

                </form>
            </div>
        </div>

    </div>

@endsection


@section('extra-css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
@endsection

@section('extra-scripts')
    <script src="{{asset('admin/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}} "></script>
    <script src="{{asset('admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <script type="text/javascript">
        $(function(){

           $('.my-colorpicker1').colorpicker()
           $('.select2').select2()
        });

    </script>
@endsection
