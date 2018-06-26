@extends('rentit/layout')

@section('title')
    JeLoueMonAuto.ci - Connexion
@endsection

@section('contents')

    <!-- BREADCRUMBS -->
    <section class="page-section breadcrumbs text-right">
        <div class="container">
            <div class="page-header">
                <h1>Connexion</h1>
            </div>
            <ul class="breadcrumb">
                <li><a href="#">Accueil</a></li>
                <li class="active">Connexion</li>
            </ul>
        </div>
    </section>
    <!-- /BREADCRUMBS -->

   @include('rentit/components/login/loginForm')
@endsection