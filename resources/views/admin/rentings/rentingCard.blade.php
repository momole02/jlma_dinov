@extends('admin/skeleton')

@section('title')
    --JLMA-- Reservations de véhicules
@endsection

@section('headerTitle')
    Plus d'infos
@endsection

@section('headerDescription')
    Sur la reservation choisie
@endsection

@section('breadcrumbs')

@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-warning box-solid ">
                <div class="box-header with-border">
                    <h3 class="box-title">Informations sur la reservation</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-5">
                            @isset($renting)

                                <div style="padding-bottom: 10px">
                                    <i class="fa fa-check-circle"></i>
                                    <b>Nom du locataire : </b>{{$renting->clientName}}
                                </div >
                                <div style="padding-bottom: 10px">
                                    <i class="fa fa-check-circle"></i>
                                    <b>Contact du locataire : </b>{{$renting->clientContact}}
                                </div >
                                <div style="padding-bottom: 10px">
                                    <i class="fa fa-check-circle"></i>
                                    <b>Email du locataire: </b>{{$renting->clientMail}}
                                </div >

                                <div style="padding-bottom: 10px">
                                    <i class="fa fa-check-circle"></i>
                                    <b>Raison de la location: </b>{{$renting->loc_description}}
                                </div >
                                <div style="padding-bottom: 10px">
                                    <i class="fa fa-check-circle"></i>
                                    <b>Date de début de la location: </b><i style="color:green">{{\jlma\Front_Utils::formatDate($renting->loc_datedebut)}}</i>
                                </div >
                                <div style="padding-bottom: 10px">
                                    <i class="fa fa-check-circle"></i>
                                    <b>Date de fin de la location: </b><i style="color:green">{{\jlma\Front_Utils::formatDate($renting->loc_datefin)}}</i>
                                </div >
                            @endisset
                        </div>
                        <div class="col-lg-5">
                            @isset($renting)
                                <div style="padding-bottom: 10px">
                                    <i class="fa fa-check-circle"></i>
                                    <b>Marque/Modèle du véhicule : </b>{{$renting->vehicleBrandModel}}
                                </div >
                                <div style="padding-bottom: 10px">
                                    <i class="fa fa-check-circle"></i>
                                    <b>Immatriculation du véhicule : </b>{{$renting->vehicleRegistrationNumber}}
                                </div >
                                <div style="padding-bottom: 10px">
                                    <i class="fa fa-check-circle"></i>
                                    <b>Propriétaire du véhicule: </b>{{$renting->vehicleOwnerName}}
                                </div >
                                <div style="padding-bottom: 10px">
                                    <i class="fa fa-check-circle"></i>
                                    <b>Contact propriétaire: </b>{{$renting->vehicleOwnerContact}}
                                </div >
                            @endisset
                        </div>

                    </div>

                    @isset($renting)
                        <h4><b style="color:red">Prix : {{$renting->loc_prix}} F/CFA</b></h4>
                    @endisset
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    @isset($renting)
                        @if( $renting->accepte==1 )
                            <a href="#" class="btn btn-default" style="color:green">Accepté</a>
                        @else
                            <a href="{{route('adminAcceptRenting',['slug'=>$renting->slug])}}" class="btn btn-info">Accepter la reservation</a>
                        @endif
                        <a href="{{route('adminDropRenting',['slug'=>$renting->slug])}}" class="btn btn-danger">Supprimer la reservation</a>
                    @endisset
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

