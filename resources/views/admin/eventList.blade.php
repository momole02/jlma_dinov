@extends('admin/skeleton')

@section('title')
    --JLMA-- Listing des évenements
@endsection

@section('headerTitle')
    Logs
@endsection

@section('headerDescription')
    Suivi des activités sur JLMA
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-7">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Suivi sur une periode</h3>

                    <!-- /.box-tools -->
                </div>

                <form class="form" method="post" action="{{route('adminDoSearchEventsBetween')}}">

                @csrf
                <!-- /.box-header -->
                <div class="box-body">

                        <div class="row">
                            <div class="col-md-4">Date de début : </div>
                            <div class="col-md-6"><input type="date" name="log-begin-date" class="form-control" required></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">Date de fin : </div>
                            <div class="col-md-6"><input type="date" name="log-end-date" class="form-control" required></div>
                        </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right"> Rechercher </button>
                </div>
                </form>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="box box-info ">
                <div class="box-header with-border">
                    <h3 class="box-title">Derniers évenements</h3>


                    <!-- /.box-tools -->
                </div>

                <form class="form" method="post" action="{{route('adminDoSearchLastEvents')}}">
                @csrf
                <!-- /.box-header -->
                <div class="box-body">
                        <div class="form-group">
                            <label for="log-nb-items">Nombre d'évenements</label>
                            <input type="number" min="3" value="10" class="form-control" name="log-nb-items" id="log-nb-items" required>
                        </div>

                        <div class="row">
                            <div class="col-md-12" style="text-decoration: underline;">Ordre d'arrivée</div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6" ><label for="log-asc-order"><input type="radio" name="log-order" value="asc" id="log-asc-order" checked>croissant</label></div>
                            <div class="col-md-6"><label for="log-desc-order"><input type="radio" name="log-order" value="desc" id="log-desc-order" >décroissant</label></div>
                        </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Rechercher</button>
                </div>

                </form>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Listing des évenements</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>

                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    @isset( $events )
                        <table class="table table-hover">
                            <tbody>
                               <tr>
                                   <th>Date</th>
                                   <th>Titre</th>
                                   <th>Description</th>
                                   <th>Lien</th>
                                   <th>Fiche</th>
                                   <th>Archiver</th>
                               </tr>
                            @foreach( $events as $eventEntry )
                                <tr>
                                    <td>{{ \jlma\Front_Utils::formatDate($eventEntry->date_even)}}</td>
                                    <td>{{$eventEntry->titre_even}}</td>
                                    <td>{!! nl2br(substr($eventEntry->desc_even,0,30)) !!}</td>
                                    <td><a href="{{url($eventEntry->lien_even)}}" class="btn btn-success">Voir l'objet concerné</a></td>
                                    <td><a href="{{route('adminEventCard' , ['slug'=>$eventEntry->slug])}}" class="btn btn-info">Voir fiche</a></td>
                                    <td><a href="{{route('adminDoArchiveEvent',['slug'=>$eventEntry->slug]) }}" class="btn btn-warning">Archiver</a></td>
                                </tr>
                            @endforeach
                            </tbody>

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

