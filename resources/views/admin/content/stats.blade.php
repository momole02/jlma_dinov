@extends('admin/skeleton')

@section('title')
    --JLMA-- Statistiques
@endsection

@section('headerTitle')
    Statistiques
@endsection

@section('headerDescription')
    Gestion des statistiques à afficher sur JLMA
@endsection

@section('content')


    <div class="row">
        <div class="col-lg-12">
            <div class="box box-info  ">
                <div class="box-header with-border">
                    <h3 class="box-title">Statistiques</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <b style="color:red">Seuls les 4 premières stats seront visibles</b>
                    @isset( $stats )
                        <table class="table table-responsive">
                            <tr>
                                <th>Variable</th>
                                <th>Valeur</th>
                                <th>Icone légende</th>
                                <th>Option</th>
                            </tr>

                            @foreach( $stats as $statEntry )
                                <tr>
                                    <td>{{$statEntry->variable_stat}}</td>
                                    <td>{{$statEntry->valeur_stat}}</td>
                                    <td><div><i style="font-size:50px" class="fa {{$statEntry->icone_stat}}"></i></div></td>
                                    <td><a href="{{route('adminDoDropStat',['slug'=>$statEntry->slug])}}" class="btn btn-danger">Supprimer</a></td>
                                </tr>
                            @endforeach

                            <form class="form" method="post" action="{{route('adminDoAddStat')}}">
                                @csrf
                                <tr>
                                    <td><input type="text" class="form-control" name="stat-variable" placeholder="Variable" required></td>
                                    <td><input type="text" class="form-control" name="stat-value" placeholder="Valeur" required></td>
                                    <td><input type="text" class="form-control" name="stat-icon" placeholder="Icon font awesome" required></td>
                                    <td><button type="submit" class="btn btn-success">Ajouter</button></td>
                                </tr>
                            </form>
                        </table>
                    @endisset
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
