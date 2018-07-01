@extends('admin/skeleton')

@section('title')
    --JLMA-- Comptes disponibles
@endsection

@section('headerTitle')
    Comptes JLMA
@endsection

@section('headerDescription')
    Liste des clients inscrits sur la plateforme
@endsection

@section('breadcrumbs')

@endsection

@section('content')



    <div class="row">
        <div class="col-lg-12">
            <div class="box box-warning box-solid ">
                <div class="box-header with-border">
                    <h3 class="box-title">Listing clients</h3>

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
                    @include('admin/components/footerPaging' , ['route'=>'adminClients'])
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
