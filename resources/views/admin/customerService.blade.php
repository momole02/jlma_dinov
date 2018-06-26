@extends('admin/skeleton')

@section('title')
    --JLMA-- Membres du service client
@endsection

@section('headerTitle')
    Service client
@endsection

@section('headerDescription')
    Ajouter/Supprimer des membres du services client
@endsection

@section('content')


    <div class="row">
        <div class="col-lg-8">
            <div class="box box-warning  ">
                <div class="box-header with-border">
                    <h3 class="box-title">Membres du service client</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <b style="color:red">Seuls les 4 premiers seront visibles sur la plateforme</b>
                    @isset( $customer_service_members )
                        <table class="table table-responsive">
                            <tr>
                                <th>Photo</th>
                                <th>Nom</th>
                                <th>Surnom</th>
                                <th>Rôle</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Supprimer</th>
                            </tr>
                            @foreach( $customer_service_members as $member )
                                <tr>
                                    <td><img class="img img-responsive" alt="photo" src="{{asset($member->photo_serv_client)}}"></td>
                                    <td>{{$member->nom_serv_client}}</td>
                                    <td>{{$member->surnom_serv_client}}</td>
                                    <td>{{$member->job_serv_client}}</td>
                                    <td>{{$member->tel_serv_client}}</td>
                                    <td>{{$member->email_serv_client}}</td>
                                    <td><a href="{{route('adminDoDropCustomerService',['slug'=>$member->slug])}}" class="btn btn-danger" style="font-size:8px">Supprimer</a></td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                </div>

                </form>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="box box-warning box-solid ">
                <div class="box-header with-border">
                    <h3 class="box-title">Ajouter un membre</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    
                    <form class="form" enctype="multipart/form-data" method="post" action="{{route('adminDoAddCustomerService')}}">
                        @csrf
                        <div class="form-group">
                            <label for="cs-photo">Photo</label>
                            <input class="form-control" type="file" id="cs-photo" name="cs-photo" required>
                        </div>

                        <div class="form-group">
                            <label for="cs-name">Nom</label>
                            <input class="form-control" type="text" id="cs-name" name="cs-name" placeholder="Nom de l'employé" required>
                        </div>

                        <div class="form-group">
                            <label for="cs-nickname">Surnom</label>
                            <input class="form-control" type="text" id="cs-nickname" name="cs-nickname" placeholder="Surnom de l'employé" required>
                        </div>

                        <div class="form-group">
                            <label for="cs-job">Poste</label>
                            <input class="form-control"  type="text" id="cs-job" name="cs-job" placeholder="Poste de l'employé" required>
                        </div>
                        <div class="form-group">
                            <label for="cs-tel">Téléphone</label>
                            <input class="form-control" type="text" id="cs-tel" name="cs-tel" placeholder="Téléphone de l'employé" required>
                        </div>
                        <div class="form-group">
                            <label for="cs-tel">Email</label>
                            <input class="form-control"  type="email" id="cs-tel" name="cs-email" placeholder="Mail de l'employé" required>
                        </div>

                        <button type="submit" class="btn btn-warning pull-right">Ajouter</button>
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
