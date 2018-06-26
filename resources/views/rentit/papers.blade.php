@extends('rentit/layout')


@section('title')
    -- JeLoueMonAuto.ci -- Pièces
@endsection


@section('contents')

    @include('rentit/components/breadcrumbs', [
       'title' => 'Inscription',
       'pages' => [
           'Accueil' => ['active' => false , 'link' => route('home')],
           'Inscription' => ['active' => false , 'link' => '#'],
        ]
   ])


    <section class="page-section image subscribe">
        <div class="container">

            <h2 class="section-title wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
                <span>{{ $title }}</span>
                <small>{{ $desc }}</small>
            </h2>

            <div class="row wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
                <div class="col-md-8 col-md-offset-2">

                    <!-- Subscribe form -->
                    <form method="post" enctype="multipart/form-data" action="{{$targetRoute}}" class="formart">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div style="border:1px solid black;margin-bottom:10px">
                            <div class="form-group">
                                <input type="file" name="img-file" id="img1" class="form-control" >
                            </div>

                            @include('rentit/components/validation')

                            <div id="error" style="color:red">
                            </div>

                            <div align="center">
                                <img id="img1_target" style="width:500px" src="{{asset('rentit/img/preview/avatars/testimonial-140x140.jpg')}}">
                            </div>
                            <br>

                            <div align="center">
                                <button type="submit" id="imgSubmit" class="btn btn-theme" disabled>Envoyer</button>
                            </div>

                            <br/>
                        </div>

                    </form>

                    <!-- Subscribe form -->
                </div>
            </div>


        </div>
    </section>

@endsection

@section('ExtraJS')

    <script type="text/javascript">
        var imgOk=false;
        $(function(){

            $('#img1').change(function(){
                var file = this.files[0];
                if(file.type == "image/png" || file.type == "image/jpg" || file.type=="image/jpeg"){
                    imgOk=true;
                    var reader = new FileReader();
                    reader.onload = function(e){
                        console.log('Loaded');
                        $('#img1_target').attr('src',e.target.result);
                    }
                    reader.readAsDataURL(file);
                    $("#imgSubmit").removeAttr('disabled');
                }else{
                    $('#error').text("Veuillez choisir une image JPEG ou PNG");
                }
            });


        });

    </script>
@endsection