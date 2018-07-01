@extends('rentit/layout')

@section('title')
    JLMA - Tentative d'inscription
@endsection

@section('contents')

    <!-- BREADCRUMBS -->
    <section class="page-section breadcrumbs text-right">
        <div class="container">
            <div class="page-header">
                <h1>Recherche de vehicule</h1>
            </div>
            <ul class="breadcrumb">
                <li><a href="#">Accueil</a></li>
                <li><a href="#">Recherche de vehicule</a></li>
            </ul>
        </div>
    </section>
    <!-- /BREADCRUMBS -->

    <section id="signup-form" class="page-section light">
        <div class="container">

          @include('rentit/components/advCarSearchFrom', ['from_home' => false]);

        </div>
    </section>
@endsection

@section('ExtraJS')
    <script type="text/javascript">
        $(function(){

            var date = new Date();
            var currentYear = date.getFullYear();
            var delta = 20;
            var beginYear = currentYear-delta;
            var scale = [];
            for(var tick=beginYear ; tick <= currentYear ; tick=tick+10)
                scale.push(tick);


            $('#years-slider').val(beginYear+','+currentYear);
            $('#years-slider').jRange({
                from:beginYear,
                to:currentYear,
                scale:scale,
                format:'%s',
                step:1,
                width:500,
                showLabels:true,
                showScale:true,
                isRange:true,
                theme:'theme-blue',
                onstatechange:function (){
                    val=$('#years-slider').val();
                    $('#years-slider-info').text(val.replace(',',' à '));
                }
            });

            $.ajax({
                'url':'/json_brands',
                'success':function(data,status,xhr){
                    jsondata = JSON.parse(data);
                    var options=[];
                    $('#brands-select').html('');
                    for(var i=0;i<jsondata.length;++i){
                        $('#brands-select').append('<option value="'+jsondata[i].id+'">'+jsondata[i].name+'</option>')
                    }
                    $('#brands-select').shuttle({
                        srcTitle:'Marques disponibles',
                        dstTitle:'Marques choisises',
                        filter:true
                    });

                }
            })
        });
    </script>
@endsection