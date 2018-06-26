@extends('admin/skeleton')

@section('title')
    --JLMA-- Témoignages
@endsection

@section('headerTitle')
    Gérer les témoignages JLMA
@endsection

@section('headerDescription')

@endsection


@section('content')


    <div class="row">

        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Listing des témoignages</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    @isset($testimonials)
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>Photo</th>
                            <th>Nom et Prénom</th>
                            <th>Profession</th>
                            <th>Temoignage</th>
                            <th>Supprimer</th>
                        </tr>
                        @foreach( $testimonials as $testimonialEntry)
                            <tr>
                                <td><div style="width:100px;"><img class="img img-responsive" src="{{asset($testimonialEntry->photo_tem)}}" alt="photo"></div></td>
                                <td>{{$testimonialEntry->nom_tem}}</td>
                                <td>{{$testimonialEntry->prof_tem}}</td>
                                <td>{{$testimonialEntry->contenu_tem}}</td>
                                <td><a href="{{route('adminDoDropTestimonial',['slug'=>$testimonialEntry->slug])}}" class="btn btn-danger">Supprimer</td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody></table>
                    @endisset
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>


        <div class="col-md-4">
            <div class="box box-info box-solid">
                <div class="box-header with-border">

                    <h3 class="box-title">Ajouter un témoignage</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <form class="form" enctype="multipart/form-data" method="post" action="{{route('adminDoAddTestimonial')}}">
                        @csrf
                        <div class="form-group">
                            <label for="testimonial-name">Nom et prénom</label>
                            <input type="text" class="form-control" name="testimonial-name" id="testimonial-name" required>
                        </div>
                        <div class="form-group">
                            <label for="testimonial-job">Profession</label>
                            <input type="text" class="form-control" name="testimonial-job" id="testimonial-job" required>
                        </div>
                        <div class="form-group">
                            <label for="testimonial-photo">Photo</label>
                            <input type="file" class="form-control" name="testimonial-photo" id="testimonial-photo" required>
                        </div>
                        <div class="form-group">
                            <label for="testimonial-content">Contenu</label>
                            <textarea cols="30" rows="5" class="form-control" name="testimonial-content" id="testimonial-content" required></textarea>
                        </div>
                        <button class="btn btn-info pull-right" type="submit">Ajouter</button>
                    </form>

                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">

                </div>
            </div>
            <!-- /.box -->
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
