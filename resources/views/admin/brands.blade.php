@extends('admin/skeleton')

@section('title')
    --JLMA-- Gestion des marques, modèles et types de véhicules
@endsection

@section('headerTitle')
    Gestion des marques
@endsection

@section('headerDescription')
    Ajoutez, supprimez des marques, modèles et types de véhicules
@endsection

@section('content')

    <div class="row">

        <div class="col-lg-4">
            <div class="box box-success  ">
                <div class="box-header with-border">
                    <h3 class="box-title">Marques</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                        <form class="form" method="post" action="{{route('adminDoAddVehicleBrand')}}">
                            @csrf
                            <div class="col-md-8">
                                <input type="text" name="brand-name" class="form-control" placeholder="Marque à ajouter">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i></button>
                            </div>
                        </form>
                    <br>
                    <br>
                    <form class="form" method="post" action="{{route('adminDoDropVehicleBrand')}}">
                        @csrf
                        <select name="brands-list[]"  multiple="true" style="width:100%;height:400px">

                            @isset($brands)
                                @foreach( $brands as $brandEntry )
                                    <option value="{{$brandEntry->pk_id}}">{{$brandEntry->libelle_marque}}</option>
                                @endforeach
                            @endisset
                        </select>
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                </div>

                </form>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="box box-warning  ">
                <div class="box-header with-border">
                    <h3 class="box-title">Modèles</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>

                <!-- /.box-header -->
                <div class="box-body">

                    <form class="form" method="post" action="{{route('adminDoAddVehicleModel')}}">
                        @csrf
                        <div class="col-md-8">
                            <input type="text" name="model-name" class="form-control" placeholder="Modèle à ajouter">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i></button>
                        </div>
                    </form>
                    <br>
                    <br>
                    <form class="form" method="post" action="{{route('adminDoDropVehicleModel')}}">
                        @csrf
                        <select name="models-list[]"  multiple="true" style="width:100%;height:400px">

                            @isset($models)
                                @foreach( $models as $modelEntry )
                                    <option value="{{$modelEntry->id_model}}">{{$modelEntry->libelle_model}}</option>
                                @endforeach
                            @endisset
                        </select>
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                </div>

                </form>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="box box-danger  ">
                <div class="box-header with-border">
                    <h3 class="box-title">Types</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>

                <!-- /.box-header -->
                <div class="box-body">

                    <form class="form" method="post" action="{{route('adminDoAddVehicleType')}}">
                        @csrf
                        <div class="col-md-8">
                            <input type="text" name="type-name" class="form-control" placeholder="Type à ajouter">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i></button>
                        </div>
                    </form>
                    <br>
                    <br>
                    <form class="form" method="post" action="{{route('adminDoDropVehicleType')}}">
                        @csrf
                        <select name="types-list[]"  multiple="true" style="width:100%;height:400px">

                            @isset($types)
                                @foreach( $types as $typeEntry )
                                    <option value="{{$typeEntry->id_type_vehic}}">{{$typeEntry->libelle_type_vehic}}</option>
                                @endforeach
                            @endisset
                        </select>
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
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
    <link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('extra-scripts')

    <script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script>

        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>
@endsection

