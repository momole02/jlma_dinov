@extends('admin/skeleton')

@section('title')
    --JLMA-- Listing des notifications
@endsection

@section('headerTitle')
    Notifications
@endsection

@section('headerDescription')
    Liste de toutes vos notifications
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Listing des notifications</h3>


                    <!-- /.box-tools -->
                </div>


                <!-- /.box-header -->
                <div class="box-body">
                    @isset( $notifs )
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>Date</th>
                                <th>Code(clé)</th>
                                <th>Titre</th>
                                <th>Voir</th>
                            </tr>
                            @foreach( $notifs as $notifEntry )
                                <tr>
                                    <td>{{$notifEntry->date}}</td>
                                    <td>{{$notifEntry->slug}}</td>
                                    <td>{{$notifEntry->title}}</td>
                                    <td><a href="{{$notifEntry->link}}" class="btn btn-sucess" >Voir</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endisset
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right"> Rechercher </button>
                </div>

            </div>
        </div>

    </div>

@endsection

