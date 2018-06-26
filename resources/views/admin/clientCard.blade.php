@extends('admin/skeleton')

@section('title')
    --JLMA-- Fiche client
@endsection

@section('headerTitle')
    Fiche client
@endsection

@section('headerDescription')
    Plus d'infos sur un client
@endsection

@section('content')

    <div class="row">

        <div class="col-lg-5">
            <div class="box box-info  ">
                <div class="box-header with-border">
                    <h3 class="box-title">Informations personnelles</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    @isset($client)
                        <div style="width:150px;padding-bottom:20px">

                            @if($client->photo != 'non-assigne')
                                <a href="{{asset($client->photo)}}"><img class="img img-responsive img-circle" src="{{asset($client->photo)}}"></a>
                            @else
                                <img class="img img-responsive img-circle" src="{{asset('img/team-270x270.jpg')}}">
                            @endif
                        </div>

                        <div style="padding-bottom:15px"><b>Nom : </b>{{$client->civilite}} {{$client->nom}} </div>
                        <div style="padding-bottom:15px"><b>Prénom : </b>{{$client->prenom}}</div>
                        <div style="padding-bottom:15px"><b>Date de naissance : </b>{{\jlma\Front_Utils::formatDate($client->date_naiss,false,false)}}</div>
                        <div style="padding-bottom:15px"><b>Situation géographique : </b>{{$client->situationgeo}}</div>
                        <div style="padding-bottom:15px"><b>Contact : </b>{{$client->contact}}</div>
                        <div style="padding-bottom:15px"><b>Email : </b>{{$client->email}}</div>

                    @endisset
                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                </div>

                </form>
            </div>
        </div>
        <div class="col-lg-7">

            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Informations compte</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>

                <!-- /.box-header -->



                <div class="box-body">
                    @isset($client)
                        <div style="padding-bottom:15px"><b>Pseudonyme : </b>{{$client->accountData->login}}</div>
                        <div style="padding-bottom:15px"><b>Date de création : </b>{{$client->accountData->cpte_datecreate}}</div>
                    @endisset
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    @isset( $client )
                        @if( ((int)$client->accountData->actif)!=1 )
                            <a href="{{route('adminDoActivateAccount',['slug'=>$client->accountData->slug,'status'=>1])}}" class="btn btn-info">Activer le compte</a>
                        @else
                            <a href="{{route('adminDoActivateAccount',['slug'=>$client->accountData->slug,'status'=>3])}}" class="btn btn-warning">Suspendre le compte</a>
                        @endif
                        <a href="{{route('adminDoDropClient',['slug' =>$client->accountData->slug])}}" class="btn btn-danger">Supprimer le compte</a>
                        <a href="{{route('adminDoZeroPassword',['slug' =>$client->accountData->slug])}}" class="btn btn-info">Reinitialiser le mot de passe</a>
                    @endisset
                </div>
                </form>
            </div>
        </div>

    </div>

    <div clas="row">
        <div class="col-lg-12">
            <div class="box box-info box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Reservations du client</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>

                <!-- /.box-header -->

                <div class="box-body">
                    @include('admin/components/rentingsTable',['flags'=>'no-client-info'])
                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                </div>
                </form>
            </div>
        </div>
    </div>
    <div clas="row">
        <div class="col-lg-12">
            <div class="box box-warning box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Vehicules du client </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>

                <!-- /.box-header -->

                <div class="box-body">
                    @include('admin/components/vehiclesList')
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

