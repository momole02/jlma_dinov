@extends('admin/skeleton')

@section('title')
    --JLMA-- Recherche de clients
@endsection

@section('headerTitle')
    Rechercher des clients
@endsection

@section('headerDescription')
    Recherchez des clients suivant les critères définis
@endsection

@section('breadcrumbs')

@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-solid box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Rechercher clients</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('adminDoSearchClients')}}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="client-last-name" class="col-sm-2 control-label">Nom du client</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="client-last-name" name="client-last-name" placeholder="Nom du client">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="client-first-name" class="col-sm-2 control-label">Prénom du client</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="client-first-name" name="client-first-name" placeholder="Prénom du client">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="client-cni" class="col-sm-2 control-label">N°CNI </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="client-cni" name="client-cni" placeholder="Numéro CNI du client">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="client-pseudo" class="col-sm-2 control-label">Pseudo </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="client-pseudo" name="client-pseudo" placeholder="Numéro du client">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="client-location" class="col-sm-2 control-label">Situation géographique </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="client-location" name="client-location" placeholder="Situation géographique du client">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">Go !</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>

        <div class="col-lg-12">

            <div class="box box-primary box-info ">
                <div class="box-header with-border">
                    <h3 class="box-title">Resultats de la recherche</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>

                <!-- /.box-header -->
                <div class="box-body">

                    @include ('admin/components/clientsTable')
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
