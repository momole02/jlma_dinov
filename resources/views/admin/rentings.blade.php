@extends('admin/skeleton')

@section('title')
    --JLMA-- Reservations des vehicules
@endsection

@section('headerTitle')
    Reservations
@endsection

@section('headerDescription')
    Liste des reservations de véhicules
@endsection

@section('breadcrumbs')

@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-warning box-solid ">
                <div class="box-header with-border">
                    <h3 class="box-title">Listing des reservations</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    @include('admin/components/rentingsTable' , ['rentings'=>$rentings]);
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    @include('admin/components/footerPaging',['route'=>'adminRenting'])
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

