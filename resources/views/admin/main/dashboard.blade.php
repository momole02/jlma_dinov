@extends('admin/skeleton')

@section('title')
    -- JLMA -- Administration
@endsection

@section('headerTitle')
    Dashboard
@endsection

@section('headerDescription')
    Gestion du contenu à travers le tableau de bord
@endsection


@section('content')

    @if(!isset($no_content))
        <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{isset($total_cars) ? $total_cars : 0}}</h3>

                    <p>Voiture(s)</p>
                </div>
                <div class="icon">
                    <i class="fa fa-car"></i>
                </div>
                <a href="#" class="small-box-footer">Consulter <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{isset($total_reservations) ? $total_reservations : 0}}</h3>

                    <p>Reservation(s)</p>
                </div>
                <div class="icon">
                    <i class="fa fa-calendar"></i>
                </div>
                <a href="#" class="small-box-footer">Consulter <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{isset($total_users) ? $total_users : 0}}</h3>

                    <p>Utilisateur(s)</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{isset($total_testimonials) ? $total_testimonials: 0}}</h3>
                    <p>Témoignages(s)</p>
                </div>
                <div class="icon">
                    <i class="ion ion-heart"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    @endif

@endsection

