@extends('admin/skeleton')

@section('title')
    --JLMA-- Recherche de reservations
@endsection

@section('headerTitle')
    Rechercher des reservations
@endsection

@section('headerDescription')
    Recherchez des reservations en fonction des paramètres ci-dessous
@endsection

@section('breadcrumbs')

@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-solid box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Rechercher reservations</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('adminDoSearchRentings')}}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="renting-begin-date" class="col-sm-2 control-label">Début période</label>
                            <div class="col-sm-5">
                                <input type="date" class="form-control" id="renting-begin-date" name="renting-begin-date">
                            </div>
                            <div class="col-sm-5">
                                <input type="time" class="form-control" id="renting-begin-time" name="renting-begin-time">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="renting-end-date" class="col-sm-2 control-label">Fin période</label>
                            <div class="col-sm-5">
                                <input type="date" class="form-control" id="renting-end-date" name="renting-end-date">
                            </div>
                            <div class="col-sm-5">
                                <input type="time" class="form-control" id="renting-end-time" name="renting-end-time">
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="renting-accepted" > Ne rechercher que des reservations acceptées
                                </label>
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

                    @if( Session::has('jlma-admin-search-rentings-data') )
                        @php($rentings=Session::get('jlma-admin-search-rentings-data'))
                        @include('admin/components/rentingsTable' , ['rentings'=>$rentings])
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
