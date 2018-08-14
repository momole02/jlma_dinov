@extends('admin/skeleton')

@section('title')
    --JLMA-- Modifier véhicule
@endsection

@section('headerTitle')
    Formulaire d'édition de véhicule
@endsection

@section('headerDescription')
    Entrez les informations sur le véhicule
@endsection

@section('breadcrumbs')

@endsection

@section('content')



    <div class="row">
        <div class="col-lg-12">
            <div class="box box-warning box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Modifier véhicule</h3>

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
                        'car_slug' => isset($vehicle) ? $vehicle->slug : '',
                        'brand_list'=>isset($brandList) ? $brandList : null ,
                        'model_list'=>isset($modelList) ? $modelList : null,
                        'energy_list'=>isset($energyList) ? $energyList : null,
                        'types_list'=>isset($typesList) ? $typesList :null,
                        'speed_box_list' => [
                            ['name'=>'Automatique','value'=>'Automatique'],
                            ['name'=>'Manuelle','value'=>'Manuelle'],
                            ['name'=>'Sequentielle','value'=>'Sequentielle']
                        ],
                        'form_target' => route('adminDoEditVehicle'),
                        'form_submit_title' => 'Modifier',
                        'car_brand' => isset($vehicle) ? $vehicle->marque->libelle_marque : '',
                        'car_energy' => isset($vehicle) ? $vehicle->energie : '',
                        'car_model' => isset($vehicle) ? $vehicle->model->libelle_model : '',
                        'car_registration_number' => isset($vehicle) ? $vehicle->vehic_immat : '',
                        'car_country' => isset($vehicle) ? $vehicle->pays : '',
                        'car_year' => isset($vehicle) ? $vehicle->annee : '',
                        'car_registration_year' => isset($vehicle) ? $vehicle->annee_immat : '',
                        'car_places_count' => isset($vehicle) ? $vehicle->nb_place : '4',
                        'car_doors_count' => isset($vehicle) ? $vehicle->nb_porte : '4',
                        'car_km' => isset($vehicle) ? $vehicle->kilometrage : '30000',
                        'car_consumption' => isset($vehicle) ? $vehicle->consommation : '',
                        'car_horses_count' => isset($vehicle) ? $vehicle->cv_fiscaux : '',
                        'car_type' => isset($vehicle) ? $vehicle->type->libelle_type_vehic : '',
                        'car_speed_box' => isset($vehicle) ? $vehicle->boite_vitesse : '',
                        'car_color' => isset($vehicle) ? $vehicle->couleur : '',
                        'car_day_price' => isset($vehicle) ? $vehicle->prix : '',
                        'car_week_price' => isset($vehicle) ? $vehicle->prix_semaine : '',
                        'car_month_price' => isset($vehicle) ? $vehicle->prix_mois : '',
                        'car_year_price' => isset($vehicle) ? $vehicle->prix_an : '',
                        'car_sell_price' => isset($vehicle) ? $vehicle->prix_vente : 0,
                        'car_avail_amount' => isset($vehicle) ? $vehicle->stock_dispo : 0,
                        'car_max_discount' => isset($vehicle) ? $vehicle->marge_reduction : 0,
                        'return_page' => isset($return_page) ? $return_page : null,
                        'car_slug' => isset($vehicle) ? $vehicle->slug : '',

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
