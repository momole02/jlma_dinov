@extends('admin/skeleton')

@section('title')
    --JLMA-- Infos sur l'évenement
@endsection

@section('headerTitle')
    Infos sur l'évenement
@endsection

@section('headerDescription')
    Plus d'informations sur l'évenement
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-info box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Informations sur l'évenement</h3>

                    <!-- /.box-tools -->
                </div>

            <!-- /.box-header -->
                <div class="box-body">


                    @isset($event)

                        @if( $event->archive==1 )
                            <b style="background:red;color:white">  Cet evenement est archivé et ne sera plus visible bientôt  </b>
                        @endif
                        <h3>{{$event->titre_even}}</h3>
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>Type</th>
                                    <th>Code(clé)</th>
                                    <th>Date</th>
                                </tr>
                                <tr>
                                    <td>{{$event->code_even}}</td>
                                    <td>{{$event->slug}}</td>
                                    <td>{{ \jlma\Front_Utils::formatDate($event->date_even) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        @if( $event->archive==0 )
                            <a class="btn btn-warning" href="{{route('adminDoArchiveEvent' , ['slug'=>$event->slug])}}">Archiver</a>
                        @endif
                        <a class="btn btn-success" href="{{url($event->lien_even)}}">Voir l'objet</a>
                        <br>
                        <br>
                        <br>
                        <p>
                            <h4><u>Description:</u></h4>
                            <pre>{!! $event->desc_even !!}</pre>
                        </p>
                    @endisset

                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                </div>

            </div>
        </div>

    </div>

@endsection

